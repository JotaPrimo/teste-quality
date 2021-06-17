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

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" id="" data-toggle="modal" data-target="#modal-deletar">
                       Deletar
                    </button>


                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" id="checkAll"></th>
                            <th scope="col">ID</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Dt Nascimento</th>
                            <th scope="col">Email</th>
                            <th scope="col">Dep</th>
                            <th scope="col">St</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($cadastros as $cadastro)
                        <tr id="sid{{ $cadastro->id }}">
                            <td>
                                <input type="checkbox" name="ids" class="checkboxClass" value="{{ $cadastro->id }}">
                            </td>

                            <td> {{ $cadastro->id }} </td>
                            <td>
                                <img src="{{ url('storage/cadastros/'.$cadastro->file_name) }}" alt="Imagem">
                            </td>

                            <td> {{ $cadastro->nome }} </td>
                            <td> {{ $cadastro->dt_nascimento }} </td>
                            <td> {{ $cadastro->email }} </td>
                            <td>

                                <a href="{{ route('cadastros.listar-dependente', $cadastro->id) }}">
                                    <button class="btn btn-primary">Dependente</button>
                                </a>

                            </td>

                            <td>
                                @if( $cadastro->status == \App\Models\Cadastro::STATUS_ATIVO)
                                    <a href="{{ route('cadastros.desativar', $cadastro->id) }}">
                                        <button class="btn btn-success" title="Mudar status para inativo">o</button>
                                    </a>
                                @elseif($cadastro->status == \App\Models\Cadastro::STATUS_INATIVO)
                                    <a href="{{ route('cadastros.ativar', $cadastro->id) }}">
                                        <button class="btn btn-secondary" title="Mudar status para ativo">x</button>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td>
                                    Listagem vazia
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
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


        <div class="col-sm">

        </div>

    </div>

</div>

<div class="mx-auto mt-3" style="width: 200px;">
    {{ $cadastros->links() }}
</div>


@include('modais.modal-delete-cadastro')



<script>
    $(function (e){
       $("#checkAll").click(function (){
           $(".checkboxClass").prop('checked', $(this).prop('checked'));
       });

       $('#deletarTodosSelecionados').click(function (e){
            e.preventDefault();
            var allids = [];
            $("input:checkbox[name=ids]:checked").each(function (){
                allids.push($(this).val());
            });

            $.ajax({
               url: "{{ route('cadastros.delete') }}",
               type: 'DELETE',
                data: {
                    ids:allids,
                    _token:$("input[name=_token]").val()
                },
                success:function(response)
                {
                    $.each(allids, function (key, val) {
                        $('#sid'+val).remove();
                    });
                }
            });
       });

    });
</script>

</body>
</html>
