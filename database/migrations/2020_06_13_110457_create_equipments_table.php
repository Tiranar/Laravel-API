<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->string('id', 50)->primary();

            $table->string('userId', 50);
            $table->foreign('userId')->references('id')->on('users');

            $table->string('itemId', 50);
            $table->foreign('itemId')->references('id')->on('items');

            $table->string('slotId', 50);
            $table->foreign('slotId')->references('id')->on('slots');

            $table->timestamps();
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
        Schema::dropIfExists('equipments');
    }
}
