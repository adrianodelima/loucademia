<?php 

session_start();

error_log("LOGIN");

if(!isset($_SESSION["id"]) || !isset($_SESSION["nome"])) 
{ 
    error_log("SEM USUÁRIO LOGADO - Vai para login.php");
    header("Location: /Loucademia/application/service/login.php"); 
    exit; 
} 
?>