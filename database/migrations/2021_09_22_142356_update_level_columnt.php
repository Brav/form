<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLevelColumnt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::statement("ALTER TABLE `complaint_form`.`complaint_forms`
            CHANGE COLUMN `level` `level` TINYINT UNSIGNED NULL DEFAULT NULL ;
            ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            //
        });
    }
}
