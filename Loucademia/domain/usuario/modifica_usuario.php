<?php

$page_title = "Alterar usuário";
$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';

$header = $path . 'layout_header.php';
$fachada = $path . 'fachada.php';
$footer = $path . 'layout_footer.php';
$verifica = $path . 'verifica.php';

include($verifica);
include($header);
include($fachada);

$id = $_GET["id"];

$dao = $factory->getUsuarioDao();

$usuario = $dao->buscaPorIdUsuario($id);
?>

<script src="/Loucademia/js/buscaEstados.js"></script>
<script src="/Loucademia/js/getByCep.js"></script>

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
                </div>
                <form action="altera_usuario.php" method="get">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="nomeCompleto" class="form-label">Nome completo</label>
                            <input id="nomeCompleto" name="nome" type="text" class="form-control" placeholder="Nome completo" value='<?php echo $usuario->getNome();?>' required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="usuario">Usuário</label>
                            <input id="usuario" name="login" type="text" class="form-control" value='<?php echo $usuario->getLogin();?>' placeholder="Usuário" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="email">E-mail</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="E-mail" value='<?php echo $usuario->getEmail();?>' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="telefone">Telefone</label>
                            <input id="telefone" name="telefone" type="text" class="form-control" value='<?php echo $usuario->getTelefone();?>' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="cpf">CPF</label>
                            <input id="cpf" name="cpf" type="text" class="form-control" placeholder="CPF" value='<?php echo $usuario->getCpf();?>' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="sexo">Sexo</label>
                            <select class="form-control form-select" name="sexo" id="sexo" required>
                                <option value=""></option>
                                <?php
                                    switch($usuario->getSexo()){
                                        case "masculino":
                                            echo "<option value='masculino' selected>Masculino</option>
                                                  <option value='feminino'>Feminino</option>
                                                  <option value='outro'>Outro</option>";
                                            break;

                                        case "feminino":
                                            echo "<option value='masculino'>Masculino</option>
                                                  <option value='feminino' selected>Feminino</option>
                                                  <option value='outro'>Outro</option>";
                                            break;

                                        default:
                                            echo "<option value='masculino'>Masculino</option>
                                                  <option value='feminino'>Feminino</option>
                                                  <option value='outro' selected>Outro</option>";
                                            break;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Data de Nascimento</label>
                            <input type="date" name="dataNascimento" class="form-control" value='<?php echo $usuario->getDataNascimento();?>' required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-3">
                        <h4 class="text-right">Endereço</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">CEP</label>
                            <input type="text" name="cep" class="form-control form-control" placeholder="CEP" value='<?php echo $usuario->getEndereco()->getCep();?>'  size="10" maxlength="9" onblur="pesquisaCep(this.value);" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label" for="rua">Rua</label>
                            <input id="rua" name="rua" type="text" class="form-control" placeholder="Rua" value='<?php echo $usuario->getEndereco()->getRua();?>' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="numero">Número</label>
                            <input id="numero" name="numero" type="text" class="form-control" placeholder="Número" value='<?php echo $usuario->getEndereco()->getNumero();?>' required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="complemento ">Complemento</label>
                            <input id="complemento" name="complemento" type="text" class="form-control" value='<?php echo $usuario->getEndereco()->getComplemento();?>' placeholder="Complemento">
                        </div>
                        <div class='col-md-6'>
                            <label for="estados" class="form-label">Estado</label>
						    <select name="estado" class="form-control form-select" id="estados" required>
						    	<option value="">Escolha um estado...</option>
						    </select>
                        </div>
                        <div class='col-md-6'>
                            <label for="cidades" class="form-label">Cidade</label>
						    <select name="cidade" class="form-control form-select" id="cidades" required>
						    	<option value="">Escolha uma cidade...</option>
						    </select>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="submit">Salvar perfil</button>
                        <input type='hidden' name='id' value='<?php echo $id;?>'/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    include($footer);
?>