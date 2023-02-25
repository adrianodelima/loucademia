<?php
    include "verifica.php";

    $page_title = "Treinos";

    $domain_treino = 'domain/treino/';

    include_once "layout_header.php";
    include_once "fachada.php";

    $dao = $factory->getTreinoDao();

    $nome = @$_GET["nome"];

    if($nome != null){
        $treinos = $dao->buscaPorNomeTreino($nome);
    }else{
        $treinos = $dao->buscaTodosTreinos();
    }

?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <h4 class="text-center">Treinos</h4>
        <div class="mb-3">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-md-5">
                    <form action="treinos.php" class="justify-content-center justify-content-md-start mb-3 mb-md 0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nome" placeholder="Digite aqui o nome do treino" />
                            <button class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container col-md-8">
            <div class="p-3 py-4">
                <table class='table text-center'>
                    <tr>
                        <th>Nome</th>
                        <th>Instrutor</th>
                        <th class="col-md-5"></th>
                    </tr>
                    <?php
                        if($treinos){
                            $dao = $factory->getUsuarioDao();

                            foreach ($treinos as $treino){
                                $instrutor = $dao->buscaPorIdUsuario($treino->getIdInstrutor());

                                echo "<tr>
                                            <td>" . $treino->getNome() . "</td>
                                            <td>" . $instrutor->getNome() . "</td>
                                            <td><a class='btn btn-success' href=" . $domain_treino . "modifica_treino.php?id=" . $treino->getId() . "><i class='fa fa-edit'></i></a>
                                                <a class='btn btn-danger' href=" . $domain_treino .  "remove_treino.php?id=" . $treino->getId() . " onclick='return confirm(\"Confirma a exclusão?\")'><i class='fa fa-trash'></i></a></td>
                                        </tr>";
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