<!DOCTYPE html>
<html lang="pt-Br">
<head>

	<!-- Links -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
	<link rel="stylesheet" href="../../styles/logo-font.scss">
  <link rel="stylesheet" href="../../styles/backgrounds.scss">
	<link rel="stylesheet" href="../../styles/form.scss">

	<title>Cadastro de Quartos</title>
	<style>

	</style>
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

						<h1 class="label has-text-centered">Cadastre um Quarto</h1>

						<div class="control">
							<label class="label">Digite o nome do Quarto: </label>
							<input class="input" type="text" name="nome" placeholder="Albergue do DBA" s/>
						</div>

            <label class="label" for="hosp">Hospedagem:</label>
						<div class="select">
              <select name="id_hosp" id="hosp">
                <option value="" disabled selected>Selecione:</option>
                <?php
                  $query ="SELECT id_hosp, tt_hosp FROM hospedagem";
                  $dados = mysqli_query($conexao, $query);
                  while($hospedagem = mysqli_fetch_array($dados)){
                    echo"
                      <option value='$hospedagem[id_hosp]'>$hospedagem[tt_hosp]</option>
                    ";
                  }
                ?>
              </select>
            </div>

            <div class="control">
              <label class="label" for="valor">Valor da diária: </label>
              <input class="input" type="text" id="valor" name="valor" placeholder="R$ 30,00"s/>
            </div>

            <div class="control">
              <label class="label" for="camas">Quantidade de camas: </label>
              <input class="input" type="number" id="camas" name ="camas" maxlength="2" s/>
            </div>
            
						<div class="control">
							<label class="label">Foto:</label>
							<input type="file" name="foto[]" multiple s>
						</div>
						

						<div>
							<h5 class= "subtitle is-5"> 
								<strong>Informe se o quarto possui os seguintes adicionais:</br></strong>
								<span style="color: red">*</span>(Caso não ofereça nenhuma das opções, favor deixa-lás vazias.)
							</h5>
						
							<input type="checkbox" name="add[]" value="ar-condicionado"> <label for="cafe">Ar condicionado|</label> 
							<input type="checkbox" name="add[]" value="calefação"> <label for="wifi">Possui calefação |</label> 
							<input type="checkbox" name="add[]" value="lareira"> <label for="animais"> Possui lareira|</label>
							<input type="checkbox" name="add[]" value="frigobar"> <label for="pisc"> Dispõe de Frigobar |</label>
							<input type="checkbox" name="add[]" value="secador de cabelo"> <label for="sauna">Secador de cabelo |</label>
							<input type="checkbox" name="add[]" value="TV a cabo"> <label for="acad">TV a cabo |</label>
						</div>


						<div class="botoes has-text-centered">
						<input type='text' hidden name='flag' value='1'/>
							<input class="button is-success" type="submit" value="Cadastrar"/>
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
						require_once "../../scripts/php/quartos/functions.php";

						$quarto = insertRoom($conexao, $_POST['id_hosp'], $_POST['nome'], $_POST['valor'], $_POST['camas']);

						if ($quarto) {
							$ultimoId = mysqli_insert_id($conexao);
							foreach ($_POST['add'] as $key) {
								$add = insertAddRoom($conexao, $ultimoId, $key);
								if (!$add) {
									break;
								}
							}

							foreach ($result as $img){
								$foto = insertPhotoRoom($conexao, $ultimoId, $img);
								if (!$foto) {
									break;
								}
							}

							if ($foto) {
								echo "
									<script>
										alert('QUARTO CADASTRADO COM SUCESSO');
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
      ?>
		</section>
	</main>
</body>
</html>
<?php
}
?>