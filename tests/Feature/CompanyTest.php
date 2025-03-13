<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Company;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Cria um usuário autenticado e define o guard "api".
     */
    protected function authenticateUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        return $user;
    }

    /**
     * Testa a listagem de empresas.
     */
    public function testListCompanies()
    {
        $this->authenticateUser();
        Company::factory()->count(3)->create();

        $response = $this->json('GET', '/api/company/companies');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'name'] // acrescente outros campos conforme seu resource
                     ]
                 ]);
    }

    /**
     * Testa o cadastro de uma nova empresa.
     */
    public function testStoreCompany()
    {
        $this->authenticateUser();

        $payload = [
            'name'    => 'Empresa Teste',
            // inclua demais campos necessários, ex.: 'address' => 'Rua Exemplo, 123'
        ];

        $response = $this->json('POST', '/api/company/companies', $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Empresa Teste']);
    }

    /**
     * Testa a exibição dos detalhes de uma empresa.
     */
    public function testShowCompany()
    {
        $this->authenticateUser();
        $company = Company::factory()->create();

        $response = $this->json('GET', "/api/company/companies/{$company->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $company->id]);
    }

    /**
     * Testa a atualização de uma empresa.
     */
    public function testUpdateCompany()
    {
        $this->authenticateUser();
        $company = Company::factory()->create();

        $payload = [
            'name' => 'Empresa Atualizada',
        ];

        $response = $this->json('PUT', "/api/company/companies/{$company->id}", $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Empresa Atualizada']);
    }

    /**
     * Testa a remoção de uma empresa.
     */
    public function testDeleteCompany()
    {
        $this->authenticateUser();
        $company = Company::factory()->create();

        $response = $this->json('DELETE', "/api/company/companies/{$company->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
