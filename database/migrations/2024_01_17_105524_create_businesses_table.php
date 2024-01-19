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
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->bigInteger('siret');
            $table->foreignUuid('craft_id');
            $table->string('website');
            $table->string('biography');
            $table->string('history');
            $table->foreignUuid('theme_id');
            $table->timestamps();
            $table->foreign('craft_id')
                ->references('id')
                ->on('crafts')
                ->onDelete('cascade');
            $table->foreign('theme_id')
                ->references('id')
                ->on('themes')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
