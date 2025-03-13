<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription as SubscriptionModel;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Cria um usuário autenticado com dados do Stripe.
     */
    protected function authenticateUser()
    {
        $user = User::factory()->create([
            'stripe_customer_id' => 'cus_test123'
        ]);
        $this->actingAs($user, 'api');
        return $user;
    }

    /**
     * Testa a criação de um novo plano.
     * OBS: Dependendo da sua configuração, talvez seja necessário mockar as chamadas à API do Stripe.
     */
    public function testCreatePlan()
    {
        $this->authenticateUser();

        $payload = [
            'name'  => 'Plano Teste',
            'price' => 50,
        ];

        $response = $this->json('POST', '/api/subscriptions/plans', $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Plano Teste']);
    }

    /**
     * Testa a criação de uma assinatura para um usuário.
     */
    public function testCreateSubscription()
    {
        $user = $this->authenticateUser();

        // Crie um plano (use factory se disponível ou ajuste conforme seu cenário)
        $plan = Plan::factory()->create([
            'name'           => 'Plano Teste',
            'base_price'     => 50,
            'stripe_plan_id' => 'price_test123'
        ]);

        $payload = [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
        ];

        $response = $this->json('POST', '/api/subscriptions/subscriptions', $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'active']);
    }

    /**
     * Testa a listagem das assinaturas.
     */
    public function testListSubscriptions()
    {
        $this->authenticateUser();
        SubscriptionModel::factory()->count(2)->create();

        $response = $this->json('GET', '/api/subscriptions/subscriptions');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => ['id', 'plan_id', 'start_date', 'status']
                 ]);
    }

    /**
     * Testa o cancelamento de uma assinatura.
     */
    public function testCancelSubscription()
    {
        $this->authenticateUser();

        // Cria uma assinatura com um stripe_subscription_id fictício
        $subscription = SubscriptionModel::factory()->create([
            'status'                  => 'active',
            'stripe_subscription_id'  => 'sub_test123'
        ]);

        $response = $this->json('DELETE', "/api/subscriptions/subscriptions/{$subscription->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'message' => 'Assinatura cancelada com sucesso'
                 ]);

        $this->assertDatabaseHas('subscriptions', [
            'id'     => $subscription->id,
            'status' => 'canceled'
        ]);
    }
}
