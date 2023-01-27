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
        Schema::create('services', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->float('cost');
            $table->smallInteger('type_income');
            $table->smallInteger('code_income');
            $table->boolean('not_binding');
            $table->smallInteger('id_gu');
            $table->boolean('partial');
            $table->string('unit');
            $table->string('leadership');
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
        Schema::dropIfExists('services');
    }
};
