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

    <title>update feedback</title>
 </head>
 <body>
  <?php
    
    require_once '../conexao.php';

    session_start();

    $sql = $conexao -> query ("update usuario SET nome = '$_POST[nome]', email = '$_POST[email]', telefone = '$_POST[telefone]', cpf = '$_POST[cpf]', sexo = '$_POST[sexo]' where id_usuario=$_SESSION[id_usuario]");

    if ($sql == true) {
      echo '
        <script>

          setTimeout(function(){ location.href = "../../../pages/userPerfil/perfil.php"; }, 2000);

          function success() {
            Swal.fire({
              icon: "success",
              title: "pronto",
              footer: "dados alterados com sucesso!",
              showConfirmButton: false,
              timer: 2000,
              timerProgressBar: true,
            })
            
          }

          success();

          

        </script>
      ';
    } else {
      echo '
        <script>

        setTimeout(function(){history.back();}, 3000);
          
          function error() {
            Swal.fire({
              icon: "error",
              title: "erro na atualização do perfil",
              footer: "verifique os dados e tente novamente.",
              showConfirmButton: false,
              timer: 3000
            })
          }

          error();

          </script>
      ';
    }

  ?>
 </body>
 </html>
 

