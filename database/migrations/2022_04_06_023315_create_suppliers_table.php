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
        Schema::create('Suppliers', function (Blueprint $table) {
            $table->increments('supplierID');
            $table->string('name');
            $table->string('phoneNo')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();

            $table->string('shopName');
            $table->string('location');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            Schema::dropIfExists('Suppliers');
        });
    }
};
