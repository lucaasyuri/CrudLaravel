@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-6"> <!--coluna-pequena-ocupando 12(tudo) ou se for no tamanho médio col-md-6-->
                <h1>Jogadores</h1>
            </div>
            <div class="col-sm-12 col-md-6" style="text-align: right">
                <a href="{{ route('players-create') }}" class="btn btn-md btn-success">Adicionar</a>
            </div>
        </div>

        <!-- Filtro -->
        <div class="row">

            <!-- col-sm-0: quando tela pequena some, col-md-6: quando for média, vai ter espaço de 6-->
            <div class="col-sm-0 col-md-6"></div>

            <!-- col-sm-12: quando tela pequena ocupa toda a tela, col-md-6: quando for média, vai ter espaço de 6-->
            <div class="col-sm-12 col-md-6">
                <form method="GET">
                    <!-- método 'get', pois faz uma request na própria url | action: vai ser a própria página-->

                    <div class="input-group mb-3 mt-2">

                        <input type="text" class="form-control" placeholder="pesquisar" name="queryPesquisa" value="{{ $queryPesquisa }}">
                        
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                            <a href="{{ route('players-index') }}" class="btn btn-danger">Limpar</a>
                        </div>

                    </div>

                </form>
            </div>

        </div>

        <div class="row pt-3 mt-2"> <!--pt-3: espaço entre a linha de cima | mt-2: margem-->
            <div class="col-sm-12">
                <div class="table responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Posição</th>
                                <th>Número</th>
                                <th>País</th>
                                <th>Data de Nascimento</th>
                                <th>Time</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($players as $player)
                                <tr>
                                    <th>{{ $player->id }}</th>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->position }}</td>
                                    <td>{{ $player->number }}</td>
                                    <td>{{ $player->country }}</td>
                                    <td>{{ $player->born_at->format('d-m-Y') }}</td>
                                    <td>{{ $player->team->name }}</td> <!--team: função 'team' na Model-->
                                    <td class="d-flex"> <!--dflex: alinhando os botões-->
                                        
                                        <!-- Edit -->
                                        <!--mr-1: margin-right-->
                                        <a href="{{ route('players-edit', ['id' => $player->id]) }}" class="btn btn-sm btn-primary" style="margin-right: 3px">Editar</a>

                                        <!-- Delete -->
                                        <form action="{{ route('players-destroy', ['id' => $player->id ]) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <!--forçando método 'DELETE'-->

                                            <button type="submit" class="btn btn-sm btn-danger">Deletar</button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>

                    <!-- Paginação -->
                    <!--pagination justify-content-end: alinhado à direita da página-->
                    <div class="pagination justify-content-end">
                        {{ $players->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>



@endsection