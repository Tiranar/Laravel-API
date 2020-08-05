<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 45)->nullable();
            $table->string('avatar', 45)->nullable();
            $table->string('character', 45)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('firstName', 45)->nullable();
            $table->string('furthestFloor', 45)->nullable();
            $table->string('furthestInteraction', 45)->nullable();
            $table->string('furthestLesson', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('trigger_elevator_first', 45)->nullable();
            $table->string('trigger_fp_room_first', 45)->nullable();
            $table->string('trigger_lobby_first', 45)->nullable();
            $table->string('trigger_mf_first', 45)->nullable();
            $table->string('trigger_trophy_room_first', 45)->nullable();
            $table->string('deviceGeneration', 45)->nullable();
            $table->string('hash', 75)->nullable();
            $table->string('osVersion', 45)->nullable();
            $table->timestamp('lastDiskSpaceWarning')->nullable();
            $table->string('passwordResetToken', 128)->nullable();
            $table->string('__state', 45)->nullable();
            $table->string('applicationId', 50)->nullable();
            $table->string('applicationSecret', 255)->nullable();
            $table->string('receipt', 512)->nullable();
            $table->string('organizationId', 45)->nullable();
            $table->timestamp('createdAt')->nullable();
            $table->timestamp('updatedAt')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
