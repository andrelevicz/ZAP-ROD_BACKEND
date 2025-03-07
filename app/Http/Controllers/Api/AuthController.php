<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginOtpRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\RequestOtpRequest;
use App\Http\Requests\Auth\VerifyRegisterOtpRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        try { 
            return response()->json($this->authService->register($request->validated()));
           
        } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessagE()], 401);
            }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try { 
            return response()->json($this->authService->login($request->validated()));
        } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 401);
            }
    }

    public function verifyRegisterOtp(VerifyRegisterOtpRequest $request): JsonResponse
    {
        try { 
            $this->authService->verifyRegisterOtp($request->validated()['email'], $request->validated()['otp_code']);
            return response()->json(['message' => 'OTP enviado com sucesso.']);
        } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 401);
            }
        
    }

    public function requestLoginOtp(RequestOtpRequest $request): JsonResponse
    {
        try { 
            $this->authService->requestLoginOtp($request->validated()['email']);
            return response()->json(['message' => 'OTP enviado com sucesso.']);
        } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 401);
            }
    }

    public function loginWithOtp(LoginOtpRequest $request): JsonResponse
    {
      try { 
        $this->authService->loginWithOtp($request->validated()['email'], $request->validated()['otp_code']);
        return response()->json(['message' => 'Login realizado com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
