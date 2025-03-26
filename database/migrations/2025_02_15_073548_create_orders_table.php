<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('courier_id')->nullable()->constrained('users');
            $table->timestamp('order_date');
            $table->enum('status', ['pending', 'in_delivery', 'delivered', 'cancelled']);
            $table->decimal('total_price', 10, 2);
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('special_instructions')->nullable();
            $table->timestamps();

            $table->check('total_price >= 0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
