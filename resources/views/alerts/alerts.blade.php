@if (session('dependente-deletado-erro'))

    <div class="alert alert-danger">
        {{ session('dependente-deletado-erro') }}
    </div>

@endif

@if (session('dependente-deletado-success'))

    <div class="alert alert-success">
        {{ session('dependente-deletado-success') }}
    </div>

@endif


@if (session('idade-invalida'))

    <div class="alert alert-danger">
        {{ session('idade-invalida') }}
    </div>

@endif


@if (session('dependente-create-success'))

    <div class="alert alert-success">
        {{ session('dependente-create-success') }}
    </div>

@endif

@if (session('dependente-create-erro'))

    <div class="alert alert-danger">
        {{ session('dependente-create-erro') }}
    </div>

@endif



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


