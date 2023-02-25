<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$header = $path . 'layout_header.php';
$fachada = $path . 'fachada.php';
$footer = $path . 'layout_footer.php';
$home = $path . 'home.php';

$page_title = "Relatório de acessos";

include($header);
include($fachada);

$data_considerar = @$_GET["data_considerar"];

if(!$data_considerar){
    $data_considerar = date('y-m-d');
}

$data_considerar = strtotime($data_considerar);
$data_considerar = date("d/m/Y", $data_considerar);

$acessos = null;

$dao = $factory->getAcessoDao();
$acessos = $dao->buscaPorDataAcessos($data_considerar);

?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <h4 class="text-center"><?php echo "Relatório de acessos - " . $data_considerar;?></h4>
        <div class="mb-3">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-lg-3">
                    <form action="relatorio_acessos.php" class="justify-content-center justify-content-md-start mb-3 mb-md 0">
                        <div class="row">
                            <div class="col input-group">
                                <input type="date" class="form-control" name="data_considerar"/>
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php

if($acessos){
    echo "<div class='container col-md-10'>
              <div class='p-3 py-4'>
                  <table class='table text-center'>
                      <tr>
                          <th>Nome</th>
                          <th>Tipo</th>
                          <th>Entrada</th>
                          <th>Saída</th>
                      </tr>";

    $dao = $factory->getUsuarioDao();

    foreach($acessos as $acesso){
        $usuario = $dao->buscaPorIdUsuario($acesso->getIdUsuario());

        echo "<tr>
                  <td>" . $usuario->getNome() . "</td>
                  <td class='text-capitalize'>" . $usuario->getTipo() . "</td>
                  <td>" . $acesso->getEntrada() . "</td>
                  <td>" . $acesso->getSaida() . "</td>
              </th>";
    }

            echo "</table>
              </div>
          </div>";
}
?>
    </div>
    <div class="mt-5 text-center">
        <button class="btn btn-primary profile-button" onclick="location.href='../../home.php'">Voltar para home</button>
    </div>
</div>

<?php
    include($footer);
?>