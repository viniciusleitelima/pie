@extends('principal')
@section('title', 'Cadastro de Alunos')

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
        <form action="{{ action('AlunoController@salvar') }}" method="POST">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}">
            <input type="hidden" name="insert" value="insert">


            <div class="form-group">
                <label>Nome:</label>
                <input type="text" name="nome" value="{{old('nome')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CPF:</label>
                <input type="text" name="cpf" value="{{old('cpf')}}" class="form-control" maxlength="11" minlength="11">
            </div>
            <div class="form-group">
                <label>DATA DE NASCIMENTO:</label>
                <input type="date" name="dt_nascimento" value="{{old('dt_nascimento')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>EMAIL:</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CELULAR:</label>
                <input type="text" name="celular" value="{{old('celular')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>ENDEREÇO:</label>
                <input type="text" name="endereco" value="{{old('endereco')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>NUMERO:</label>
                <input type="text" name="numero" value="{{old('numero')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>BAIRRO:</label>
                <input type="text" name="bairro" value="{{old('bairro')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>CIDADE:</label>
                <input type="text" name="cidade" value="{{old('cidade')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>UF:</label>
                <input type="text" name="uf" value="{{old('uf')}}" class="form-control">
            </div>
            <div class="form-group">
                <label>STATUS:</label>
                <input type="text" name="status" value="{{old('status')}}" class="form-control">
            </div>

            <div class="form-group">
                <label>Curso:</label>
                <select name="curso" class="form-control" required>
                    @foreach($cursos as $c)
                        <option name="id_curso" value="{{$c->id}}">{{$c->nome}}</option>
                    @endforeach
                </select>
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
