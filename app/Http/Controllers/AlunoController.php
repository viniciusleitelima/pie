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
            ->select('alunos.*', 'cursos.nome as nome_curso')
            ->get();

        return view('aluno/listar')->with('alunos',$alunos);
    }

    public function cadastro(){
        $cursos = Curso::all();
        return view('aluno/cadastro')->with('cursos',$cursos);
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
        $aluno->id_curso = $id_curso;
        $aluno->save();



        return redirect()->action('AlunoController@listar')->withInput();
    }

    public function editar($id)
    {
        $aluno =  Aluno::find($id)
                        ->join('cursos', 'alunos.id_curso', '=', 'cursos.id')
                        ->select('alunos.*', 'cursos.nome as nome_curso')
                        ->where('alunos.id', '=', $id)
                        ->get();
        $cursos = Curso::all();
        if (empty($aluno)){
            return 'Aluno nao existe';
        }else {
            return view('aluno/editar')->with('aluno', $aluno)->with('cursos',$cursos);
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
