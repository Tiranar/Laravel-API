<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 45)->nullable();
            $table->string('applicationId', 50)->nullable();
            $table->string('childFirstName', 45)->nullable();
            $table->string('childId', 50)->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('label', 45)->nullable();
            $table->string('origin', 45)->nullable();
            $table->string('parentEmail', 45)->nullable();
            $table->string('parentFirstName', 45)->nullable();
            $table->string('parentId', 50)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('time', 45)->nullable();
            $table->string('useragent', 45)->nullable();
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
        Schema::dropIfExists('events');
    }
}
