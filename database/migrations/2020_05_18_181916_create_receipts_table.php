<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 45)->nullable();
            $table->string('applicationId', 50)->nullable();
            $table->string('organizationId', 50)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('duration', 45)->nullable();
            $table->string('userId', 50)->nullable();
            $table->string('env', 45)->nullable();
            $table->text('receipt')->nullable();
            $table->string('service', 45)->nullable();
            $table->string('meta', 255)->nullable();
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
        Schema::dropIfExists('receipts');
    }
}
