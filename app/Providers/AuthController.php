<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginOtpRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\RequestOtpRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json($this->authService->register($request->validated()));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return response()->json($this->authService->login($request->validated()));
    }

    public function requestLoginOtp(RequestOtpRequest $request): JsonResponse
    {
        $this->authService->requestLoginOtp($request->validated()['email']);
        return response()->json(['message' => 'OTP enviado com sucesso.']);
    }

    public function loginWithOtp(LoginOtpRequest $request): JsonResponse
    {
        return response()->json($this->authService->loginWithOtp(
            $request->validated()['email'],
            $request->validated()['otp_code']
        ));
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
