<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('instances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('instance_id')->unique();
            $table->unsignedInteger('status');
            $table->json('webhook_events')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->text('qrcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evolution_instances');
    }
};