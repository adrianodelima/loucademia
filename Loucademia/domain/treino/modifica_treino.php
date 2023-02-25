<?php
	$page_title = "Alterar treino";

	$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
	$header = $path . 'layout_header.php';
	$fachada = $path . 'fachada.php';
	$footer = $path . 'layout_footer.php';

	include($header);
	include($fachada);

	$id = @$_GET["id"];

	$dao = $factory->getTreinoDao();

	$treino = $dao->buscaPorIdTreino($id);

	$dao = $factory->getUsuarioDao();

	$instrutor_treino = $dao->buscaPorIdUsuario($treino->getIdInstrutor());
	$instrutores = $dao->buscaTodosUsuariosInstrutores();
?>

<main>
  	<div class="container marketing my-2">
    	<form action="altera_treino.php" method="get">
      		<div class="row justify-content-md-center">
        		<div class="col-lg-4 my-5">
					<img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/deku.jpg" preserveAspectRatio="xMidYMid slice" focusable="false">
            			<title>Treino</title>
          			</img>

          			<h4>Informe o nome do treino</h4>
          			<input type="text" class="form-control" id="nomeTreino" name="nome" placeholder="Nome do treino" value='<?php echo $treino->getNome();?>' required>
        		</div>
        		<div class="col-lg-4 my-5">
					<img class="bd-placeholder-img rounded-circle" width="140" height="140" src="../../assets/allmight-instrutor.jpg" preserveAspectRatio="xMidYMid slice" focusable="false">
            			<title>Instrutor</title>
					</img>

          			<h4>Selecione um instrutor</h4>
					<select name="id_instrutor" class="form-control form-select" id="instrutor" required>
						<option value=''></option>
						<option value='<?php echo $treino->getIdInstrutor();?>' selected><?php echo $instrutor_treino->getNome();?></option>
						<?php
							if($instrutores){
								foreach ($instrutores as $instrutor){
									if ($instrutor->getId() != $treino->getIdInstrutor()){
										echo "<option value=" . $instrutor->getId() . ">" . $instrutor->getNome() . "</option>";
									}
								}
							}
						?>
					</select>
        		</div>
			</div>
			<div class="mt-5 text-center">
				<button class="btn btn-success profile-button" type="submit">Alterar registro</button>
				<input type='hidden' name='id' value='<?php echo $id;?>'/>
			</div>
    	</form>
  	</div>
</main>

<?php
	include($footer);
?>