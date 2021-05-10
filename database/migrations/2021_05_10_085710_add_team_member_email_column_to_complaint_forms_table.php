<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamMemberEmailColumnToComplaintFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->string('team_member_email')
                ->default(null)
                ->nullable()
                ->after('team_member');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->dropColumn('team_member_email');
        });
    }
}
