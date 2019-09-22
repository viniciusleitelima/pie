@extends('principal')
@section('title', 'Cadastro de Curso')

@section('content')
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
    {{count($errors)}}
    <form action="{{ action('CursoController@salvar') }}" method="POST">
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
        <input type="hidden" name="insert" value="insert">


        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" value="{{old('nome')}}" class="form-control">
        </div>
        <div class="form-group">
            <label>DURAÇÃO:</label>
            <input type="text" name="duracao" value="{{old('duracao')}}" class="form-control">
        </div>
        <div class="form-group">
            <label>STATUS:</label>
            <input type="text" name="status" value="{{old('status')}}" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@stop
