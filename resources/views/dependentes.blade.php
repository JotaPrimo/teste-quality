<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


    <title>Cadastro de Pessoas</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('inicio') }}">Início</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <th scope="col">Nome</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Dt Nascimento</th>
                            <th scope="col">Email</th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr id="sid{{ $cadastro->id }}">

                            <td> {{ $cadastro->id }} </td>
                            <td>
                                <img src="{{ url('storage/cadastros/'.$cadastro->file_name) }}" alt="Imagem">
                            </td>

                            <td> {{ $cadastro->nome }} </td>
                            <td> {{ $cadastro->dt_nascimento }} </td>
                            <td> {{ $cadastro->email }} </td>

                        </tr>


                        </tbody>


                    </table>

                    <hr>

                    <form action="{{ route('cadastros.add-dependente', $cadastro->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input type="text" class="form-control" name="nome" required placeholder="Nome">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Data de Nascimento</label>
                            <input type="date" class="form-control" name="dt_nascimento" required>
                        </div>


                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>


                    <div class="row mt-5">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                            <tr>

                                <th scope="col">Nome</th>
                                <th scope="col">Dt Nascimento</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($cadastro->dependentes as $dependente)
                                <tr>
                                    <td> {{ $dependente->nome }} </td>
                                    <td> {{ $dependente->dt_nascimento }} </td>
                                    <td>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#modal-deletar-dependente{{ $dependente->id }}">
                                            Remover
                                        </button>

                                    </td>
                                    <td></td>

                                </tr>

                                @include('modais.modal-delete-dependente')
                            @empty
                                <tr>
                                    <td>Listagem vazia</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforelse


                            </tbody>


                        </table>
                    </div>


                </div>


            </div>

        </div>


        <div class="col-sm">

        </div>

    </div>

</div>


@include('modais.modal-delete-cadastro')


<script>
    $(function (e) {
        $("#checkAll").click(function () {
            $(".checkboxClass").prop('checked', $(this).prop('checked'));
        });

        $('#deletarTodosSelecionados').click(function (e) {
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function () {
                allids.push($(this).val());
            });

            $.ajax({
                url: "{{ route('cadastros.delete') }}",
                type: 'DELETE',
                data: {
                    ids: allids,
                    _token: $("input[name=_token]").val()
                },
                success: function (response) {
                    $.each(allids, function (key, val) {
                        $('#sid' + val).remove();
                    });
                }
            });
        });

    });
</script>

</body>
</html>
