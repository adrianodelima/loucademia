<?php
include_once "../../fachada.php";

$id_usuario = @$_GET["id_usuario"];

$dao = $factory->getAcessoDao();
$dao->insereSaida($id_usuario);

header("Location: /Loucademia/acessos.php");
exit;

?>