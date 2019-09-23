@extends('principal')
@section('title', 'Listagem de Cursos')

@section('content')
    <script type="text/javascript">
        function apagar(url) {
            if (window.confirm('Deseja realmente apagar ?')){
                window.location = url;
            }
        }
    </script>

    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <h1>Lista de Cursos</h1>
            </div>
            @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                <div class="row">
                    <a class="btn btn-sm btn-success" href="{{ action("CursoController@cadastro") }}">Cadastrar</a>
                </div>
            @endif
        </div><br />

        <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <td>CÓD.</td>
                <td>NOME</td>
                <td>DURAÇÃO</td>
                <td>STATUS</td>
                <td>AÇÃO</td>
            </tr>
            @foreach($cursos as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->nome }}</td>
                    <td>{{ $value->duracao }}</td>
                    @if($value->status == 1)
                        <td>ATIVO</td>
                    @else
                        <td>INATIVO</td>
                    @endif
                    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                         <td><a class="btn btn-sm btn-info" href="{{ action("CursoController@editar", $value->id) }}">EDITAR</a>&nbsp;<a class="btn btn-sm btn-danger" href="#" onclick="apagar('{{ action("CursoController@apagar", $value->id) }}');">APAGAR</a></td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </table>
    </div>
@stop
