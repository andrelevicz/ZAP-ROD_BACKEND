<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid('id')->primary(); // ULID para URLs públicas
            $table->foreignUlid('company_id')->constrained('companies_personal_infos');
            $table->foreignUlid('lead_id')->nullable()->constrained('leads'); // Se convertido de um lead
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending'); // Ex: pending, paid, shipped, cancelled
            $table->string('tracking_code')->nullable(); // Código de rastreio
            $table->timestamp('paid_at')->nullable(); // Data de confirmação de pagamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
