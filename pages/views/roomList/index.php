<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Quartos</title>
</head>
<body>
  <?php
  
    require_once "../../../scripts/php/hospedagem/GetRooms.php";
    require_once "../../../scripts/php/conexao.php";

    $counter = quantRooms($conexao, $_GET['id']);

    if($counter > 0) {
      for($i = 1; $i <= $counter; $i++){
        echo "<div class='box'>";
        getRooms($conexao, $_GET['id']);
        echo "</div>";
      }
    } else {
      echo "Nenhum quarto cadastrado!";
    }
    
 
  ?>
</body>
</html>