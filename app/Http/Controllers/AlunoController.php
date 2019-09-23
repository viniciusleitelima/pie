<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Support\Facades\DB;

use App\Curso;
use App\AlunoCurso;
use Validator;

use Request;


class AlunoController extends Controller
{

    public function listar(){
        $alunos =DB::table('alunos')
            ->join('cursos', 'alunos.id_curso', '=', 'cursos.id')
            ->join('instituicoes', 'alunos.id_instituicao', '=', 'instituicoes.id')
            ->select('alunos.*', 'cursos.nome as nome_curso', 'instituicoes.nome as nome_instituicao')
            ->get();

        return view('aluno/listar')->with('alunos',$alunos);
    }

    public function cadastro(){
        $cursos = DB::table('cursos')
                  ->where('status', '=', 1)
                  ->get();
        $instituicoes = DB::table('instituicoes')
            ->where('status', '=', 1)
            ->get();
        return view('aluno/cadastro')->with('cursos',$cursos)->with('instituicoes',$instituicoes);
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
        $id_curso = Request()->input('curso');
        $id_instituicao = Request()->input('instituicao');

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
            return redirect()->action('AlunoController@cadastro')->withErrors($validator)->withInput();
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
        $aluno->id_curso = $id_curso;
        $aluno->id_instituicao = $id_instituicao;
        $aluno->save();



        return redirect()->action('AlunoController@listar')->withInput();
    }

    public function editar($id)
    {
        $aluno =  Aluno::find($id)
                        ->join('cursos', 'alunos.id_curso', '=', 'cursos.id')
                        ->join('instituicoes', 'alunos.id_instituicao', '=', 'instituicoes.id')
                        ->select('alunos.*', 'cursos.nome as nome_curso','instituicoes.nome as nome_instituicao')
                        ->where('alunos.id', '=', $id)
                        ->get();
        $cursos = DB::table('cursos')
            ->where('status', '=', 1)
            ->get();
        $instituicoes = DB::table('instituicoes')
            ->where('status', '=', 1)
            ->get();
        if (empty($aluno)){
            return 'Aluno nao existe';
        }else {
            return view('aluno/editar')->with('aluno', $aluno)->with('cursos',$cursos)->with('instituicoes',$instituicoes);
        }
    }

        public function update($id)
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
        $id_curso = Request()->input('curso');
        $id_instituicao = Request()->input('instituicao');

        $aluno =  Aluno::find($id);
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
        $aluno->id_curso = $id_curso;
        $aluno->id_instituicao = $id_instituicao;
        $aluno->save();

        return redirect()->action('AlunoController@listar')->withInput();
    }

    public function apagar($id)
    {
        $aluno =  Aluno::find($id);
        $aluno->delete();

        return redirect()->action('AlunoController@listar');
    }

    public function alterarStatus($id,$status)
    {
        $aluno =  Aluno::find($id);
        $aluno->status = $status;
        $aluno->save();

        return redirect()->action('AlunoController@listar');
    }

}
