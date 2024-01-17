<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'last_name');
            $table->string('first_name');
            $table->string('address');
            $table->string('postal_code');
            $table->string('city');
//            $table->unsignedBigInteger('role_id');
//            $table->foreign('role_id')
//                ->references('id')
//                ->on('roles')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('last_name', 'name');
            $table->dropColumn('first_name');
            $table->dropColumn('address');
            $table->dropColumn('postal_code');
        });
    }
};
