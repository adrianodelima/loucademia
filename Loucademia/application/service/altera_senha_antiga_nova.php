<?php
include_once "../../fachada.php";

$id = $_POST["id"];
$login = $_POST["login"]; 
$senha_antiga = isset($_POST["senha_antiga"]) ? trim($_POST["senha_antiga"]) : FALSE;
$senha_nova = isset($_POST["senha_nova"]) ? trim($_POST["senha_nova"]) : FALSE;

$dao = $factory->getUsuarioDao();  
$usuario = $dao->buscaPorIdUsuario($id);
$senhaMontadaAntiga = md5($login.$senha_antiga);

if(!strcmp($senhaMontadaAntiga, $usuario->getSenha())){
    $dao->alteraSenhaAntigaNovaUsuario($id, $login, $senha_nova);
}

header("Location: /Loucademia/interfaces/view/visualiza_usuario.php?id=$id");
exit;

?>