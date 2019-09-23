@extends('principal')
@section('title', 'Edição de Aluno')

@section('content')
    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Editar Gestor - {{$gestor[0]->nome}}</h1>
    <div class="container">
        <form action="{{ action('GestorController@update', $gestor[0]->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="update" value="update">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" value="{{$gestor[0]->nome}}">
            </div>
            <div class="form-group">
                <label>EMAIL:</label>
                <input type="email" name="email" value="{{$gestor[0]->email}}" class="form-control">
            </div>
            <div class="form-group">
                <label>STATUS:</label>
                <select name="status" class="form-control" required>
                    @if( $gestor[0]->status == 1)
                        <option selected="selected" name="status" value="1">ATIVO</option>
                        <option  name="status" value="0">INATIVO</option>
                    @else
                        <option selected="selected" name="status" value="1">ATIVO</option>
                        <option  name="status" value="0">INATIVO</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>Instituição:</label>
                <select name="instituicao" class="form-control" required>
                    @foreach($instituicoes as $i)
                        @if($i->id == $gestor[0]->id_instituicao)
                            <option selected="selected" name="id_instituicao" value="{{$i->id}}">{{$i->nome}}</option>
                        @else
                            <option name="id_instituicao" value="{{$i->id}}">{{$i->nome}}</option>
                        @endif
                    @endforeach
                </select>
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
