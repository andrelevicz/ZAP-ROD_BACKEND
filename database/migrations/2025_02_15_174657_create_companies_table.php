<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string("fantasy_name")->nullable();
            $table->string('cnpj', 14)->unique()->nullable();
            $table->string('legal_email')->unique();
            $table->string('phone', 20);
            $table->string('gateway_custumer_receiver_id')->nullable()->unique();
            $table->timestamps(); 
            $table->softDeletes();
        });
    }
}