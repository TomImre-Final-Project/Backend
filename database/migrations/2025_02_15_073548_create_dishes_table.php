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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('restaurant_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->decimal('price', 10, 2);
            $table->text('ingredients');
            $table->boolean('is_available')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();

            $table->check('price >= 0');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};