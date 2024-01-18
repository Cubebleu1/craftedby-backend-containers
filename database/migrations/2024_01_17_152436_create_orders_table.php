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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('order_number');
            $table->foreignUuid('user_id');
            $table->decimal('price');
            $table->decimal('tax_amount');
            $table->boolean('payment_status');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');
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
