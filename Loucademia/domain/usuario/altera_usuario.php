<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$fachada = $path . 'fachada.php';

include($fachada);

$id = @$_GET["id"];
$login = @$_GET["login"];
$nome = @$_GET["nome"];
$cpf = @$_GET["cpf"];
$dataNascimento = @$_GET["dataNascimento"];
$sexo = @$_GET["sexo"];
$email = @$_GET["email"];
$telefone = @$_GET["telefone"];
$situacao = @$_GET["situacao"];
$tipo = @$_GET["tipo"];
$rua = @$_GET["rua"];
$numero = @$_GET["numero"];
$complemento = @$_GET["complemento"];
$estado = @$_GET["estado"];
$cidade = @$_GET["cidade"];
$cep = @$_GET["cep"];

$endereco = new Endereco($rua, $numero, $complemento, $estado, $cidade, $cep);
$usuario = new Usuario($id, $login, null, $nome, $cpf, $dataNascimento, $sexo, $email, $telefone, null, $tipo, $endereco);

$dao = $factory->getUsuarioDao();
$dao->alteraUsuario($usuario);

session_start();

if($id == $_SESSION["id"]){
    $usuario = $dao->buscaPorIdUsuario($id);

    $_SESSION["id"] = $usuario->getId(); 
    $_SESSION["nome"] = stripslashes($usuario->getNome());
    $_SESSION["tipo"] = $usuario->getTipo();
}

header("Location: /Loucademia/interfaces/view/visualiza_usuario.php?id=$id");
exit;

?>