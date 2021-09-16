<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSettingsFromComplaintOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() :void
    {
        Schema::table('complaint_categories', function (Blueprint $table) {
            $table->dropColumn('email_to_roles');
            $table->dropColumn('additional_emails');
        });

        Schema::table('complaint_channels', function (Blueprint $table) {
            $table->dropColumn('level');
            $table->dropColumn('additional_emails');
        });

        Schema::table('complaint_types', function (Blueprint $table) {
            $table->dropColumn('complaint_channels_settings');
        });

        Schema::table('automated_response', function (Blueprint $table) {
            $table->json('additional_emails')->nullable()->after('additional_contacts');
        });

        Schema::dropIfExists('severities');

        Schema::create('severities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->timestamps();
            $table->softDeletes();

            $table->unique('name');
        });

        DB::table('severities')->insert([
            ['name' => 'none'],
            ['name' => 'no adverse effect'],
            ['name' => 'minor adverse effect'],
            ['name' => 'severe adverse effect'],
            ['name' => 'not applicable'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
