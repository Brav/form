<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintFormReminderSent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_forms_reminder_sent', function (Blueprint $table) {
            $table->id();
            $table->boolean('one_week_reminder')->nullable()->default(null);
            $table->boolean('two_weeks_reminder')->nullable()->default(null);
            $table->foreignId('complaint_form_id')
                ->constrained('complaint_forms')
                ->onDelete('cascade');
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
        Schema::dropIfExists('complaint_form_reminder_sent');
    }
}
