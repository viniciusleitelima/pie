@extends('principal')
@section('title', 'Edição de Curso')

@section('content')
    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Editar Curso - {{$curso->id}}</h1>
    <div class="container">
        <form action="{{ action('CursoController@update', $curso->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="update" value="update">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" value="{{$curso->nome}}">
            </div>
            <div class="form-group">
                <label>DURAÇÃO:</label>
                <input type="text" name="duracao" class="form-control" value="{{$curso->duracao}}">
            </div>
            <div class="form-group">
                <label>STATUS:</label>
                <input type="text" name="status" class="form-control" value="{{$curso->status}}">
            </div>
            <button type="submit" class="btn btn-success">Atualizar</button>
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
