@extends('principal')
@section('title', 'Edição de Instituição')

@section('content')
    <h1>Editar Instituição - {{$instituicao->id}}</h1>
    <form action="{{ action('InstituicaoController@update', $instituicao->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <input type="hidden" name="update" value="update">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="{{$instituicao->nome}}">
        </div>
        <div class="form-group">
                <label>CNPJ:</label>
            <input type="text" name="cnpj" class="form-control" value="{{$instituicao->cnpj}}">
        </div>
        <div class="form-group">
            <label>STATUS:</label>
            <input type="text" name="status" class="form-control" value="{{$instituicao->status}}">
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>
@stop
