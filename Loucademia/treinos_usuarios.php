<?php
include "verifica.php";

$page_title = "Treinos dos usuários";

include_once "layout_header.php";
include_once "fachada.php";

$nome = @$_GET["nome"];

$dao = $factory->getTreinoUsuarioDao();

if($nome != null){
    $treinosQuantidade = $dao->buscaTodosTreinosNomeUsuarioQuantidade($nome);
}else{
    $treinosQuantidade = $dao->buscaTodosTreinosTodosUsuariosQuantidade();
}

?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <h4 class="text-center">Treinos dos usuários</h4>
        <div class="mb-3">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-md-5">
                    <form action="treinos_usuarios.php" class="justify-content-center justify-content-md-start mb-3 mb-md 0">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nome" placeholder="Digite aqui o nome do usuário" />
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
                        <th>Quantidade de treinos</th>
                        <th class="col-md-3"></th>
                    </tr>
                    <?php
                        if($treinosQuantidade){
                            foreach ($treinosQuantidade as $treinoQuantidade){
                                echo "<tr>
                                          <td>" . $treinoQuantidade['nome'] . "</td>
                                          <td>" . $treinoQuantidade['quantidade'] . "</td>
                                          <td><a class='btn btn-primary' href='/Loucademia/interfaces/view/visualiza_treinos_usuario.php?id=" . $treinoQuantidade['id'] . "'><i class='fa far fa-eye'></i></a>
                                      </tr>";
                            }
                        }
                    ?>
                </table>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" onclick="location.href='home.php'">Voltar para home</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "layout_footer.php";
?>