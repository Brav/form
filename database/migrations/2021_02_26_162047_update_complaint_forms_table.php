<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComplaintFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint_forms', function (Blueprint $table) {

            $table->foreign('clinic_id')
                ->references('id')
                ->on('clinics');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations');

            $table->foreign('complaint_category_id')
                ->references('id')
                ->on('complaint_categories');

            $table->foreign('complaint_type_id')
                ->references('id')
                ->on('complaint_types');

            $table->foreign('complaint_channel_id')
                ->references('id')
                ->on('complaint_channels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint-forms', function (Blueprint $table) {
            $table->dropForeign('clinic_id');
            $table->dropForeign('location_id');
            $table->dropForeign('complaint_category_id');
            $table->dropForeign('complaint_type_id');
            $table->dropForeign('complaint_channel_id');
        });
    }
}
