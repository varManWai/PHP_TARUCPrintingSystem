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
        Schema::create('Cart_Subject', function (Blueprint $table) {
            // $table->foreignId('cartID')->constrained('Cart');
            // $table->foreignId('subjectID')->constrained('Subject');
            $table->unsignedInteger('cartID');
            $table->unsignedInteger('subjectID');
            $table->foreign('cartID')->references('cartID')->on('Cart');
            $table->foreign('subjectID')->references('subjectID')->on('Subject');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cart_Subject');
    }
};
