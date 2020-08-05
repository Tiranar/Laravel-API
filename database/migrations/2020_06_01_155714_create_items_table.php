<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('__version', 50);
            $table->string('type', 50);
            $table->string('name', 50);
            $table->unsignedInteger('cost');
            $table->string('shortDescription');
            $table->text('description')->nullable();
            $table->string('fileId', 50)->nullable()->default(NULL);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('fileId')
                ->references('id')
                ->on('files')
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
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_fileId_foreign');
        });

        Schema::dropIfExists('items');
    }
}
