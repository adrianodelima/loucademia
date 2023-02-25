<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    $login = @$_GET["login"];
    $senha = @$_GET["senha"];
    $nome = @$_GET["nome"];
    $cpf = @$_GET["cpf"];
    $dataNascimento = @$_GET["dataNascimento"];
    $sexo = @$_GET["sexo"];
    $email = @$_GET["email"];
    $telefone = @$_GET["telefone"];
    $situacao = @$_GET["situacao"];
    $tipo = @$_GET["tipo"];
    $rua = @$_GET["rua"];
    $numero = @$_GET["numero"];
    $complemento = @$_GET["complemento"];
    $estado = @$_GET["estado"];
    $cidade = @$_GET["cidade"];
    $cep = @$_GET["cep"];

    if($senha == null){
        $senha = $login;
    }

    $endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
    $usuario = new Usuario(null, $login, $senha, $nome, $cpf, $dataNascimento, $sexo, $email, $telefone, $situacao, $tipo, $endereco);

    $dao = $factory->getUsuarioDao();
    $dao->insereUsuario($usuario);

    header("Location: ../../home.php");
    exit;
    
?>