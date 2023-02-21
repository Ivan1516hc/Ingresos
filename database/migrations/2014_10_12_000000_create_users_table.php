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
        Schema::create('users', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('post');
            $table->rememberToken();
            $table->unsignedTinyInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedTinyInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->unsignedSmallInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
