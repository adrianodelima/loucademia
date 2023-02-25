<?php
include "verifica.php";

$id = @$_GET["id"];

$page_title = "Pagamento";

include_once "layout_header.php";
include_once "fachada.php";
?>

<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-7">
            <div class="p-3 py-4">
                <div class="text-center">
                    <?php
                        $dao = $factory->getTreinoUsuarioDao();
                        $treinos_usuario = $dao->buscaTodosTreinosUsuario($id);

                        if(!$treinos_usuario){
                            $pendente = false;
                        }else{
                            $dao = $factory->getPagamentoDao();
                            $ultimo_mes = $dao->buscaUltimoMesPagamento($id);
                            $ultimo_ano = $dao->buscaUltimoAnoPagamento($id);

                            if($ultimo_mes != null){
                                if($ultimo_mes == date('m') && $ultimo_ano == date('Y')){
                                    $pendente = false;
                                }else{
                                    $pendente = true;
                                };
                            }else{
                                $pendente = true;
                            }
                        }

                        if($pendente){
                            $valor = 0;
                            foreach($treinos_usuario as $treino){
                                $valor = $valor + 50;
                            }

                            echo "<h1>Pendente de pagamento!</h1>
                                  <h5 class='mt-5'>Valor a pagar: R$ " . number_format($valor, 2, ',', '.') . "</h5>
                                  <div class='d-flex flex-row-reverse mt-5'>
                                      <a class='w-100 btn btn-success btn-lg' href='/Loucademia/domain/pagamento/pagar.php?id=" . $id . "&valor=" . $valor . "'>Pagar</a>
                                  </div>";
                        }else{
                            echo "<h1>Tudo certo!</h1>
                                  <p>Nada pendente de pagamento!</p>";
                        }
                    ?>
                </div>
                <hr class="my-4">
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" onclick="location.href='home.php'" type="button">Voltar para home</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "layout_footer.php";
?>