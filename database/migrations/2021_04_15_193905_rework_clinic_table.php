<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReworkClinicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropForeign(['lead_vet']);
            $table->dropForeign(['practise_manager']);
            $table->dropForeign(['vet_manager']);
            $table->dropForeign(['gm_veterinary_options']);
            $table->dropForeign(['gm_region']);
            $table->dropForeign(['regional_manager']);

            $table->dropColumn('lead_vet');
            $table->dropColumn('practise_manager');
            $table->dropColumn('vet_manager');
            $table->dropColumn('gm_veterinary_options');
            $table->dropColumn('gm_region');
            $table->dropColumn('regional_manager');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            //
        });
    }
}
