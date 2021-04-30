<?php
//conexão com o banco de dados
require_once '../conexao.php';

$arquivo = $_FILES['foto'];

$nome = $_POST["nome"];
$estado = $_POST["estado"];
$descricao = $_POST["descricao"];

//Validações de arquivo

if ($arquivo['error'] == 4) {

	echo '<script>
						alert("Insira uma imagem por favor");
						history.back();
					</script>';
} else {
	if (!preg_match("/(.)+(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG|svg|SVG|bmp|BMP)/", $arquivo['name'])) {

		echo '<script>
							alert("Por favor envie uma IMAGEM!");
							history.back();
					</script>';
	} else {

		//manipulando tamanho da imagem

		$largura = 20000;
		$altura = 1000;
		$tamanho = 2000000;

		$dimensoes = getimagesize($arquivo['tmp_name']);

		if ($dimensoes[0] > $largura || $dimensoes[1] > $altura) {
			echo '<script>
								alert("Por favor envie uma imagem menor!");
								history.back();
							</script>';
		} else {
			$extensao = explode(".", $arquivo["name"]);
			$nomearquivo = md5(uniqid(time())).".".$extensao[1];
			$upar = move_uploaded_file($arquivo["tmp_name"], "../../../img/fotos_capa/".$nomearquivo);

			//verficar se o upload foi feito antes de prosseguir com o sistema
			if ($upar) {

				//inicio das inserções:
				$query = "INSERT INTO cidades (id_estado,nome,descritivo,foto)
					VALUES ('$estado','$nome','$descricao','$nomearquivo')";

				$insere = mysqli_query($conexao, $query);

				//resgatando o ultimo id
				$ultimoId = mysqli_insert_id($conexao);

				foreach ($_POST['tt'] as $tipos_turismo) {
					$queryTypes = "INSERT INTO cidade_tipo_turismo (id_cidade,id_tipo_turismo) VALUES ($ultimoId, $tipos_turismo)";

					$insereTT = mysqli_query($conexao, $queryTypes);
				}

				//echo $query;exit;
				if ($insere == 1 && $insereTT) {
					echo "
							<script>
								alert('Cidade cadastrada com sucesso');
								location.href='../../../pages/cityRegister/cadastro_cidade.php';
							</script>";
				} else {
					echo "<script>
										alert('Deu Ruim');
										history.back();
								</script>";
				}
			}
		}
	}
}
