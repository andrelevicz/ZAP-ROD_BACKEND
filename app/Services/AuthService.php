<?php

namespace App\Services;

use App\Jobs\Auth\SendOtpMailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Tzsk\Otp\Facades\Otp;

class AuthService
{
    /**
     * Register a new user and return JWT token.
     *
     * @param array $data
     * @return array
     */
    public function register(array $data): array
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        

        $otpCode = Otp::expiry(config('app.otp_expiry'))->generate(md5($user->email));

        SendOtpMailJob::dispatchAfterResponse($user->email, $otpCode);

        return [
            'message' => 'Registro realizado com sucesso. Valide seu email para ativar o seu login.'
        ];


    }

    /**
     * Request an OTP for login.
     *
     * @param string $email
     * @return void
     */
    public function verifyRegisterOtp(string $email, string $otpCode): array
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new UnauthorizedException ('Usuário não encontrado.');
        }

        $match = Otp::expiry(config('app.otp_expiry'))->match($otpCode, md5($user->email));

        if (!$match) {
            throw new UnprocessableEntityHttpException('Código OTP inválido.');
        }

        Otp::forget(md5($user->email));

        $user->email_verified = true;
        $user->save();

        $token = Auth::claims([
            'user_id' => $user->id,
        ])->login($user);

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];

    }


    public function requestLoginOtp(string $email): void
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new UnauthorizedException ('Usuário não encontrado.');
        }

        $otpCode = Otp::expiry(config('app.otp_expiry'))->generate(md5($user->email));

        SendOtpMailJob::dispatchAfterResponse($user->email, $otpCode);
    }

    /**
     * Validate OTP and return JWT token.
     *
     * @param string $email
     * @param string $otpCode
     * @return array
     */
    public function loginWithOtp(string $email, string $otpCode): array
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new UnauthorizedException('Usuário não encontrado.');
        }

        $match = Otp::expiry(config('app.otp_expiry'))->match($otpCode, md5($user->email));

        if (!$match) {
            throw new UnprocessableEntityHttpException('Código OTP inválido.');
        }

        Otp::forget(md5($user->email));

        $token = Auth::claims([
            'user_id' => $user->id,
        ])->login($user);

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }

    /**
     * Login using email and password, return JWT token.
     *
     * @param array $credentials
     * @return array
     */
    public function login(array $credentials): array
    {
        if (!$token = Auth::attempt($credentials)) {
            throw new UnauthorizedException('Credenciais inválidas.');
        }

        $user = Auth::user();

        return [
            'access_token' => Auth::claims([
                'user_id' => $user->id,
            ])->fromUser($user),
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
        ];
    }

    /**
     * Logout user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
