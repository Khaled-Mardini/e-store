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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('OrderId');
            $table->unsignedBigInteger('ProductId');
            $table->integer('UnitPrice');
            $table->integer('Quantity');
            $table->boolean('IsDeleted')->default(false);
            $table->timestamps();

            $table->foreign('OrderId')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('ProductId')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
