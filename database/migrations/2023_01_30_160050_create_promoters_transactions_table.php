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
        Schema::create('promoters_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('promoter_id');
            $table->foreign('promoter_id')->references('id')->on('promoters');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('invoice')->on('transactions');
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
        Schema::dropIfExists('promoters_transactions');
    }
};
