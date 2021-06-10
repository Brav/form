<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComplaintTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_types', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('severity');
            $table->dropColumn('complaint_channels_affected');

            $table->json('complaint_channels_settings')
                ->nullable()
                ->default(null)
                ->after('name');
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
            $table->dropColumn('complaint_channels_settings');
        });
    }
}
