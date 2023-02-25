<?php
include "verifica.php";

$page_title = "Acessos";

include_once "layout_header.php";
include_once "fachada.php";

$dao = $factory->getUsuarioDao();

$nome_login = @$_GET["nome_login"];

if($nome_login != null){
	$usuarios = $dao->buscaPorNomeLoginUsuariosAtivos($nome_login);
}else{
    $usuarios = $dao->buscaTodosUsuariosAtivos();
}
?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <h4 class="text-center">Controle de acesso</h4>
        <div class="mb-3">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-md-5">
                    <form action="acessos.php" class="justify-content-center justify-content-md-start mb-3 mb-md 0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nome_login" placeholder="Digite aqui o nome ou o login do usuário" />
                            <button class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container col-md-10">
            <div class="p-3 py-4">
                <table class='table text-center'>
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Tipo</th>
                        <th>Pendência de pagamento</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                    <?php
                        if($usuarios){
                            foreach ($usuarios as $usuario){
                                echo "<tr>
                                          <td>" . $usuario->getNome() . "</td>
                                          <td>" . $usuario->getLogin() . "</td>
                                          <td class='text-capitalize'>" . $usuario->getTipo() . "</td>";

                                $dao = $factory->getAcessoDao();
                                $acesso = $dao->buscaAcessoMaisRecente($usuario->getId());

                                $dao = $factory->getTreinoUsuarioDao();
                                $treinos_usuario = $dao->buscaTodosTreinosUsuario($usuario->getId());

                                if(!$treinos_usuario){
                                    $pendente = false;
                                }else{
                                    $dao = $factory->getPagamentoDao();
                                    $ultimo_mes = $dao->buscaUltimoMesPagamento($usuario->getId());
                                    $ultimo_ano = $dao->buscaUltimoAnoPagamento($usuario->getId());

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
                                    $dao = $factory->getTreinoUsuarioDao();
                                    $treinos_usuario = $dao->buscaTodosTreinosUsuario($usuario->getId());
                                    $valor = 0;
                                    foreach($treinos_usuario as $treino){
                                        $valor = $valor + 50;
                                    }
                                    echo "<td><a class='btn btn-danger' href='/Loucademia/domain/pagamento/pagar.php?id=" . $usuario->getId() . "&valor=" . $valor . "&foiPeloAcesso=true'>Valor a pagar: R$ " . number_format($valor, 2, ',', '.') . "</a></td>";
                                }else{
                                    echo "<th class='text-success'>Sem pendência</th>";
                                }

                                if($acesso){
                                    if($acesso->getSaida() == null){
                                        echo "<th class='text-success'>Presente</th>
                                              <td><a class='btn btn-danger' href='/Loucademia/domain/acesso/insere_saida.php?id_usuario=" . $usuario->getId() . "'>Registrar saída</a></td>";
                                    }else{
                                        echo "<th class='text-danger'>Ausente</th>
                                              <td><a class='btn btn-success' href='/Loucademia/domain/acesso/insere_entrada.php?id_usuario=" . $usuario->getId() . "'>Registrar entrada</a></td>";
                                    }
                                }else{
                                    echo "<th class='text-danger'>Ausente</th>
                                          <td><a class='btn btn-success' href='/Loucademia/domain/acesso/insere_entrada.php?id_usuario=" . $usuario->getId() . "'>Registrar entrada</a></td>";
                                }

                                echo "</tr>";
                            }
                        }    
                    ?>
                </table>    
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