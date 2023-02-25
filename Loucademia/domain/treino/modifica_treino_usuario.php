<?php
	$page_title = "Alterar treino vinculado";

	$id_usuario = @$_GET["id_usuario"];
	$id_treino = @$_GET["id_treino"];

	$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
	$header = $path . 'layout_header.php';
	$fachada = $path . 'fachada.php';
	$footer = $path . 'layout_footer.php';

	include($header);
	include($fachada);

	$dao = $factory->getTreinoUsuarioDao();
	$treino_usuario_dados = $dao->buscaUmTreinoUsuario($id_usuario, $id_treino);

	$dao = $factory->getTreinoDao();
	$treinos = $dao->buscaTodosTreinos();
	$treino_usuario = $dao->buscaPorIdTreino($id_treino);

	$dao = $factory->getUsuarioDao();
	$instrutor_treino = $dao->buscaPorIdUsuario($treino_usuario->getIdInstrutor());
?>

<main>
  	<div class="container marketing my-2">
    	<form action="altera_treino_usuario.php" method="get">
      		<div class="row justify-content-md-center">
        		<div class="col-lg-4 my-5">
					<img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/deku.jpg" preserveAspectRatio="xMidYMid slice" focusable="false">
            			<title>Treino</title>
          			</img>

          			<h4>Selecione um treino</h4>
                    <select name="id_treino" class="form-control form-select mb-3" id="treino" required>
						<option value=""></option>
						<?php
                            echo "<option value='" . $id_treino . "' selected>" . $treino_usuario->getNome() . " - " . $instrutor_treino->getNome() . "</option>";
							if($treinos){
                                $dao = $factory->getUsuarioDao();

								foreach ($treinos as $treino){
                                    $instrutor = $dao->buscaPorIdUsuario($treino->getIdInstrutor());

                                    if($id_usuario != $treino->getIdInstrutor() && $id_treino != $treino->getId()){
                                        echo "<option value='" . $treino->getId() . "'>" . $treino->getNome() . " - " . $instrutor->getNome() . "</option>";
                                    }
								}
							}
						?>
					</select>

					<h5>Informe a carga</h5>
          			<input type="number" onkeypress="return onlynumber();" class="form-control" name="carga" min="1" placeholder="Carga" value="<?php echo $treino_usuario_dados->getCarga();?>" required>

					<h5>Informe a quantidade de repetições</h5>
          			<input type="number" onkeypress="return onlynumber();" class="form-control" name="qtd_repeticao" min="1" placeholder="Quantidade de repetições" value="<?php echo $treino_usuario_dados->getQtdRepeticao();?>" required>

					<h5>Informe a série</h5>
          			<input type="number" onkeypress="return onlynumber();" class="form-control" name="serie" min="1" placeholder="Série" value="<?php echo $treino_usuario_dados->getSerie();?>" required>
        		</div>
			</div>
			<div class="text-center">
				<button class="btn btn-success profile-button" type="submit">Alterar treino vinculado</button>
				<input type='hidden' name='id_usuario' value='<?php echo $id_usuario;?>'/>
				<input type='hidden' name='id_treino_antigo' value='<?php echo $id_treino;?>'/>
			</div>
    	</form>
  	</div>
</main>

<?php
	include($footer);
?>