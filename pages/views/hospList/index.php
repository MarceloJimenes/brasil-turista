<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">

  <title>Hospedagens</title>

</head>
<body>
  <?php
  
    require_once "../../../scripts/php/hospedagem/GetHosp.php";
    require_once "../../../scripts/php/conexao.php";

    $counter = quantHosp($conexao);

    if($counter > 0) {
      

      for($i = 1; $i <= $counter; $i++) {
        //box da hospedagem
        echo "<a href='../roomList/index.php?id=$i'><div class='box'>";
        getHosp($conexao, $i);
        echo "</div></a>";
      }
    } else {
      echo "Nenhuma hospedagem cadastrada";
    }



    /*  */

  ?>
</body>
</html>