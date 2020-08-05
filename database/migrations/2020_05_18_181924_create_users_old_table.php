<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersOldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_old', function (Blueprint $table) {
            $table->string('id', 255)->primary();
            $table->string('sid', 255)->unique()->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('firstName', 255)->nullable();
            $table->string('hash', 255)->nullable();
            $table->string('lastName', 255)->nullable();
            $table->longText('meta')->nullable();
            $table->longText('roles')->nullable();
            $table->string('status', 255)->index()->nullable();
            $table->string('timezone', 255)->nullable();
            $table->string('username', 255)->unique()->nullable();
            $table->dateTime('createdAt')->nullable()->useCurrent();
            $table->dateTime('updatedAt')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_old');
    }
}
