<?php
include_once "../../fachada.php";

$id = @$_GET["id"];
$valor = @$_GET["valor"];
$foiPeloAcesso = (bool)@$_GET["foiPeloAcesso"];

$pagamento = new Pagamento($id, null, $valor);
$dao = $factory->getPagamentoDao();

$dao->inserePagamento($pagamento);

if($foiPeloAcesso){
    header("Location: /Loucademia/acessos.php");
}else{
    header("Location: /Loucademia/home.php");
}
exit;
?>