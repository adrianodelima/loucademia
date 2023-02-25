<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$fachada = $path . 'fachada.php';

include($fachada);

session_start();

$id = @$_GET["id"];
$tipo = @$_GET["tipo"];

$dao = $factory->getUsuarioDao();

if($dao->inativaUsuario($id, $tipo)){
    if ($id == $_SESSION["id"]){
        header("Location: /Loucademia/application/service/executa_logout.php");
    }else{
        header("Location: /Loucademia/usuarios.php");
    }
}else{
    header("Location: /Loucademia/usuarios.php");
}

exit;

?>