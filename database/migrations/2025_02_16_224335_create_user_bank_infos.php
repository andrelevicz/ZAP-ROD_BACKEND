<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_billing_info', function (Blueprint $table) {
            $table->ulid('id')->primary();

            // Chave estrangeira para users (ULID)
            $table->ulid('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // IDs do Stripe (nunca armazene dados sensíveis!)
            $table->string('stripe_customer_id')->nullable()->unique(); // ID do cliente no Stripe
            $table->string('stripe_payment_method_id')->nullable(); // ID do método de pagamento

            // Endereço de cobrança (usado para KYC no Stripe)
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->char('country_code', 2); // Código ISO do país

            $table->timestamps();
            $table->softDeletes(); // Para exclusão segura
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_billing_info');
    }
};
