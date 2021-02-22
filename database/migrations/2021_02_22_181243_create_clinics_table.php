<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('lead_vet')->nullable();
            $table->unsignedBigInteger('practise_manager')->nullable();
            $table->unsignedBigInteger('vet_manager')->nullable();
            $table->unsignedBigInteger('gm_veterinary_options')->nullable();
            $table->unsignedBigInteger('gm_region')->nullable();
            $table->unsignedBigInteger('regional_manager')->nullable();
            $table->timestamps();

            $table->foreign('lead_vet')->references('id')->on('users');
            $table->foreign('practise_manager')->references('id')->on('users');
            $table->foreign('vet_manager')->references('id')->on('users');
            $table->foreign('gm_veterinary_options')->references('id')->on('users');
            $table->foreign('gm_region')->references('id')->on('users');
            $table->foreign('regional_manager')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinics');
    }
}
