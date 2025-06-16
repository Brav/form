<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->foreignId('patient_injury_type_id')
                ->nullable()
                ->after('severity_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->dropForeign('patient_injury_type_id');
            $table->dropColumn('patient_injury_type_id');
        });
    }
};
