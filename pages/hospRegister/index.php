<!DOCTYPE html>
<html lang="pt-Br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                  <a class="navbar-item" id="room-register" href="../roomRegister/index.php">
                    Cadastrar quarto
                  </a>
                  <a class="navbar-item" id="city-register" href="../cityRegister/cadastro_cidade.php">
                    Cadastrar cidade
                  </a>
                  <a class="navbar-item" id="pt-register">
                    Cadastrar Ponto Turístico
                  </a>
                  <a class="navbar-item" href="../../scripts/php/logout/index.php">
                    Logout
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

						<h1 class="label has-text-centered">Cadastre uma Hospedagem</h1>

						<div class="control">
							<label class="label">Digite o nome da Hospedagem: </label>
							<input class="input" type="text" name="nome" placeholder="Hospedagem da Tia Ju" />
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
                <select name="tp_hosp" id="tp_hosp" >
                  <option value="" disabled selected>Selecione:</option>
                  <option value="0">Hotel</option>
                  <option value="1">Hostel</option>
                  <option value="2">Pousada</option>
                  <option value="3">Resort</option>
                </select>
            </div>

						<div class="control">
							<label class="label">Foto:</label>
							<input type="file" name="foto[]" multiple >
						</div>

						<div>
						<h5 class= "subtitle is-5"> 
							<strong>Selecione os serviços oferecidos pela hospedagem:</br></strong>
							<span style="color: red">*</span>(Caso não ofereça nenhuma das opções, favor deixa-lás vazias.)
						</h5>
					
						<input type="checkbox" name="add[]" value="café"> <label for="cafe">Café da manhã |</label> 
						<input type="checkbox" name="add[]" value="wi-fi"> <label for="wifi">Possui Wifi nas acomodações |</label> 
						<input type="checkbox" name="add[]" value="animais"> <label for="animais"> Aceita animais de estimação |</label>
						<input type="checkbox" name="add[]" value="piscina"> <label for="pisc">Possui Piscina |</label>
						<input type="checkbox" name="add[]" value="sauna"> <label for="sauna">Sauna |</label>
						<input type="checkbox" name="add[]" value="academia"> <label for="acad">Academia |</label>
						<input type="checkbox" name="add[]" value="spa"> <label for="spa">Spa</label>

						
						</div>

						<div class="botoes has-text-centered">
							<input type='text' hidden name='flag' value='0'/>
							<input class="button is-success" name="submit" type="submit" value="Cadastrar"/>
						</div>

					</form>
				</div>
			</div>

      <?php

				if(isset($_FILES['foto'])) {
					require_once '../../scripts/verifModules/photoValidation.php';

					$result = photoValid($_FILES['foto'], $_POST['flag']);

					if(isset($result['status']) == 'false') {
						echo "
							<script>
								alert('$result[reason]');
								history.back();
							</script>
						";
					} else {
						require_once "../../scripts/php/conexao.php";
						require_once "../../scripts/php/hospedagem/functions.php";

						$hosp = insertHosp($conexao, $_POST['nome'], $_POST['cidade'], $_POST['tel-cel'], $_POST['email'], $_POST['tp_hosp']);

						if ($hosp) {
							$ultimoId = mysqli_insert_id($conexao);
							foreach ($_POST['add'] as $key) {
								$add = insertAdd($conexao, $ultimoId, $key);
								if (!$add) {
									break;
								}
							}

							foreach ($result as $img){
								$foto = insertPhoto($conexao, $ultimoId, $img);
								if (!$foto) {
									break;
								}
							}

							if ($foto) {
								echo "
									<script>
										alert('HOSPEDAGEM CADASTRADA COM SUCESSO');
									</script>
							";
							}else{
								echo "
									<script>
										alert('DEU MUITO RUIM, RUIM DEMAIS, PÉSSIMO, HORRÍVEL, NÍVEL DBA');
										history.back();
									</script>
								";
							}
							
						}
					}

				}
/* 
				if (isset($_POST['submit'])) {

					$hospedagem = insertHosp($conexao, $_POST['nome'], $_POST['cidade'], $_POST['tel-cel'], $_POST['email'], $_POST['tp_hosp']);

					if ($hospedagem==1 && $add==1) {
						echo"
							Hospedagem cadastrada com sucesso!
						";
					}else{
						echo "WASTED";
					}
				} */

      ?>
		</section>
	</main>
</body>
</html>
<?php
}
?>