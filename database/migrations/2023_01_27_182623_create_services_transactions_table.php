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
        Schema::create('services_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('invoice')->on('transactions');
            $table->unsignedSmallInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->unsignedMediumInteger('amount')->default(1);
            $table->float('cost');
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
        Schema::dropIfExists('services_transactions');
    }
};
