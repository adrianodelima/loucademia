<?php
include_once "../../fachada.php";

$id = @$_POST["id"];
$login = @$_POST["login"];
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE;

$dao = $factory->getUsuarioDao();
$dao->alteraSenhaPendente($id, $login, $senha);

$usuario = $dao->buscaPorIdUsuario($id);

session_start();

$_SESSION["id"] = $usuario->getId(); 
$_SESSION["nome"] = stripslashes($usuario->getNome());
$_SESSION["tipo"] = $usuario->getTipo();

header("Location: /Loucademia/home.php");
exit;

?>