<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Support\Facades\DB;

use Validator;

use Request;

class CursoController extends Controller
{
    public function listar(){
        $cursos = Curso::all();

        return view('curso/listar')->with('cursos',$cursos);
    }


    public function cadastro(){
        return view('curso/cadastro');
    }

   public function salvar()
    {
        $nome = Request()->input('nome');
        $duracao = Request()->input('duracao');
        $status = Request()->input('status');

        $validator = Validator::make(
            [
                'nome' => $nome,
                'duracao' => $duracao
            ],
            [
                'nome' => 'required|min:4',
            ],
            [
                'required' => ':attribute é obrigatório',
                'min' => ':attribute ser precisa no minimo :min caracteres'
            ]
        );

        if ($validator->fails()){
            return redirect()->action('Curso@cadastro')->withErrors($validator)->withInput();
        }
        $curso = new Curso();
        $curso->nome =  $nome;
        $curso->duracao = $duracao;
        $curso->status = $status;
        $curso->save();

        return redirect()->action('CursoController@listar')->withInput();
    }

    public function editar($id)
    {
        $curso =  Curso::find($id);

        if (empty($curso)){
            return 'Curso nao existe';
        }else {
            return view('curso/editar')->with('curso', $curso);
        }
    }

    public function update($id)
    {
        $nome = Request()->input('nome');
        $duracao = Request()->input('duracao');
        $status = Request()->input('status');

        $curso =  Curso::find($id);
        $curso->nome =  $nome;
        $curso->duracao = $duracao;
        $curso->status = $status;
        $curso->save();

        return redirect()->action('CursoController@listar')->withInput();
    }

    public function apagar($id)
    {
        $curso =  Curso::find($id);
        $curso->delete();

        return redirect()->action('CursoController@listar');
    }
}
