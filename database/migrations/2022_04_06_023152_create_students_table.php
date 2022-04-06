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
        Schema::table('Students', function (Blueprint $table) {
            $table->increments('studentID');
            $table->string('name');
            $table->string('phoneNo')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
            
            $table->enum('accStatus', ['Activated', 'Deactivated']);;
            $table->foreignId('programmeID')->constrained('Programme');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
