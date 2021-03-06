@extends('principal')
@section('title', 'Listagem de Instituições')

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
                <h1>Lista de Instituições</h1>
            </div>
            @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                <div class="row">
                    <a class="btn btn-sm btn-success" href="{{ action("InstituicaoController@cadastro") }}">Cadastrar</a>
                </div>
            @endif
        </div><br />

        <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <td>ID</td>
                <td>NOME</td>
                <td>CNPJ</td>
                <td>STATUS</td>
                <td>AÇÃO</td>
            </tr>
            @foreach($instituicoes as $i)
                <tr>
                    <td>{{ $i->id }}</td>
                    <td>{{ $i->nome }}</td>
                    <td>{{ $i->cnpj }}</td>
                    @if($i->status == 1)
                        <td>ATIVO</td>
                    @else
                        <td>INATIVO</td>
                    @endif
                    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ action("InstituicaoController@verCursos", $i->id) }}">VER CURSOS</a>
                            &nbsp;
                            <a class="btn btn-sm btn-info" href="{{ action("InstituicaoController@editar", $i->id) }}">EDITAR</a>
                            &nbsp;
                            @if($i->status == 1)
                                @php($status = 0)
                                <a class="btn btn-sm btn-secondary" href="{{ action("InstituicaoController@alterarStatus", [$i->id, $status] ) }}">INATIVAR</a>&nbsp;
                            @else
                                @php($status = 1)
                                <a class="btn btn-sm btn-success" href="{{ action("InstituicaoController@alterarStatus", [$i->id, $status]) }}">ATIVAR</a>&nbsp;
                            @endif
                        </td>
                    @else
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ action("InstituicaoController@verCursos", $i->id) }}">VER CURSOS</a>
                        </td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
@stop
