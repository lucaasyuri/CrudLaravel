@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row">
                <div class="col-sm-12 col-md-6"> <!--coluna-pequena-ocupando 12(tudo) ou se for no tamanho médio col-md-6-->
                    <h1>Cadastrar Jogador</h1>
                </div>
                <div class="col-sm-12 col-md-6" style="text-align: right">
                    <a href="{{ route('players-index') }}" class="btn btn-md btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <div class="pt-3 mt-2"> <!--pt-3: espaço entre a linha de cima | mt-2: margem-->

            <div class="col-sm-12">

                <h5>Informe os dados do Jogador:</h5>

                <br>

                @if ($errors->any()) <!-- $errors->any(): se houver algum erro cai dentro deste 'if' | mensagens de erros na tela -->
                    <div class="alert alert-danger">
                        <ul> <!-- lista -->

                            @foreach ($errors->all() as $error)
                            <!-- buscando todos os erros e para cada erro vou exibir a mensagem dele -->

                            <li>{{ $error }}</li>

                            @endforeach

                        </ul>
                    </div>
                @endif

            </div>

            <div class="col-sm-12 mt-3">
                <form action="{{ route('players-store') }}" method="POST">
                    @csrf
                    @method('POST') <!--forçando método 'POST'-->

                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" id="name" name="name" required class="form-control" placeholder="Informe um nome para o jogador...">
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="country">País:</label>
                        <input type="text" id="country" name="country" required class="form-control" placeholder="Informe um país para o jogador...">
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="number">Número:</label>
                        <input type="number" id="number" min="0" max="99" step="1" name="number" required class="form-control" placeholder="Informe um número para o jogador...">
                    </div>
                    <!--step="1": só aceita números inteiros-->

                    <br>

                    <div class="form-group">
                        <label for="position">Posição:</label>
                        <input type="text" id="position" name="position" required class="form-control" placeholder="Informe uma posição para o jogador...">
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="born_at">Data de Nascimento:</label>
                        <input type="date" id="born_at" name="born_at" required class="form-control" step="1" placeholder="Informe um ano para o jogador...">
                    </div>
                    <!--step="1": só aceita números inteiros-->
                    <!--required: campo obrigatório-->

                    <br>

                    <!--listando os times-->
                    <div class="form-group">
                        <label for="team_id">Time:</label>
                        <select name="team_id" id="team_id" class="form-control" required>
                            <option>Selecione o time do jogador...</option>

                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group mt-3" style="text-align: right"> <!--mt: margin-top-->
                        <button type="submit" class="btn btn-md btn-primary">Salvar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection