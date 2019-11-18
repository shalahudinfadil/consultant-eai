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
            $table->unsignedInteger('pic_id');
            $table->foreign('pic_id')->references('id')->on('pics')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->text('message');
            $table->integer('priority');
            $table->json('img_links')->nullable();
            $table->integer('status');
            $table->timestamp('working_at')->nullable();
            $table->timestamp('closing_at')->nullable();
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
