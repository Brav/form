<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalEmailsColumnt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_channels', function (Blueprint $table) {
            $table->text('additional_emails')
                ->nullable()
                ->default(null)
                ->after('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_channels', function (Blueprint $table) {
            $table->dropColumn('additional_emails');
        });
    }
}
