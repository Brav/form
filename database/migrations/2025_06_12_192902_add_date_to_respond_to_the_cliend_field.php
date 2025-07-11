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
            $table->date('date_to_respond_to_the_client')
                ->nullable()
                ->default(null)
                ->after('date_of_client_complaint');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->dropColumn('date_to_respond_to_the_client');
        });
    }
};
