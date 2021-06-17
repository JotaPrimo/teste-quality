<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />

    <link type="text/css" rel="stylesheet" href="{{ asset('css/principal.css') }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


    <title>Cadastro de Pessoas</title>
</head>

<body>

<div id="conteudoGeral">

    <div id="topoGeral">
        <div id="logoTopo" onclick="location.href='index.php'" style="cursor:pointer;"></div>
        <div id="dirTopo"></div>
    </div>

    <div id="baixoGeral">

        <div id="menuEsq">
            <div id="titMenu">Menu de Opções</div>
            <a href="{{ route('inicio') }}">Início</a>
            <a href="{{ route('cadastros.index') }}">Listar Cadastros</a>
            <a href="{{ route('incluir-novo') }}">Incluir Novo</a>
        </div>
        <div id="conteudoDir">

            @yield('content')

        </div> <!-- FIM CONTEUDO DIR -->


    </div>

</div>

</body>
</html>
