@if (session('create'))

    <div class="alert alert-success">
        {{ session('create') }}
    </div>

@endif


@if (session('error-cadastro'))

    <div class="alert alert-danger">
        {{ session('error-cadastro') }}
    </div>

@endif



@if (session('erro-tamanho-arquivo'))

    <div class="alert alert-danger">
        {{ session('erro-tamanho-arquivo') }}
    </div>

@endif


@if (session('status-alterado-erro'))

    <div class="alert alert-danger">
        {{ session('status-alterado-erro') }}
    </div>

@endif


@if (session('status-alterado-success'))

    <div class="alert alert-success">
        {{ session('status-alterado-success') }}
    </div>

@endif

