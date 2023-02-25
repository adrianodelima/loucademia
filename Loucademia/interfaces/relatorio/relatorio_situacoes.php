<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$header = $path . 'layout_header.php';
$fachada = $path . 'fachada.php';
$footer = $path . 'layout_footer.php';
$home = $path . 'home.php';

$page_title = "Relatório de situações";

include($header);
include($fachada);

$usuarios = null;

$situacao = @$_GET["situacao"];

$dao = $factory->getUsuarioDao();

if($situacao){
    switch($situacao){
        case "ativo":
            $usuarios = $dao->buscaTodosUsuariosAtivos();
            break;

        case "pendente":
            $usuarios = $dao->buscaTodosUsuariosPendentes();
            break;

        case "inativo":
            $usuarios = $dao->buscaTodosUsuariosInativos();
            break;
    }
}else{
    $usuarios = $dao->buscaTodosUsuarios();
}

?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <div class="mb-3">
            <h4 class="text-center">
                <?php
                    echo "Relatório de situações - ";
                
                    if($situacao){
                        switch($situacao){
                            case "ativo":
                                echo "Ativos";
                                break;
                    
                            case "pendente":
                                echo "Pendentes";
                                break;
                    
                            case "inativo":
                                echo "Inativos";
                                break;
                        }
                    }else{
                        echo "Todos";
                    }
                ?>
            </h4>
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-lg-3">
                    <form action="relatorio_situacoes.php" class="justify-content-center justify-content-md-start mb-3 mb-md 0">
                        <div class="row">
                            <div class="col input-group">
                                <select name="situacao" class="form-control form-select">
                                    <option value=""></option>
                                    <option value="ativo">Ativo</option>
                                    <option value="pendente">Pendente</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php

if($usuarios){
    echo "<div class='container col-md-8'>
              <div class='p-3 py-4'>
                  <table class='table text-center'>
                      <tr>
                          <th>Nome</th>
                          <th>Tipo</th>
                          <th>Situação</th>
                      </tr>";

    foreach($usuarios as $usuario){
        echo "<tr>
                  <td>" . $usuario->getNome() . "</td>
                  <td class='text-capitalize'>" . $usuario->getTipo() . "</td>
                  <td class='text-capitalize'>" . $usuario->getSituacao() . "</td>
              </th>";
    }

            echo "</table>
              </div>
          </div>";
}
?>
        <div class="mt-5 text-center">
            <button class="btn btn-primary profile-button" onclick="location.href='../../home.php'">Voltar para home</button>
        </div>
    </div>
</div>

<?php
    include($footer);
?>