<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Programme', function (Blueprint $table) {
            $table->increments('programmeID');
            $table->string('name');
            // $table->foreignId('facultyID')->constrained('Faculty');
            $table->timestamps();
            $table->integer('facultyID');
            $table->foreign('facultyID')->references('facultyID')->on('Faculty');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Programme');
    }
};
