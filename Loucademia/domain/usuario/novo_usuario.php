<?php
	$page_title = "Novo usuário";

	$path = $_SERVER['DOCUMENT_ROOT'] . '/Loucademia/';
	$header = $path . 'layout_header.php';
	$footer = $path . 'layout_footer.php';

	include($header);
?>

<script src="/Loucademia/js/buscaEstados.js"></script>
<script src="/Loucademia/js/getByCep.js"></script>

<script>
	document.addEventListener("DOMContentLoaded", function(){
		const selectEstado = document.querySelector("#estados");
    	const selectCidade = document.querySelector("#cidades");
		
    	popularSelecaoEstado(selectEstado);
    	popularSelecaoCidade(selectEstado, selectCidade);
	});
</script>


<div class="container">
  	<main>
    	<div class="py-5 text-center">
      		<h2>Registro de usuário</h2>
    	</div>

		<div class="col-md-12 col-lg-12">
			<form action="insere_usuario.php">
				<div class="row g-3">
					<div class="col-md-6">
						<label for="nomeCompleto" class="form-label">Nome completo</label>
						<input type="text" class="form-control" id="nomeCompleto" name="nome" placeholder="Nome completo" required>
					</div>

					<div class="col-md-6">
						<label for="senha" class="form-label">Senha</label>
						<?php
							include_once "../../comum.php";
							if (is_session_started() === FALSE) {
								session_start();
							}

							if(isset($_SESSION["nome"])){
								echo "<input type='password' class='form-control' id='senha' name='senha' disabled/>
								      <input type='hidden' name='situacao' value='pendente'/>";
							}else{	
								echo "<input type='password' class='form-control' id='senha' name='senha' placeholder='Senha' required>
								      <input type='hidden' name='situacao' value='ativo'/>";
							}
						?>
					</div>

					<div class="col-md-6">
						<label for="nomeUsuario" class="form-label">Nome de usuário</label>
						<div class="input-group has-validation">
							<span class="input-group-text">@</span>
							<input type="text" class="form-control" id="nomeUsuario" name="login" placeholder="Nome de usuário" required>
						</div>
					</div>

					<div class="col-md-6">
						<label for="email" class="form-label">E-mail</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="seuemail@exemplo.com" required>
					</div>

					<div class="col-md-3">
						<label for="telefone" class="form-label">Telefone</label>
						<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" maxlength="15" required>
					</div>

					<div class="col-md-3">
						<label for="cpf" class="form-label">CPF</label>
						<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" maxlength="11" required>
					</div>

					<div class="col-md-3">
						<label for="dataNascimento" class="form-label">Data de Nascimento</label>
						<input type="date" class="form-control" id="dataNascimento" name="dataNascimento" required>
					</div>

					<div class="col-md-3">
						<label for="sexo" class="form-label">Sexo</label>
						<select name="sexo" class="form-control form-select" id="sexo" required>
							<option value=""></option>
							<option value="masculino">Masculino</option>
							<option value="feminino">Feminino</option>
							<option value="outro">Outro</option>
						</select>
					</div>
				</div>

				<hr class="my-4">
				<h4>Tipo de usuário</h4>

				<div class="form-check">
					<input checked type="radio" class="form-check-input" id="aluno" value="aluno" name="tipo">
					<label class="form-check-label" for="aluno">Aluno</label>
				</div>

				<div class="form-check">
					<input type="radio" class="form-check-input" id="instrutor" value="instrutor" name="tipo">
					<label class="form-check-label" for="instrutor">Instrutor</label>
				</div>

				<div class="form-check">
					<input type="radio" class="form-check-input" id="recepcionista" value="recepcionista" name="tipo">
					<label class="form-check-label" for="recepcionista">Recepcionista</label>
				</div>

				<hr class="my-4">
				<h4>Seu endereço</h4>

				<div class="row g-3">
					<div class="col-md-4">
						<label for="Cep" class="form-label">CEP</label>
						<input type="text" name="cep" class="form-control" id="Cep" placeholder="CEP" size="10" maxlength="9" onblur="pesquisaCep(this.value);" required>
					</div>
					
					<div class="col-md-4">
						<label for="estados" class="form-label">Estado</label>
						<select name="estado" class="form-control form-select" id="estados" required>
							<option value="">Escolha um estado...</option>
						</select>
					</div>

					<div class="col-md-4">
						<label for="cidades" class="form-label">Cidade</label>
						<select name="cidade" class="form-control form-select" id="cidades" required disabled>
							<option value="">Escolha uma cidade...</option>
						</select>
					</div>

					<div class="col-md-6">
						<label for="rua" class="form-label">Rua</label>
						<input type="text" name="rua" class="form-control" id="rua" placeholder="Rua" required>
					</div>

					<div class="col-md-3">
						<label for="numero" class="form-label">Número</label>
						<input type="text" name="numero" class="form-control" id="numero" placeholder="Número" required>
					</div>

					<div class="col-md-3">
						<label for="complemento" class="form-label">Complemento</label>
						<input type="text" name="complemento" class="form-control" id="complemento" placeholder="Complemento">
					</div>
				</div>
				<hr class="my-4">
				<div class="d-flex flex-row-reverse">
					<button class="w-100 btn btn-success btn-lg" type="submit">Inserir registro</button>
				</div>
			</form>
    	</div>
	</main>
</div>

<?php
	include($footer);
?>