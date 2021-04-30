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

  <title>Good Bye!</title>
</head>
<body>
  <?php

  session_start();

  require_once '../conexao.php';

  $sql = $conexao -> query ("delete from usuario where id_usuario=$_SESSION[id_usuario]");

  if ($sql == 1) {
    session_destroy();
    echo '
      <script>
        setTimeout(function(){ location.href = "../../../index.php"; }, 5000);

        function success() {
          Swal.fire({
            icon: "success",
            title: "Conta excluída com sucesso",
            footer: "você fará falta na comunidade, volte assim que puder!",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true
          })
          
        }

        success();
      </script>
    ';
  } else {
    echo '
      <script>
        setTimeout(function(){history.back();}, 5000);

        function error() {
          Swal.fire({
            icon: "error",
            title: "ops",
            footer: "parece que algo não funcionou direito, tente novamente mais tarde!",
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
          })
          
        }

        error();
      </script>
    ';
  }

  ?>
</body>
</html>




