<!DOCTYPE html>
<html lang="pt-Br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Hospedagem</title>
</head>
<body>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: 'textarea'
		});
	</script>

	<!-- Links -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
	<link rel="stylesheet" href="../../styles/logo-font.scss">
  <link rel="stylesheet" href="../../styles/backgrounds.scss">
	<link rel="stylesheet" href="../../styles/form.scss">

	<title>Cadastro de Cidade</title>
</head>

<body>

	<main>

		<section class="hero is-fullheight" id="error-request">
			<div class="hero-body">
				
				<div class="container has-text-centered">
					<?php
						session_start();

						if (isset($_SESSION['id_usuario'])) {
							$statusLog = 1;
						} else {
							$statusLog = 0;
						}

						if ($statusLog == 0) {
							echo '

								<p class="title">Por favor, efetue o login para acessar essa página!<p>

								<figure>
									<img src="../../img/svg/Login-amico.svg" width="400px" alt="access danied"/>
								<figure>

								<a href="../login/login.php"><button class="button is-dark is-rounded">Ir para Login</button></a>
								<br><br>
								<p><a href="../../index.php" class="has-text-light is-underline"><u>Voltar a página inicial</u></a></p>
							';
						} else if ($statusLog == 1 && $_SESSION['tipo_usuario'] == 3) {
							echo '
								<p class="title">Você não tem permissão para acessar essa página!<p>

								<figure>
									<img src="../../img/svg/undraw_cancel_u1it.svg" width="400px" alt="access danied"/>
								<figure>
								
								<br><br>
								<a href="../../index.php"><button class="button is-dark is-rounded">Voltar para tela inicial</button></a>
							';
						} else if ($statusLog == 1 && $_SESSION['tipo_usuario'] != 3){

							echo '
								<script>
									document.querySelector("#error-request").style.display = "none";
								</script>
							';

							require_once "../../scripts/php/conexao.php";
					?>
				</div>

			</div>
		</section>

		<section class="hero is-hero-background is-fullheight">

			<!-- HERO HEAD -->
			<div class="hero-head">
				<header class="navbar">
					<div class="container">
						<div class="navbar-brand">
							<a class="navbar-item">
								<p class="title logo-title-menu">
									Brasil Turista
								</p>
							</a>
							<!-- Menu responsivo -->
							<span class="navbar-burger" data-target="navbarMenuHeroC">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</div>

						<!-- Default menu -->
						<div id="navbarMenuHeroC" class="navbar-menu">
							<div class="navbar-end">
								
								<a class="navbar-item" href="../../index.php">
									Página inicial
								</a>
								
								<a class="navbar-item" href="#">
									Cadastrar cidade
								</a>
								
								<a class="navbar-item">
									Cadastrar Ponto Turístico
								</a>
								
								<a class="navbar-item" href="../userPerfil/perfil.php">
									Meu Perfil
								</a>

								<!-- botao para download -->
								<!-- <span class="navbar-item">
                    <a class="button is-success is-inverted">
                      <span class="icon">
                        <i class="fab fa-github"></i>
                      </span>
                      <span>Download</span>
                    </a>
                  </span> -->
							</div>
						</div>
					</div>
				</header>
			</div>

			<!-- HERO CONTENT -->
			<div class="hero-body">

				<div class="container">

					<form class="form" action="" method="post" enctype="multipart/form-data">

						<h1 class="label has-text-centered">Cadastre um Hospedagem</h1>

						<div class="control">
							<label class="label">Digite o nome da Hospedagem: </label>
							<input class="input" type="text" name="nome" required/>
						</div>

						<label class="label">Escolha o estado: </label>

						<div class="select">
							<select name="estado" required>
								<option value=""></option>
								<?php
								$query = "SELECT id_estado, nome FROM estados";
								$executa = mysqli_query($conexao, $query);
								while ($estados = mysqli_fetch_array($executa)) {
									echo "<option value='$estados[id_estado]'>$estados[nome]</option>";
								}
								?>
							</select>
						</div>

						<div class="file">
							<label class="label">Foto:</label>
							<input type="file" name="foto" required>
						</div>

						<div class="textarea-field">
							<label class="label">Descreva a cidade turistica:</label>
							<textarea name="descricao"></textarea>
						</div>

						<div class="checkbox-list">
							<label class="label">Defina qual o tipo(s) de turismo da cidade:</label>

							<?php
							$querytt = "SELECT id_tipo_turismo, nome FROM tipo_turismo";
							$executar = mysqli_query($conexao, $querytt);
							while ($tt = mysqli_fetch_array($executar)) {
								echo "<input name='tt[]' type='checkbox' value='$tt[id_tipo_turismo]'> $tt[nome] | ";
							}
							?>

						</div>

						<div class="botoes has-text-centered">
							<input class="button is-success" type="submit" value="Cadastrar"/>
						</div>

					</form>
				</div>
			</div>

		</section>

	</main>
</body>
</html>
<?php
}
?>