<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComplaintFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->after('description', function ($table) {
                $table->text('outcome');
                $table->string('completed_by')->nullable()->default(null);
                $table->dateTime('date_completed')->nullable()->default(null);
            });
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
            $table->dropColumn('outcome');
            $table->dropColumn('completed_by');
            $table->dropColumn('date_completed');
        });
    }
}
