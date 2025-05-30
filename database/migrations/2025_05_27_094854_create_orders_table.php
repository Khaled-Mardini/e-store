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
            $table->date('OrderDate');
            $table->integer('OrderNumber');
            $table->unsignedBigInteger('CustomerId');
            $table->integer('TotalAmount');
            $table->boolean('IsDeleted')->default(false);
            $table->timestamps();

            $table->foreign('CustomerId')->references('id')->on('customers')->onDelete('cascade');
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
