<?php
include "verifica.php";

$page_title = "Usuários";

include_once "layout_header.php";
include_once "fachada.php";

$dao = $factory->getUsuarioDao();

$nome_email = @$_GET["nome_email"];

if($nome_email != null){
	$usuarios = $dao->buscaPorNomeEmailUsuarios($nome_email);
}else{
    $usuarios = $dao->buscaTodosUsuarios();
}
?>

<div class="container py-5 h-100">
    <div class="justify-content-center align-items-center h-100">
        <h4 class="text-center">Usuários</h4>
        <div class="mb-3">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 col-md-5">
                    <form action="usuarios.php" class="justify-content-center justify-content-md-start mb-md">
                        <div class="input-group">
                            <input type="text" class="form-control" name="nome_email" placeholder="Digite aqui o nome ou o e-mail do usuário" />
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
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                    <?php
                        if($usuarios){
                            foreach ($usuarios as $usuario){
                                echo "<tr>
                                          <td>" . $usuario->getNome() . "</td>
                                          <td>" . $usuario->getEmail() . "</td>
                                          <td><a class='btn btn-primary' href='/Loucademia/interfaces/view/visualiza_usuario.php?id=" . $usuario->getId() . "'><i class='fa fa-eye'></i></a>";

                                if ($usuario->getSituacao() != "inativo"){
                                       echo " <a class='btn btn-success' href='/Loucademia/domain/usuario/modifica_usuario.php?id=" . $usuario->getId() . "'><i class='fa fa-edit'></i></a>
                                              <a class='btn btn-danger px-3' href='/Loucademia/domain/usuario/inativa_usuario.php?id=" . $usuario->getId() . "&tipo=" . $usuario->getTipo() . "' onclick='return confirm(\"Confirma a inativação?\")' ><i class='fa fa-lock'></i></a></td>";
                                }else{
                                    echo " <a class='btn btn-warning' href='/Loucademia/domain/usuario/reativa_usuario.php?id=" . $usuario->getId() . "&login=" . $usuario->getLogin() . "'><i class='fa fa-unlock'></i></a></td>";
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