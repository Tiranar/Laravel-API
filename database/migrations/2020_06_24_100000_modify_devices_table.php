<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->string('platform')->nullable()->default(null);
            $table->string('deviceModel')->nullable()->default(null);
            $table->string('deviceName')->nullable()->default(null);
            $table->string('deviceType')->nullable()->default(null);
            $table->string('deviceUniqueIdentifier')->nullable()->default(null);
            $table->string('graphicsDeviceVendor')->nullable()->default(null);
            $table->string('osVersion')->nullable()->default(null);
            $table->string('deviceToken')->nullable()->default(null);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('platform');
            $table->dropColumn('deviceModel');
            $table->dropColumn('deviceName');

            $table->dropColumn('deviceType');
            $table->dropColumn('deviceUniqueIdentifier');
            $table->dropColumn('graphicsDeviceVendor');

            $table->dropColumn('osVersion');
            $table->dropColumn('deviceToken');
        });
    }
}
