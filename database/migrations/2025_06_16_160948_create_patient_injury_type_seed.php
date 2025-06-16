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
        \App\Models\PatientInjuryType::insert([
           [ 'name' => 'Surgical complication'],
           [ 'name' => 'Dental complication'],
           [ 'name' => 'Anesthetic complication'],
           [ 'name' => 'Consult related (missed/delayed diagnosis)'],
           [ 'name' => 'Avoidable injury (iatrogenic/burns/falls)'],
           [ 'name' => 'Other (Patient escape/ate llv)'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
