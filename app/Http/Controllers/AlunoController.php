<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Support\Facades\DB;

use Validator;

use Request;


class AlunoController extends Controller
{

    public function listar(){
        $alunos = Aluno::all();

        return view('aluno/listar')->with('alunos',$alunos);
    }

    public function cadastro(){
        return view('aluno/cadastro');
    }

    public function salvar()
    {
        $nome = Request()->input('nome');
        $cpf = Request()->input('cpf');
        $dt_nascimento = Request()->input('dt_nascimento');
        $celular = Request()->input('celular');
        $endereco = Request()->input('endereco');
        $email = Request()->input('email');
        $numero = Request()->input('numero');
        $bairro = Request()->input('bairro');
        $cidade = Request()->input('cidade');
        $uf = Request()->input('uf');
        $status = Request()->input('status');

        $validator = Validator::make(
            [
                'nome' => $nome,
                'cpf' => $cpf,
            ],
            [
                'nome' => 'required|min:4',
                'cpf' => 'required|min:11',
            ],
            [
                'required' => ':attribute é obrigatório',
                'min' => ':attribute ser precisa no minimo :min caracteres'
            ]
        );

        if ($validator->fails()){
            return redirect()->action('Aluno@cadastro')->withErrors($validator)->withInput();
        }
        $aluno = new Aluno();
        $aluno->nome =  $nome;
        $aluno->cpf = $cpf;
        $aluno->dt_nascimento = $dt_nascimento;
        $aluno->email = $email;
        $aluno->celular = $celular;
        $aluno->endereco = $endereco;
        $aluno->numero = $numero;
        $aluno->bairro = $bairro;
        $aluno->cidade = $cidade;
        $aluno->uf = $uf;
        $aluno->status = $status;
        $aluno->save();

        return redirect()->action('AlunoController@listar')->withInput();
    }
    /*
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
    */
}
