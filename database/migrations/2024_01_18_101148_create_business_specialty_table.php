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
        Schema::create('business_specialty', function (Blueprint $table) {
            $table->foreignUuid('business_id');
            $table->foreignUuid('specialty_id');

            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');
            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_specialty');
    }
};
