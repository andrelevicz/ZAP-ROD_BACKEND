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
        Schema::create('leads', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->text('phone')->nullable();
            $table->text('document')->nullable();
            $table->unsignedInteger('document_type')->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('origin')->default(1);
            $table->string('status')->default('new'); 
            $table->json('custom_fields')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
