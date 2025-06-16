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
            $table->string('near_miss_description')->nullable()->after('other_type_of_complaint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->dropColumn('near_miss_description');
        });
    }
};
