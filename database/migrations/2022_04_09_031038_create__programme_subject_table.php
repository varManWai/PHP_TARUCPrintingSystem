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
        Schema::create('ProgrammeSubject', function (Blueprint $table) {
            // $table->foreignId('programmeID')->constrained('Programme');
            // $table->foreignId('subjectID')->constrained('Subject');
            
            $table->unsignedInteger('programmeID');
            $table->unsignedInteger('subjectID');
            $table->foreign('programmeID')->references('programmeID')->on('Programme');
            $table->foreign('subjectID')->references('subjectID')->on('Subject');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ProgrammeSubject');
    }
};
