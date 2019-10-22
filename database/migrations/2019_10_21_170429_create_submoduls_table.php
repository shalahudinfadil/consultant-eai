<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmodulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submoduls', function (Blueprint $table) {
            $table->string('id');
            $table->primary('id');
            $table->string('modul_id');
            $table->foreign('modul_id')->references('id')->on('moduls')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
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
        Schema::dropIfExists('submoduls');
    }
}
