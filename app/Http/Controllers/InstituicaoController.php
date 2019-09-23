<?php

namespace App\Http\Controllers;

use App\Instituicao;
use Illuminate\Support\Facades\DB;

use Validator;

use Request;
use App\Curso;
use App\InstituicaoCurso;

class InstituicaoController extends Controller
{
    public function listar(){
        $instituicoes = Instituicao::all();

        $cursos = DB::table('instituicao_cursos')
            ->join('cursos', 'instituicao_cursos.id_curso', '=', 'cursos.id')
            ->join('instituicoes', 'instituicao_cursos.id_instituicao', '=', 'instituicoes.id')
            ->select('instituicao_cursos.id_instituicao')
            ->get();

        return view('instituicao/listar')->with('instituicoes',$instituicoes)->with('cursos',$cursos);
    }

    public function salvar()
    {
        $nome = Request()->input('nome');
        $cnpj = Request()->input('cnpj');
        $status = Request()->input('status');

        $validator = Validator::make(
            [
                'nome' => $nome,
                'cnpj' => $cnpj
            ],
            [
                'nome' => 'required|min:6',
                'cnpj' => 'required|numeric'
            ],
            [
                'required' => ':attribute é obrigatório',
                'numeric' => ':attribute precisa ser numérico',
                'min' => ':attribute ser precisa no minimo :min caracteres'
            ]
        );

        if ($validator->fails()){
            return redirect()->action('Instituicao@cadastro')->withErrors($validator)->withInput();
        }
        $instituicao = new Instituicao();
        $instituicao->nome =  $nome;
        $instituicao->cnpj = $cnpj;
        $instituicao->status = $status;
        $instituicao->save();

        return redirect()->action('InstituicaoController@listar')->withInput();
    }

    public function editar($id)
    {
        $instituicao =  Instituicao::find($id);

        if (empty($instituicao)){
            return 'Instituica nao existe';
        }else {
            return view('instituicao/editar')->with('instituicao', $instituicao);
        }
    }

    public function update($id)
    {
        $nome = Request()->input('nome');
        $cnpj = Request()->input('cnpj');
        $status = Request()->input('status');

        $instituicao =  Instituicao::find($id);
        $instituicao->nome =  $nome;
        $instituicao->cnpj = $cnpj;
        $instituicao->status = $status;
        $instituicao->save();

        return redirect()->action('InstituicaoController@listar')->withInput();
    }

    public function apagar($id)
    {
        $instituicao =  Instituicao::find($id);
        $instituicao->delete();

        return redirect()->action('InstituicaoController@listar');
    }


    public function verCursos($id){
        $cursos = DB::table('instituicao_cursos')
            ->join('cursos', 'instituicao_cursos.id_curso', '=', 'cursos.id')
            ->join('instituicoes', 'instituicao_cursos.id_instituicao', '=', 'instituicoes.id')
            ->select('instituicao_cursos.*', 'instituicoes.nome as nome_instituicao', 'cursos.nome as nome_curso')
            ->where('instituicao_cursos.id_instituicao', '=',$id)
            ->get();
        return view('instituicao/ver_cursos')->with('cursos',$cursos);
    }




    public function cadastrarCursos($id){
        $instituicao =  Instituicao::find($id);
        $cursos = Curso::all();
        return view('instituicao/cadastrar_cursos')->with('instituicao', $instituicao)->with('cursos',$cursos);
    }

    public function cadastro(){
        return view('instituicao/cadastro');
    }

    public function salvarCurso(Request $request, $id){

        $id_curso = Request()->input('curso');

        $instituicao_curso = new InstituicaoCurso();
        $instituicao_curso->id_curso =  $id_curso;
        $instituicao_curso->id_instituicao = $id;
        $instituicao_curso->status = 1;
        $instituicao_curso->save();

        return redirect()->action('InstituicaoController@verCursos',$id);
    }

    public function alterarCurso($id,$status)
    {
        $instituicao_curso =  InstituicaoCurso::find($id);
        $instituicao_curso->status = $status;
        $id_instituicao =$instituicao_curso->id_instituicao;
        $instituicao_curso->save();

        return redirect()->action('InstituicaoController@verCursos',$id_instituicao);
    }

    public function alterarStatus($id,$status)
    {
        $instituicao =  Instituicao::find($id);
        $instituicao->status = $status;
        $instituicao->save();

        return redirect()->action('InstituicaoController@listar');
    }
}
