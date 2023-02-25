<?php

	$page_title = "Loucademia";

	$view = 'interfaces/view/';
	$usuario = 'domain/usuario/';
	$visualiza_treinos_usuario = $view . 'visualiza_treinos_usuario.php';
	$visualiza_usuario = $view . 'visualiza_usuario.php';
	$modifica_usuario = $usuario . 'modifica_usuario.php';

	include_once "layout_header.php";

?>

<main>
  	<div class="container marketing my-5">
    	<div class="row featurette">
      		<div class="col-md-7">
        		<h2 class="featurette-heading">Vá além, plus ultra.</h2>
        		<p class="lead">Nós vamos te acompanhar nessa jornada para alcançar novos patamares e quebrar limites.</p>
				<?php
					echo "<a href=" . $visualiza_usuario . "?id=" . @$_SESSION["id"] . " class='btn btn-cor-primaria my-3 d-flex justify-content-center'><h4>Visualizar meu perfil</h4></a>
					      <a href=" . $modifica_usuario . "?id=" . @$_SESSION["id"] . " class='btn btn-cor-primaria my-3 d-flex justify-content-center'><h4>Alterar meu perfil</h4></a>";
				?>
				</div>
      		<div class="col-md-5">
				<img class="bd-placeholder-img bd-placeholder-img-lg img-fluid" src="assets/all-might.webp" style="width: 500px;" alt="logo">
      		</div>
    	</div>

    	<hr class="featurette-divider">

    	<div class="row featurette">
      		<div class="col-md-7 order-md-2">
        		<h2 class="featurette-heading">Tira casaco, bota casaco.</h2>
        		<p class="lead">Vamos conferir por onde começar sua trilha de campeão.</p>
				<?php
					echo "<a href=" . $visualiza_treinos_usuario . "?id=" . @$_SESSION["id"] . " class='btn btn-cor-primaria my-5 d-flex justify-content-center'><h4>Meus treinos</h4></a>";
				?>
			</div>
      		<div class="col-md-5 order-md-1">
	  			<img class="bd-placeholder-img bd-placeholder-img-lg img-fluid" src="assets/karate-kid.jpg" style="width: 500px;" alt="logo">
      		</div>
    	</div>

    	<hr class="featurette-divider">

    	<div class="row featurette">
      		<div class="col-md-7">
       			<h2 class="featurette-heading">Vamos tratar de negócios.</h2>
        		<p class="lead">Para manter sua assinatura na Loucademia, você vai precisar pagar algumas mensalidades.</p>
				<a href="pagamento_pendente.php?id=<?php echo @$_SESSION["id"];?>" class="btn btn-cor-primaria my-5 d-flex justify-content-center"><h4>Pagar mensalidade</h4></a>
      		</div>
      		<div class="col-md-5">
				<img class="bd-placeholder-img bd-placeholder-img-lg img-fluid" src="assets/pernalonga.jpg" style="width: 500px;" alt="logo">
      		</div>
    	</div>
    	<hr class="featurette-divider">
  	</div>
</main>

<?php
	include_once "layout_footer.php";
?>