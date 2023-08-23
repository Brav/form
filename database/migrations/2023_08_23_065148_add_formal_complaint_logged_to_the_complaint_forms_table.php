<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormalComplaintLoggedToTheComplaintFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->boolean('formal_complaint_lodged')
                ->default(false)
                ->after('animal_id');
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
            $table->dropColumn('formal_complaint_lodged');
        });
    }
}
