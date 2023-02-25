<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
$verifica = $path . 'verifica.php';
$header = $path . 'layout_header.php';
$fachada = $path . 'fachada.php';
$footer = $path . 'layout_footer.php';
$home = $path . 'home.php';

$modifica_usuario = $path . 'domain/usuario/modifica_usuario.php';

include($verifica);

$page_title = "Perfil usuário";

include($header);
include($fachada);

$id = $_GET["id"];

$dao = $factory->getUsuarioDao();

$usuario = $dao->buscaPorIdUsuario($id);

?>

<script src="/Loucademia/js/buscaEstados.js"></script>

<script>
  	document.addEventListener("DOMContentLoaded", function(){
    	const selectEstado = document.querySelector("#estados");
    	const selectCidade = document.querySelector("#cidades");

        const estado = '<?php echo $usuario->getEndereco()->getEstado();?>';
    	popularSelecaoEstado(selectEstado, estado);
        const cidade = '<?php echo $usuario->getEndereco()->getCidade();?>';
    	popularSelecaoCidade(selectEstado, selectCidade, cidade, estado);
	});
</script>

<div class="container-fluid rounded bg-white px-md-5 my-5">
    <div class="row offset-lg-1">
        <div class="col-md-3">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="/Loucademia/assets/muscleman.png">
                <span class="font-weight-bold"><?php echo $usuario->getNome();?></span>
                <span class="text-black-50"><?php echo $usuario->getEmail();?></span>
            </div>
        </div>
        <div class="col-md-5">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Dados do usuário</h4>
                    <?php
                        if ($usuario->getSituacao() == 'inativo'){
                            echo "<a class='btn btn-primary profile-button disabled' href='/Loucademia/domain/usuario/modifica_usuario.php?id=" . $id . "'";
                        }else{
                            echo "<a class='btn btn-primary profile-button' href='/Loucademia/domain/usuario/modifica_usuario.php?id=" . $id . "'";
                        }

                        echo ">Alterar cadastro</a>";
                    ?>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="nomeCompleto" class="form-label">Nome completo</label>
                        <input id="nomeCompleto" type="text" class="form-control" value='<?php echo $usuario->getNome();?>' disabled>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="usuario">Nome de usuário</label>
                        <input id="usuario" type="text" class="form-control" value='<?php echo $usuario->getLogin();?>' disabled>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="senha">Senha</label>
                        <?php
                            echo "<a id='senha' class='btn btn-primary profile-button form-control ";

                            if ($id != $_SESSION['id']){
                                echo "disabled' ";
                            }else{
                                echo "' ";
                            }

                            echo "href='/Loucademia/application/service/login_senha_antiga_nova.php?id=" . $id . "&login=" . $usuario->getLogin() . "'>Alterar senha</a>";
                        ?>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="email">E-mail</label>
                        <input id="email" type="email" class="form-control" value='<?php echo $usuario->getEmail();?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="telefone">Telefone</label>
                        <input id="telefone" type="text" class="form-control" value='<?php echo $usuario->getTelefone();?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="cpf">CPF</label>
                        <input id="cpf" type="text" class="form-control" value='<?php echo $usuario->getCpf();?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="sexo">Sexo</label>
                        <input id="sexo" type="text" class="form-control" value='<?php echo ucfirst($usuario->getSexo());?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" value='<?php echo $usuario->getDataNascimento();?>' disabled>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center my-3">
                    <h4 class="text-right">Endereço</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label" for="rua">Rua</label>
                        <input id="rua" type="text" class="form-control" value='<?php echo $usuario->getEndereco()->getRua();?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="numero">Número</label>
                        <input id="numero" type="text" class="form-control" value='<?php echo $usuario->getEndereco()->getNumero();?>' disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="complemento ">Complemento</label>
                        <input id="complemento" type="text" class="form-control" value='<?php echo $usuario->getEndereco()->getComplemento();?>' disabled>
                    </div>
                    <div class='col-md-6'>
                        <label for="estados" class="form-label">Estado</label>
                        <select name="estado" class="form-control form-select" id="estados" disabled>
                        </select>
                    </div>
                    <div class='col-md-6'>
                        <label for="cidades" class="form-label">Cidade</label>
                        <select name="cidade" class="form-control form-select" id="cidades" disabled>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">CEP</label>
                        <input type="text" class="form-control" value='<?php echo $usuario->getEndereco()->getCep();?>' disabled>
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" onclick="location.href='../../home.php'">Voltar para home</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include($footer);
?>