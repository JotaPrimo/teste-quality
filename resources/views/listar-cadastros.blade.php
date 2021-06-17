<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Cadastro de Pessoas</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('inicio') }}">Início</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('cadastros.index') }}">Listar Cadastros <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('incluir-novo') }}">Incluir novo</a>
            </li>
        </ul>

    </div>
</nav>



<div class="container mt-3">

    @include('alerts.alerts')

    <div class="row mt-5">
        <div class="col-sm">

        </div>
        <div class="col-10">
            <div class="card">

                <div class="card-header">
                    Cadastros
                </div>

                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Dt Nascimento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Dep</th>
                            <th scope="col">St</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cadastros as $cadastro)
                        <tr>
                            <td> {{ $cadastro->id }} </td>

                            <td>
                                <img src="{{ url('storage/cadastros/'.$cadastro->file_name) }}" alt="Imagem">
                            </td>

                            <td> {{ $cadastro->nome }} </td>
                            <td> {{ $cadastro->dt_nascimento }} </td>
                            <td> {{ $cadastro->email }} </td>
                            <td>
                                <button class="btn btn-primary">Dependente</button>
                            </td>
                            <td>
                                @if( $cadastro->status == \App\Models\Cadastro::STATUS_ATIVO)
                                    <a href="{{ route('cadastro.desativar', $cadastro->id) }}">
                                        <button class="btn btn-success" title="Mudar status para inativo">o</button>
                                    </a>
                                @elseif($cadastro->status == \App\Models\Cadastro::STATUS_INATIVO)
                                    <a href="{{ route('cadastro.ativar', $cadastro->id) }}">
                                        <button class="btn btn-secondary" title="Mudar status para ativo">x</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach



                        </tbody>
                    </table>


                </div>

            </div>

        </div>


        <div class="col-sm">

        </div>

    </div>

</div>

<div class="mx-auto mt-3" style="width: 200px;">
    {{ $cadastros->links() }}
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
