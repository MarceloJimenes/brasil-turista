<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">

  <!-- Include the Borderless theme -->
  <link rel="stylesheet" href="../../../node_modules/@sweetalert2/theme-borderless/borderless.css">

  <!-- Scripts JS -->
  <script src="../../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

	<title>user register</title>
</head>
<body>
	<?php
		require_once '../conexao.php'; //conexão com o banco de dados
		require_once '../../verifModules/checagememail.php';
		//var_dump($_POST);
		
		// criação das variáveis
		$nome = $_POST["nome"];
		$senha = $_POST["senha"];
		$email = $_POST["email"];
		$cpf = $_POST["cpf"];
		$sexo = $_POST["sexo"];
		$telefone = $_POST["telefone"];
		$ddd = $_POST["ddd"];
		$telefone = $ddd."-".$telefone;

		
			//validação de dados
			$contanome = strlen($nome);
			$senha = sha1($senha);
			
			if($contanome > 50){
				echo '
					<script>
						setTimeout(function(){ history.back(); }, 5000);

						function error() {
							Swal.fire({
								icon: "error",
								title: "registro irregular",
								footer: "O nome informado é muito grande tente um menor!",
								showConfirmButton: false,
								timer: 5000,
								timerProgressBar: true
							})
							
						}
		
						error();
					</script>
				';
			}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				echo '
					<script>
						setTimeout(function(){ history.back(); }, 5000);

						function error() {
							Swal.fire({
								icon: "error",
								title: "registro irregular",
								footer: "O e-mail digitado está incorreto, verifique e tente novamente!",
								showConfirmButton: false,
								timer: 5000,
								timerProgressBar: true
							})
							
						}
		
						error();
					</script>
				';
			}else if (ChecaEmail($email,$conexao)){
				echo '
					<script>
						setTimeout(function(){ history.back(); }, 5000);

						function error() {
							Swal.fire({
								icon: "error",
								title: "registro irrugular",
								footer: "O e-mail '.$email.' já foi cadastrado, tente outro e-mail!",
								showConfirmButton: false,
								timer: 5000,
								timerProgressBar: true
							})
							
						}
		
						error();
					</script>
				';
			}else{
				//echo $acheiemail;exit;		
			$query = "INSERT INTO usuario 
					(email,nome,cpf,telefone,sexo,senha,user_type)
					VALUES ('$email','$nome','$cpf','$telefone','$sexo','$senha',3)
					";
			//echo $query;exit;
			$cadastrar = mysqli_query($conexao,$query);
			if($cadastrar==1){
				echo '
					<script>
						setTimeout(function(){ location.href="../../../pages/login/login.php"; }, 3000);

						function success() {
							Swal.fire({
								icon: "success",
								title: "Sucesso!",
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true
							})
							
						}
		
						success();
					</script>
				';
			}else{
				echo '
					<script>
						setTimeout(function(){ history.back(); }, 5000);

						function error() {
							Swal.fire({
								icon: "error",
								title: "Henrique do céu tu fez uma cagada absurda cara arruma isso!",
								footer: "por favor...",
								showConfirmButton: false,
								timer: 5000,
								timerProgressBar: true
							})
							
						}
		
						error();
					</script>
				';
			}
		}
	?>
</body>
</html>

