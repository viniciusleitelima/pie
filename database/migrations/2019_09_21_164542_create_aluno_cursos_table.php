<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno_cursos', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');

            $table->integer('id_aluno');
            $table->integer('id_curso');

            $table->dateTime('dt_fim');
            $table->dateTime('dt_inicio');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->foreign('id_aluno')->references('id')->on('alunos')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno_cursos');
    }
}
