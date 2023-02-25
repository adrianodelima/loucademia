<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    $id = @$_GET["id"];

    $nome = @$_GET["nome"];

    $id_instrutor = @$_GET["id_instrutor"];

    $treino = new Treino($id, $nome, $id_instrutor);
    $dao = $factory->getTreinoDao();

    $dao->alteraTreino($treino);

    header("Location: ../../treinos.php");
    exit;
    
?>