@extends('principal')
@section('title', 'Cadastro de Instituicao')

@section('content')
@if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Cadastro</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>ERROS</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <form action="{{ action('InstituicaoController@salvar') }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="insert" value="insert">


            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" value="{{old('nome')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CNPJ:</label>
                <input type="text" name="cnpj" value="{{old('cnpj')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>STATUS:</label>
                <select name="status" class="form-control">
                    <option name="status" value="1">ATIVO</option>
                    <option name="status" value="2">INATIVO</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
@else
    <div class="container">
        <div class="alert alert-danger">
            <strong>ACESSO NEGADO</strong>
        </div>
    </div>
@endif
@stop
