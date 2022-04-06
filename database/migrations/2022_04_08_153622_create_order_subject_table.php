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
        Schema::create('Order_Subject', function (Blueprint $table) {
            // $table->foreignId('orderID')->constrained('Order');
            // $table->foreignId('subjectID')->constrained('Subject');
            $table->unsignedInteger('orderID');
            $table->unsignedInteger('subjectID');
            $table->foreign('orderID')->references('orderID')->on('Order');
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
        Schema::dropIfExists('Order_Subject');
    }
};
