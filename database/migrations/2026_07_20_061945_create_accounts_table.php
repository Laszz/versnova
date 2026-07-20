<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('platform')->nullable();
            $table->string('server')->nullable();
            $table->string('bind_status')->nullable();
            $table->string('login_method')->nullable();
            $table->string('level')->nullable();
            $table->text('skin_info')->nullable();
            $table->decimal('price_sell', 12, 2)->nullable();
            $table->decimal('price_rent', 12, 2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->decimal('discount_price', 12, 2)->nullable();
            $table->timestamp('discount_until')->nullable();
            $table->string('status')->default('available');
            $table->timestamp('sold_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
