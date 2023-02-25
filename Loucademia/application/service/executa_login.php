<?php 
require "../../fachada.php"; 
 
session_start();

$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE; 
$senha = isset($_POST["senha"]) ? trim($_POST["senha"]) : FALSE;

$dao = $factory->getUsuarioDao();   
$usuario = $dao->buscaPorLoginUsuario($login);
$senhaMontada = md5($login.$senha);

$problemas = FALSE;

if($usuario) {
    if(!strcmp($senhaMontada, $usuario->getSenha())){ 
        if($usuario->getSituacao() != "inativo"){
            if ($usuario->getSituacao() == "pendente"){
                $id = $usuario->getId();
                $login = $usuario->getLogin();
                header("Location: /Loucademia/application/service/login_pendente.php?id=$id&login=$login");
                exit;
            }

            $_SESSION["id"] = $usuario->getId(); 
            $_SESSION["nome"] = stripslashes($usuario->getNome());
            $_SESSION["tipo"] = $usuario->getTipo();
            
            header("Location: /Loucademia/home.php");
            exit;
        }else{
            $problemas = TRUE;
        }
    }else{
        $problemas = TRUE;
    }
}else{
    $problemas = TRUE;
}

if($problemas==TRUE) {
    header("Location: /Loucademia/home.php"); 
    exit; 
}
?>