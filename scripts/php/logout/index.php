<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bulma -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <!--  -->
  <!-- Sweet -->
  <link rel="stylesheet" href="../../../node_modules/@sweetalert2/theme-borderless/borderless.css"> 
  <script src="../../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
  <!--  -->
  <title>Brasil Turista</title>
</head>
<body>
  <?php

    session_start();

    session_destroy();

    echo '
      <script>
        setTimeout(function(){ location.href="../../../index.php"; }, 3000);

        function error() {
          Swal.fire({
            icon: "warning",
            title: "Até mais",
            footer: "Esperamos você em breve, obrigado por utilizar o Brasil Turista!",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
          })
          
        }

        error();
      </script>
    ';

  ?>
  
</body>
</html>

