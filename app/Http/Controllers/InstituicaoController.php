<?php

namespace App\Http\Controllers;

use App\Instituicao;
use Illuminate\Support\Facades\DB;

use Validator;

use Request;
use App\Curso;

class InstituicaoController extends Controller
{
    public function listar(){
        $instituicoes = Instituicao::all();

        return view('instituicao/listar')->with('instituicoes',$instituicoes);
    }

    public function cadastro(){
        return view('instituicao/cadastro');
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
}
