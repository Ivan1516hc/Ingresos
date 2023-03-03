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
        Schema::create('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('invoice')->unique();
            $table->string('bill')->nullable();
            $table->float('total');
            $table->string('beneficiary_id');
            $table->string('beneficiary_name');
            $table->unsignedTinyInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedSmallInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->tinyInteger('status')->default(1);
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
