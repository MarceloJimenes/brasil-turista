<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- links -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
	<link rel="stylesheet" href="../../styles/logo-font.css">
	<link rel="stylesheet" href="../../styles/form.css">
	<link rel="stylesheet" href="../../styles/backgrounds.scss">

	<title>Cadastro de Usuário</title>
</head>
<body>
	<main>
		<section class="hero is-fullheight is-hero-background">

			<!-- HERO HEAD -->
			<div class="hero-head">
				<header class="navbar">
					<div class="container">
						<div class="navbar-brand">
							<a class="navbar-item" href="../../index.php">
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

					<form class="form" action="../../scripts/php/register/cadastrar_usuario.php" method="post">

						<h1 class="label has-text-centered">Cadastre um Usuário</h1>
						
						<div>
							<label class="label">Nome: </label>
							<input class="input" type="text" name="nome" required/>
						</div>

						<div>
						<label class="label">Senha: </label>
							<input class="input" type="password" name="senha" required/>
						</div>

						<div>
							<label class="label">E-mail: </label>
							<input class="input" type="text" name="email" required/>
						</div>

						<div>
							<label class="label">CPF: </label>
							<input class="input" type="text" name="cpf" required/>
						</div>

						<div>
							<label class="label">Telefone: </label>
							
							<div class="tellInput">
								<input class="input ddd" type="text" name="ddd" size="2" placeholder="DDD" required/> - 
								<input class="input tell" type="text" name="telefone" placeholder="Número" required/>
							</div>
							
						</div>

						<div class="select-container">
							<label class="label">Sexo:</label>

							<div class="select">
								<select name="sexo" required>
									<option value="F">Feminino</option>
									<option value="M">Masculino</option>
									<option value="I">Indefinido</option>
								</select>
							</div>
						</div>

						<div class="botoes has-text-centered">
							<input class="button is-success" type="submit" value="Cadastrar"/>
						</div>
						
					</form>
				
				</div>
			</div>

		</section>
	</main>
	<?php
	
		
	
	?>
</body>
</html>


