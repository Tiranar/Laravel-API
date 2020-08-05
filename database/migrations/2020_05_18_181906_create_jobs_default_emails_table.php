<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsDefaultEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_default_emails', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('queueId', 255)->nullable();
            $table->string('state', 45)->nullable();
            $table->timestamp('dateChange')->nullable();
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
        Schema::dropIfExists('jobs_default_emails');
    }
}
