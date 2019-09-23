@extends('principal')
@section('title', 'Cadastro de Instituicao')

@section('content')
@if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Cadastro de cursos para  {{$instituicao->nome}}</h1>
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
    <div class="container">
        <form action="{{ route('selecionar.curso',$instituicao->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="insert" value="insert">

            <div class="form-group">
                <label>Curso:</label>
                <select name="curso" class="form-control">
                    @foreach($cursos as $c)
                        <option name="id_curso" value="{{$c->id}}">{{$c->nome}}</option>
                    @endforeach
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
