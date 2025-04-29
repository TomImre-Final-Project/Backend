<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->foreignId('manager_id')->nullable()->constrained('users');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
