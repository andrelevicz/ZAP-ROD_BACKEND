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
        Schema::create('company_sales_infos', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignUlid('company_id')->constrained('companies')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->json('social_links')->nullable();
            $table->text('delivery_description')->nullable();
            $table->text('returns_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
