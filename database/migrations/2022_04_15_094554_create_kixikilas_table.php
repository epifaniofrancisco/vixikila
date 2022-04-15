<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKixikilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kixikilas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            //$table->longText('content')->default("Sem content");
            $table->foreign('id_user')->references('id')->on('users')->onDelete("cascade")->onUpdate("cascade");
            $table->double('montante');
            $table->integer('n_pessoas');
            $table->date('dt_validade');
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
        Schema::dropIfExists('kixikilas');
    }
}
