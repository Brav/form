<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablesWithSeverity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('complaint_forms', function (Blueprint $table) {
        //     $table->dropColumn('severity');

        //     $table->foreignId('severity_id')->after('complaint_channel_id');
        //     $table->tinyInteger('level')->after('severity_id')->default(1);

        //     $table->foreign('severity_id')->references('id')->on('severities');
        // });

        Schema::table('automated_response', function (Blueprint $table) {
            $table->tinyInteger('level')->after('default')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
