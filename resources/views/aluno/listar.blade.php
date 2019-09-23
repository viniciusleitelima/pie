@extends('principal')
@section('title', 'Listagem de Alunos')

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
                <h1>Lista de Alunos</h1>
            </div>
            @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                <div class="row">
                    <a class="btn btn-sm btn-success" href="{{ action("AlunoController@cadastro") }}">Cadastrar</a>
                </div>
            @endif
        </div><br />

        <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <td>CÓD.</td>
                <td>NOME</td>
                <td>CPF</td>
                <td>EMAIL</td>
                <td>CURSO</td>
                <td>INSTITUIÇÃO</td>
                <td>STATUS</td>
                <td>AÇÃO</td>
            </tr>
            @foreach($alunos as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->nome }}</td>
                    <td>{{ $value->cpf }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->nome_curso }}</td>
                    <td>{{ $value->nome_instituicao }}</td>
                    @if($value->status == 1)
                        <td>ATIVO</td>
                    @else
                        <td>INATIVO</td>
                    @endif
                    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                        <td>
                            @if($value->status == 1)
                                @php($status = 0)
                                <a class="btn btn-sm btn-warning" href="{{ action("AlunoController@alterarStatus", [$value->id, $status] ) }}">INATIVAR</a>&nbsp;
                            @else
                                @php($status = 1)
                                <a class="btn btn-sm btn-warning" href="{{ action("AlunoController@alterarStatus", [$value->id, $status]) }}">ATIVAR</a>&nbsp;
                            @endif
                            <a class="btn btn-sm btn-info" href="{{ action("AlunoController@editar", $value->id) }}">VER</a>&nbsp;
                            <a class="btn btn-sm btn-danger" href="#" onclick="apagar('{{ action("AlunoController@apagar", $value->id) }}');">APAGAR</a>
                        </td>
                    @else
                        <td></td>
                    @endif

                </tr>
            @endforeach
        </table>
    </div>
@stop
