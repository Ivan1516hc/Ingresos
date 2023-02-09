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
        Schema::create('beneficiaries_communities', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('beneficiary_id');
            $table->string('beneficiary_name');
            $table->unsignedTinyInteger('community_id');
            $table->foreign('community_id')->references('id')->on('communities');
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
        Schema::dropIfExists('beneficiaries_communities');
    }
};
