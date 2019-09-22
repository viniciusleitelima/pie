<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstituicaoCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicao_cursos', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');

            $table->integer('id_curso');
            $table->integer('id_instituicao');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('restrict');
            $table->foreign('id_instituicao')->references('id')->on('instituicoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicao_cursos');
    }
}
