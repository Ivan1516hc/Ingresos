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
        Schema::create('locations', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('descripcion');
            $table->unsignedTinyInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->unsignedTinyInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
