<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__state', 45)->nullable();
            $table->string('__version', 45)->nullable();
            $table->string('title', 45)->nullable();
            $table->string('secret', 45)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('hostnames', 255)->nullable();
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
        Schema::dropIfExists('applications');
    }
}
