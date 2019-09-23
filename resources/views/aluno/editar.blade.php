@extends('principal')
@section('title', 'Edição de Aluno')

@section('content')
    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
    <h1>Editar Aluno - {{$aluno[0]->nome}}</h1>
    <div class="container">
        <form action="{{ action('AlunoController@update', $aluno[0]->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="update" value="update">
            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" class="form-control" value="{{$aluno[0]->nome}}">
            </div>
            <div class="form-group">
                <label>CPF:</label>
                <input type="text" name="cpf" value="{{$aluno[0]->cpf}}" class="form-control" maxlength="11" minlength="11">
            </div>
            <div class="form-group">
                <label>DATA DE NASCIMENTO:</label>
                <input type="date" name="dt_nascimento" value="{{$aluno[0]->dt_nascimento}}" class="form-control">
            </div>
            <div class="form-group">
                <label>EMAIL:</label>
                <input type="email" name="email" value="{{$aluno[0]->email}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CELULAR:</label>
                <input type="text" name="celular" value="{{$aluno[0]->celular}}" class="form-control">
            </div>
            <div class="form-group">
                <label>ENDEREÇO:</label>
                <input type="text" name="endereco" value="{{$aluno[0]->endereco}}" class="form-control">
            </div>
            <div class="form-group">
                <label>NUMERO:</label>
                <input type="text" name="numero" value="{{$aluno[0]->numero}}" class="form-control">
            </div>
            <div class="form-group">
                <label>BAIRRO:</label>
                <input type="text" name="bairro" value="{{$aluno[0]->bairro}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CIDADE:</label>
                <input type="text" name="cidade" value="{{$aluno[0]->cidade}}" class="form-control">
            </div>
            <div class="form-group">
                <label>UF:</label>
                <input type="text" name="uf" value="{{$aluno[0]->uf}}" class="form-control">
            </div>

            <div class="form-group">
                <label>STATUS:</label>
                <select name="status" class="form-control" required>
                    @if( $aluno[0]->status == 1)
                        <option selected="selected" name="status" value="1">ATIVO</option>
                        <option  name="status" value="0">INATIVO</option>
                    @else
                        <option selected="selected" name="status" value="1">ATIVO</option>
                        <option  name="status" value="0">INATIVO</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>Curso:</label>
                <select name="curso" class="form-control" required>
                    @foreach($cursos as $c)
                        @if($c->id == $aluno[0]->id_curso)
                            <option selected="selected" name="id_curso" value="{{$c->id}}">{{$c->nome}}</option>
                        @else
                            <option name="id_curso" value="{{$c->id}}">{{$c->nome}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Instituição:</label>
                <select name="instituicao" class="form-control" required>
                    @foreach($instituicoes as $i)
                        @if($i->id == $aluno[0]->id_instituicao)
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
