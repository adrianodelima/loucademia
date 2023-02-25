<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    session_start();

    $id = @$_GET["id"];
    $login = @$_GET["login"];

    $dao = $factory->getUsuarioDao();

    $dao->reativaUsuario($id, $login);

    header("Location: ../../usuarios.php");

    exit;

?>