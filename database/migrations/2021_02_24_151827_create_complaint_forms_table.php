<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id');
            $table->string('team_member');
            $table->string('team_member_position');
            $table->string('client_name');
            $table->string('patient_name');
            $table->string('pms_code');
            $table->dateTime('date_of_incident');
            $table->date('date_of_client_complaint')->nullable()->default(null);
            $table->text('description');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('complaint_category_id');
            $table->unsignedBigInteger('complaint_type_id')->nullable()->default(null);
            $table->unsignedBigInteger('complaint_channel_id')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_forms');
    }
}
