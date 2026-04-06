<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('firebase_settings', function (Blueprint $table) {
            $table->id();
            $table->string('server_key')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('project_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('firebase_settings');
    }
};