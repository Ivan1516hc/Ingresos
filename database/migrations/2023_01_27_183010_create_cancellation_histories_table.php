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
        Schema::create('cancellation_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('invoice')->on('transactions');
            $table->unsignedSmallInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedSmallInteger('authorized_user_id')->nullable();
            $table->foreign('authorized_user_id')->references('id')->on('users');
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('cancellation_histories');
    }
};
