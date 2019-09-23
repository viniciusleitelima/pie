<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('nome');
            $table->string('cpf', 11)->unique();
            $table->date('dt_nascimento')->nullable();;
            $table->string('email',100)->unique();
            $table->string('celular')->nullable();;
            $table->string('endereco')->nullable();;
            $table->string('numero')->nullable();;
            $table->string('bairro')->nullable();;
            $table->string('cidade')->nullable();;
            $table->string('uf')->nullable();;
            $table->integer('status');
            $table->integer('id_curso');

            $table->foreign('id_curso')->references('id')->on('cursos');
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
        Schema::dropIfExists('alunos');
    }
}
