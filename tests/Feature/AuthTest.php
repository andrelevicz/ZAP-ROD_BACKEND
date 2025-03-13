<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o fluxo de registro de um usuário.
     */
    public function testRegister()
    {
        $payload = [
            'email'                 => 'teste@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->json('POST', '/api/auth/register', $payload);
        
        $response->assertStatus(200);
    }

    /**
     * Testa a validação do registro (dados ausentes).
     */
    public function testRegisterValidation()
    {
        $response = $this->json('POST', '/api/auth/register', []);

        $response->assertStatus(422); // Validação deve retornar 422 Unprocessable Entity
    }

    /**
     * Testa o fluxo de login utilizando senha (sem OTP).
     * OBS: Ajuste de acordo com a resposta real do seu AuthService.
     */
    public function testLogin()
    {
        $user = User::factory()->create([
            'email'    => 'teste@example.com',
            'password' => bcrypt('password'),
        ]);

        $payload = [
            'email'    => 'teste@example.com',
            'password' => 'password',
        ];

        $response = $this->json('POST', '/api/auth/login', $payload);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => ['token'],
                 ]);
    }

    /**
     * Testa o fluxo de solicitação de OTP para login.
     */
    public function testRequestLoginOtp()
    {
        $user = User::factory()->create([
            'email' => 'otp@example.com',
        ]);

        $payload = [
            'email' => 'otp@example.com',
        ];

        $response = $this->json('POST', '/api/auth/request-login-otp', $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'message' => 'OTP enviado com sucesso.'
                 ]);
    }

    /**
     * Testa o fluxo de verificação do OTP no registro.
     * OBS: Para testes completos, considere mockar o AuthService.
     */
    public function testVerifyRegisterOtp()
    {
        $payload = [
            'email'    => 'teste@example.com',
            'otp_code' => '123456',
        ];

        $response = $this->json('POST', '/api/auth/verify-register-otp', $payload);

        // O status pode variar conforme a implementação real do AuthService
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'message' => 'OTP enviado com sucesso.'
                 ]);
    }
}
