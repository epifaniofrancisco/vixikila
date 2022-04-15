<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nomeusuario');
            $table->string('email', 250)->unique();
            $table->timestamp('email_verified_at')->nullable();      
            $table->string('password');
            $table->string('perfil')->nullable();
            $table->string('numerobi');
            $table->string('telefone');
            $table->string('nomecompletobi');
            $table->date('dataNascimento');
            $table->string('genero');
            $table->string('pais');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('residencia');
            $table->string('contaBancaria');
            $table->string('iban');
            $table->string('dataExpCartao');
            $table->softDeletes();


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
