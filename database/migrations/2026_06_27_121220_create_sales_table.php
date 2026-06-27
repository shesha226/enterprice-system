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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('SaleId');
            $table->unsignedBigInteger('ProductId');
            $table->integer('Quantity');
            $table->decimal('TotalPrice', 10, 2);
            $table->dateTime('SaleDate');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('UserId')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
