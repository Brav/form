<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComplaintTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_types', function (Blueprint $table) {
            $table->dropColumn('severity');

        });

        Schema::table('complaint_types', function (Blueprint $table) {
            $table->tinyInteger('severity')->nullable()->default(null)->after('level');
            $table->string('complaint_channels_affected')
                ->nullable()
                ->default(null)
                ->after('severity');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_types', function (Blueprint $table) {
            //
        });
    }
}
