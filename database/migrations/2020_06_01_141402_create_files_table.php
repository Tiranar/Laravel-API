<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('userId', 50)->nullable()->default(NULL);
            $table->string('src');
            $table->string('thumbnail')->nullable()->default(NULL);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('userId')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign('files_userId_foreign');
        });

        Schema::dropIfExists('files');
    }
}
