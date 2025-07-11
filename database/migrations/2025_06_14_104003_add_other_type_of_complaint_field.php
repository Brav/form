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
            $table->string('other_type_of_complaint')
                ->nullable()
                ->default(null)
                ->after('complaint_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->dropColumn('other_type_of_complaint');
        });
    }
};
