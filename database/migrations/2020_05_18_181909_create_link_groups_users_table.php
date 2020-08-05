<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkGroupsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_groups_users', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 45)->nullable();
            $table->string('groupId', 50)->nullable();
            $table->string('userId', 50)->nullable();
            $table->boolean('leader')->default(0)->nullable();
            $table->string('sid', 45)->nullable();
            $table->string('status', 45)->nullable();
            $table->string('__state', 45)->nullable();
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
        Schema::dropIfExists('link_groups_users');
    }
}
