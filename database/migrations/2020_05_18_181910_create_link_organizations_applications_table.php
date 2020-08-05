<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkOrganizationsApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_organizations_applications', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('applicationId', 50)->nullable();
            $table->string('organizationId', 50)->nullable();
            $table->string('__state', 45)->nullable();
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
        Schema::dropIfExists('link_organizations_applications');
    }
}
