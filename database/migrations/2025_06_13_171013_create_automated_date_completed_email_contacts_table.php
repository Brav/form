<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('automated_date_completed_email_contacts', function (Blueprint $table) {
            $table->id();
            $table->json('emails');
            $table->timestamps();
        });

        \App\Models\AutomatedDateCompletedEmail::create(['emails' => ["hester.raijmakers@vet.partners", "kim.hutchison@vetpartners.com.au"]]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automated_date_completed_email_contacts');
    }
};
