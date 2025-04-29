<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('courier_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_id')->constrained('users');
            $table->foreignId('order_id')->constrained();
            $table->enum('action', ['claimed', 'delivered']);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('courier_logs');
    }
};
