<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->string('eid');
            $table->primary('eid');
            $table->foreign('eid')->references('eid')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('modul_id');
            $table->foreign('modul_id')->references('id')->on('moduls')->onUpdate('cascade')->onDelete('cascade');
            $table->string('submodul_id');
            $table->foreign('submodul_id')->references('id')->on('submoduls')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('assignments');
    }
}
