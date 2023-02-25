<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$domain_treino = '/Loucademia/domain/treino/';
$verifica = $path . 'verifica.php';
$header = $path . 'layout_header.php';
$fachada = $path . 'fachada.php';
$footer = $path . 'layout_footer.php';

include($verifica);
include($fachada);

$id = @$_GET["id"];
$nome_treino = @$_GET["nome_treino"];

$dao = $factory->getUsuarioDao();

$usuario = $dao->buscaPorIdUsuario($id);

$page_title = "Treinos de " . $usuario->getNome();

include($header);

$usuario = $dao->buscaPorIdUsuario($id);

$dao = $factory->getTreinoUsuarioDao();

if ($nome_treino != null){
    $treinos_usuario = $dao->buscaNomeTreinoUsuario($id, $nome_treino);
}else{
    $treinos_usuario = $dao->buscaTodosTreinosUsuario($id);
}
?>
<main class="mb-5 pb-5 m-md-0">
    <div class="container py-5 h-100">
        <h4 class="text-center">Treinos de <?php echo $usuario->getNome();?></h4>
        <div class="justify-content-center align-items-center h-100">
            <div class="mb-3">
                <div class="row mt-5 justify-content-center">
                    <div class="col-8 col-md-5">
                        <form action="visualiza_treinos_usuario.php" class="justify-content-center justify-content-md-start mb-md">
                            <div class="input-group">
                                <input type="text" class="form-control" name="nome_treino" placeholder="Digite aqui o nome do treino" />
                                <button class="btn btn-primary">Buscar</button>
                            </div>
                            <input type='hidden' name='id' value='<?php echo $id;?>'/>
                            <input type='hidden' name='nome' value='<?php echo $usuario->getNome();?>'/>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container col-md-10">
                <div class="p-3 py-4">
                    <div class="mb-5 text-center">
                        <?php
                            echo "<a class='btn btn-success profile-button' href=" . $domain_treino .  "novo_treino_usuario.php?id_usuario=" . $id . ">Vincular a um treino</a>";
                        ?>
                    </div>
                 
                    <table class='table text-center'>
                        <tr>
                            <th>Nome</th>
                            <th>Instrutor</th>
                            <th>Carga</th>
                            <th>Quantidade de repetições</th>
                            <th>Série</th>
                            <th></th>
                        </tr>
                        <?php
                            if($treinos_usuario){
                                foreach ($treinos_usuario as $treino_usuario){
                                    $dao = $factory->getTreinoDao();
                                    $treino = $dao->buscaPorIdTreino($treino_usuario->getIdTreino());

                                    $dao = $factory->getUsuarioDao();
                                    $instrutor = $dao->buscaPorIdUsuario($treino->getIdInstrutor());

                                    $dao = $factory->getTreinoUsuarioDao();
                                    $treinoUsuario = $dao->buscaUmTreinoUsuario($id, $treino_usuario->getIdTreino());

                                    echo "<tr>
                                              <td>" . $treino->getNome() . "</td>
                                              <td>" . $instrutor->getNome() . "</td>
                                              <td>" . $treinoUsuario->getCarga() . "</td>
                                              <td>" . $treinoUsuario->getQtdRepeticao() . "</td>
                                              <td>" . $treinoUsuario->getSerie() . "</td>
                                              <td><a class='btn btn-success' href=" . $domain_treino . "modifica_treino_usuario.php?id_usuario=" . $id . "&id_treino=" . $treino->getId() . "><i class='fa fa-edit'></i></a>
                                                  <a class='btn btn-danger' href=" .$domain_treino .  "remove_treino_usuario.php?id_usuario=" . $id . "&id_treino=" . $treino->getId() . " onclick='return confirm(\"Confirma a desvinculação?\")'><i class='fa fa-trash'></i></a></td>
                                          </tr>";
                                }
                            }    
                        ?>
                    </table>

                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" onclick="location.href='../../home.php'">Voltar para home</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    include($footer);
?>