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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->index();
            $table->enum('level', ['INFO', 'ERROR', 'WARNING', 'DEBUG', 'CRITICAL'])->default('INFO');
            $table->string('type');
            $table->string('identifier')->nullable();
            $table->text('message')->nullable();
            $table->json('context')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
