@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row">
                <div class="col-sm-12 col-md-6"> <!--coluna-pequena-ocupando 12(tudo) ou se for no tamanho médio col-md-6-->
                    <h1>Editar Time</h1>
                </div>
                <div class="col-sm-12 col-md-6" style="text-align: right">
                    <a href="{{ route('teams-index') }}" class="btn btn-md btn-primary">Voltar</a>
                </div>
            </div>
        </div>

        <div class="pt-3 mt-2"> <!--pt-3: espaço entre a linha de cima | mt-2: margem-->

            <div class="col-sm-12">

                <h5>Informe os dados do time:</h5>

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
                <form action="{{ route('teams-update', ['id' => $team->id ]) }}" method="POST">
                    @csrf
                    @method('PUT') <!--forçando método 'PUT'-->

                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input value="{{ $team->name }}" type="text" id="name" name="name" required class="form-control" placeholder="Informe um nome para o time...">
                    </div>

                    <div class="form-group mt-3">
                        <label for="country">País:</label>
                        <input value="{{ $team->country }}" type="text" id="country" name="country" required class="form-control" placeholder="Informe um país para o time...">
                    </div>

                    <div class="form-group mt-3">
                        <label for="foundation_year">Data de Fundação:</label>
                        <input value="{{ $team->foundation_year }}" type="number" id="foundation_year" name="foundation_year" required class="form-control" step="1" placeholder="Informe um ano para o time...">
                    </div>
                    <!--step="1": só aceita números inteiros-->
                    <!--required: campo obrigatório-->

                    <div class="form-group mt-3" style="text-align: right"> <!--mt: margin-top-->
                        <button type="submit" class="btn btn-md btn-primary">Salvar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection