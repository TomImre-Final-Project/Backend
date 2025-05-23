<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->foreignId('order_id')->primary()->constrained();
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->enum('method', ['credit_card', 'paypal', 'bank_transfer']);
            $table->string('transaction_id')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
