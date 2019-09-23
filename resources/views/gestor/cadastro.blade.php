@extends('principal')
@section('title', 'Cadastro de Gestor')

@section('content')
    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Cadastro de Gestor</h1>
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
        <form action="{{ action('GestorController@salvar') }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="insert" value="insert">


            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" value="{{old('nome')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>EMAIL:</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>STATUS:</label>
                <input type="text" name="status" value="{{old('status')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>Instituição:</label>
                <select name="instituicao" class="form-control" required>
                    @foreach($instituicoes as $i)
                        <option name="id_instituicao" value="{{$i->id}}">{{$i->nome}}</option>
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
