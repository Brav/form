<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_categories', function (Blueprint $table) {
            $table->string('email_to_roles', 1024)
                ->nullable()
                ->default(null)
                ->after('name');

            $table->string('additional_emails', 1024)
                ->nullable()
                ->default(null)
                ->after('email_to_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_categories', function (Blueprint $table) {
            $table->dropColumn('email_to_roles');
            $table->dropColumn('additional_emails');
        });
    }
}
