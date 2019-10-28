<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('modul_id');
            $table->foreign('modul_id')->references('id')->on('moduls')->onUpdate('cascade')->onDelete('cascade');
            $table->string('submodul_id');
            $table->foreign('submodul_id')->references('id')->on('submoduls')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->string('PIC');
            $table->string('title');
            $table->text('message');
            $table->integer('priority');
            $table->json('img_links');
            $table->integer('status');
            $table->timestamp('opening_time')->nullable();
            $table->timestamp('working_time')->nullable();
            $table->timestamp('closing_time')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
