<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

        /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $token = auth()->claims([
                'user_id' => $user->id,
                'permissions' => $user->permissions, // Supondo que tenha um método que obtenha as permissões
                'entity_id' => $user->entity_id, // Exemplo de entidade associada ao usuário
            ])->login($user);
    
            return $this->respondWithToken($token);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::info('Register failed for credentials: ', $request->all());
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
    

        if (!$token = auth()->attempt($credentials)) {
            \Illuminate\Support\Facades\Log::info('Login failed for credentials: ', $credentials);
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
    
        $user = auth()->user();
    
        $token = auth()->claims([
            'user_id' => $user->id,
        ])->fromUser($user);
    
        return $this->respondWithToken($token);
    }
    

    

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}
