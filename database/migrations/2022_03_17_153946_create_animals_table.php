<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable()->default(null)->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        \DB::table('animals')->insert([
            ['name' => 'Dog'],
            ['name' => 'Cat'],
        ]);

        Schema::table('complaint_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('animal_id')->after('severity_id')
            ->nullable()->default(null);

            $table->foreign('animal_id')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
