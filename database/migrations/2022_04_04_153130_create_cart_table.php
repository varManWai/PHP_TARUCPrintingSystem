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
        Schema::create('Cart', function (Blueprint $table) {
            $table->increments('cartID');
            // $table->foreignId('studentID')->constrained('Students');
            // $table->unsignedInteger('userID');
            // $table->foreign('userID')->references('id')->on('users');


            $table->foreignId('userID')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cart');
    }
};
