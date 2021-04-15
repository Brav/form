<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToClinicManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_managers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('clinic_id')->references('id')->on('clinics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_managers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['clinic_id']);
        });
    }
}
