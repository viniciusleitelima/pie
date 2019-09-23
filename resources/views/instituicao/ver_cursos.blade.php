@extends('principal')
@section('title', 'Listagem de Cursos da Instituição')

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
                <h1>Lista de Cursos da {{$cursos[0]->nome_instituicao}}</h1>
            </div>

            @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                <div class="row">
                    <a class="btn btn-sm btn-success" href="{{ action("InstituicaoController@cadastrarCursos",$cursos[0]->id_instituicao)}}">Cadastrar</a>
                </div>
            @endif
        </div><br />

        <table width="100%" class="table table-striped table-bordered table-hover">
            <tr>
                <td>COD. CURSO</td>
                <td>CURSO</td>
                <td>STATUS</td>
                <td>AÇÃO</td>
            </tr>
            @foreach($cursos as $i)
                <tr>
                    <td>{{ $i->id_curso }}</td>
                    <td>{{ $i->nome_curso }}</td>
                    @if($i->status == 1)
                        <td>ATIVO</td>
                    @else
                        <td>INATIVO</td>
                    @endif
                    @if ((Auth::user()->email == 'carla.freitas@teste.com') or (Auth::user()->email == 'pedro.silva@teste.com'))
                        <td>
                            @if($i->status == 1)
                                @php($status = 0)
                                <a class="btn btn-sm btn-warning" href="{{ action("InstituicaoController@alterarCurso", [$i->id, $status] ) }}">INATIVAR</a>&nbsp;
                            @else
                                @php($status = 1)
                                <a class="btn btn-sm btn-warning" href="{{ action("InstituicaoController@alterarCurso", [$i->id, $status]) }}">ATIVAR</a>&nbsp;
                            @endif

                            <a class="btn btn-sm btn-danger" href="#" onclick="apagar('{{ action("InstituicaoController@apagar", $i->id) }}');">APAGAR</a>
                        </td>
                     @else
                        <td></td>
                     @endif

                </tr>
            @endforeach
        </table>
    </div>
@stop
