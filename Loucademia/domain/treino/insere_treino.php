<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include ($fachada);

    $nome = @$_GET["nome"];
    $id_instrutor = @$_GET["id_instrutor"];

    $treino = new Treino(null, $nome, $id_instrutor);
    $dao = $factory->getTreinoDao();

    $dao->insereTreino($treino);

    header("Location: ../../home.php");
    exit;
?>