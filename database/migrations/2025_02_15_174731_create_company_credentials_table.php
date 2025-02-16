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
        Schema::create('company_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_personal_info_id')
              ->constrained('companies_personal_infos')
              ->onDelete('cascade');
            $table->string('api_token')->nullable()->unique();
            $table->string('admin_password');
            $table->string('bank_account')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_credentials');
    }
};
