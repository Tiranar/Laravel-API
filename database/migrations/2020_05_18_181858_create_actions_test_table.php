<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions_test', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 45)->nullable();
            $table->boolean('authenticated')->default(0)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('__state', 45)->nullable();
            $table->string('organizationId', 50)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
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
        Schema::dropIfExists('actions_test');
    }
}
