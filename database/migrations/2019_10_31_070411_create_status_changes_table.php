<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_eid');
            $table->foreign('user_eid')->references('eid')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onUpdate('cascade')->onDelete('cascade');
            $table->string('submodul_id');
            $table->foreign('submodul_id')->references('id')->on('submoduls')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('changed_to');
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
        Schema::dropIfExists('status_changes');
    }
}
