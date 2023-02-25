<?php

    $path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
    $fachada = $path . 'fachada.php';

    include($fachada);

    $id = @$_GET["id"];

    $dao = $factory->getTreinoDao();
    $dao->removeTreino($id);

    header("Location: ../../treinos.php");
    exit;

?>