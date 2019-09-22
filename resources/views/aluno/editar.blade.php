@extends('principal')
@section('title', 'Edição de Aluno')

@section('content')
    <h1>Editar Aluno - {{$aluno->nome}}</h1>
    <div class="container">
        <form action="{{ action('AlunoController@update', $aluno->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="update" value="update">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" value="{{$aluno->nome}}">
            </div>
            <div class="form-group">
                <label>CPF:</label>
                <input type="text" name="cpf" value="{{$aluno->cpf}}" class="form-control" maxlength="11" minlength="11">
            </div>
            <div class="form-group">
                <label>DATA DE NASCIMENTO:</label>
                <input type="date" name="dt_nascimento" value="{{$aluno->dt_nascimento}}" class="form-control">
            </div>
            <div class="form-group">
                <label>EMAIL:</label>
                <input type="email" name="email" value="{{$aluno->email}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CELULAR:</label>
                <input type="text" name="celular" value="{{$aluno->celular}}" class="form-control">
            </div>
            <div class="form-group">
                <label>ENDEREÇO:</label>
                <input type="text" name="endereco" value="{{$aluno->endereco}}" class="form-control">
            </div>
            <div class="form-group">
                <label>NUMERO:</label>
                <input type="text" name="numero" value="{{$aluno->numero}}" class="form-control">
            </div>
            <div class="form-group">
                <label>BAIRRO:</label>
                <input type="text" name="bairro" value="{{$aluno->bairro}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CIDADE:</label>
                <input type="text" name="cidade" value="{{$aluno->cidade}}" class="form-control">
            </div>
            <div class="form-group">
                <label>UF:</label>
                <input type="text" name="uf" value="{{$aluno->uf}}" class="form-control">
            </div>

            <div class="form-group">
                <label>STATUS:</label>
                <input type="text" name="status" class="form-control" value="{{$aluno->status}}">
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </form>
    </div>
@stop
