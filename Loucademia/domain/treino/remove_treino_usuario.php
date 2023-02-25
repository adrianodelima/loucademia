<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    $id_usuario = @$_GET["id_usuario"];
    $id_treino = @$_GET["id_treino"];

    $dao = $factory->getTreinoUsuarioDao();
    $dao->removeTreinoUsuario($id_usuario, $id_treino);

    $dao = $factory->getUsuarioDao();
    $usuario = $dao->buscaPorIdUsuario($id_usuario);

    header("Location: /Loucademia/interfaces/view/visualiza_treinos_usuario.php?id=" . $usuario->getId() . "&nome=" . $usuario->getNome());
    exit;

?>