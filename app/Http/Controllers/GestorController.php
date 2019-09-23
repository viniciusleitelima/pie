<?php

namespace App\Http\Controllers;

use App\Aluno;
use Illuminate\Support\Facades\DB;

use App\Instituicao;
use App\Gestor;
use Validator;

use Request;

class GestorController extends Controller
{
    public function listar(){
        $gestores =DB::table('gestores')
            ->join('instituicoes', 'gestores.id_instituicao', '=', 'instituicoes.id')
            ->select('gestores.*', 'instituicoes.nome as nome_instituicao')
            ->get();

        return view('gestor/listar')->with('gestores',$gestores);
    }


    public function cadastro(){
        $instituicoes = DB::table('instituicoes')
            ->where('status', '=', 1)
            ->get();
        return view('gestor/cadastro')->with('instituicoes',$instituicoes);
    }

    public function salvar()
    {
        $nome = Request()->input('nome');
        $email = Request()->input('email');
        $status = Request()->input('status');
        $id_instituicao = Request()->input('instituicao');

        $validator = Validator::make(
            [
                'nome' => $nome,
                'email' => $email,
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
            return redirect()->action('GestorController@cadastro')->withErrors($validator)->withInput();
        }
        $gestor = new Gestor();
        $gestor->nome =  $nome;
        $gestor->email = $email;
        $gestor->status = $status;
        $gestor->id_instituicao = $id_instituicao;
        $gestor->save();



        return redirect()->action('GestorController@listar')->withInput();
    }

    public function editar($id)
    {
        $gestor =  Gestor::find($id)
            ->join('instituicoes', 'gestores.id_instituicao', '=', 'instituicoes.id')
            ->select('gestores.*', 'instituicoes.nome as nome_instituicao')
            ->where('gestores.id', '=', $id)
            ->get();
        $instituicoes = DB::table('instituicoes')
            ->where('status', '=', 1)
            ->get();
        if (empty($gestor)){
            return 'Gestor nao existe';
        }else {
            return view('gestor/editar')->with('gestor', $gestor)->with('instituicoes',$instituicoes);
        }
    }

    public function update($id)
    {
        $nome = Request()->input('nome');
        $email = Request()->input('email');
        $status = Request()->input('status');
        $id_instituicao = Request()->input('instituicao');

        $gestor =  Gestor::find($id);
        $gestor->nome =  $nome;
        $gestor->email = $email;
        $gestor->status = $status;
        $gestor->id_instituicao = $id_instituicao;
        $gestor->save();

        return redirect()->action('GestorController@listar')->withInput();
    }

    public function alterarStatus($id,$status)
    {
        $gestor =  Gestor::find($id);
        $gestor->status = $status;
        $gestor->save();

        return redirect()->action('GestorController@listar');
    }
}
