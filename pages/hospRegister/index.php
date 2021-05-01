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
							<input class="input" type="text" name="nome" placeholder="Hospedagem da Tia Ju"/>
						</div>

            <label class="label" for="cidade">Cidade:</label>
						<div class="select">
              <select name="cidade" id="cidade" >
                <option value="" disabled selected>Selecione:</option>
                <?php
                  $query ="SELECT id_cidade, nome FROM cidades";
                  $dados = mysqli_query($conexao, $query);
                  while($cidades = mysqli_fetch_array($dados)){
                    echo"
                      <option value='$cidades[id_cidade]'>$cidades[nome]</option>
                    ";
                  }
                ?>
              </select>
            </div>

            <div class="control">
              <label class="label" for="tel-cel">Nº Contato:</label>
              <input class="input" type="text" id="tel-cel" name="tel-cel" placeholder="(XX) 00000-0000"/>
            </div>

            <div class="control">
              <label class="label" for="email">E-mail da Hospedagem:</label>
              <input class="input" type="email" id="email" name ="email" placeholder="hotel@gmail.com" />
            </div>
            
            <label class="label" for="tp_hosp">Tipo de Hospedagem:</label>
            <div class="select">
                <select name="tp_hosp" id="tp_hosp">
                  <option value="" disabled selected>Selecione:</option>
                  <option value="0">Hotel</option>
                  <option value="1">Hostel</option>
                  <option value="2">Pousada</option>
                  <option value="3">Resort</option>
                </select>
            </div>

						<div class="control">
							<label class="label">Foto:</label>
							<input type="file" name="foto" multiple>
						</div>

						<div class="botoes has-text-centered">
							<input class="button is-success" type="submit" value="Cadastrar"/>
						</div>

					</form>
				</div>
			</div>

      <?php
        var_dump($_POST);
        var_dump($_FILES);
        

      ?>
		</section>
	</main>
</body>
</html>
<?php
}
?>