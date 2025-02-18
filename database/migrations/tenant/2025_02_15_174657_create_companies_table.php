<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies_personal_infos', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->string("fantasy_name")->nullable();
            $table->string('cnpj', 14)->unique();
            $table->string('legal_email')->unique();
            $table->string('phone', 20);
            $table->string('address');
            $table->string('stripe_customer_id')->nullable()->unique();
            $table->json('payment_settings')->nullable();
            $table->timestamps(); 
            $table->softDeletes();
        });
    }
}