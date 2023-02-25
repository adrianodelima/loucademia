<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    $id_usuario = @$_GET["id_usuario"];
    $id_treino = @$_GET["id_treino"];
    $id_treino_antigo = @$_GET["id_treino_antigo"];
    $carga = @$_GET["carga"];
    $qtd_repeticao = @$_GET["qtd_repeticao"];
    $serie = @$_GET["serie"];

    $treinoUsuario = new TreinoUsuario($id_usuario, $id_treino, $carga, $qtd_repeticao, $serie);
    $dao = $factory->getTreinoUsuarioDao();
    $dao->alteraTreinoUsuario($treinoUsuario, $id_treino_antigo);

    $dao = $factory->getUsuarioDao();
    $usuario = $dao->buscaPorIdUsuario($id_usuario);

    header("Location: /Loucademia/interfaces/view/visualiza_treinos_usuario.php?id=" . $usuario->getId() . "&nome=" . $usuario->getNome());
    exit;

?>