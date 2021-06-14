<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
  <link rel="stylesheet" href="../../../styles/logo-font.scss">
  <link rel="stylesheet" href="style.css">

  <title>Hospedagens</title>

</head>
<body>


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

            <a class="navbar-item" href="../../../index.php">
              Página inicial
            </a>

            <a class="navbar-item" id="city-register" href="../../cityRegister/cadastro_cidade.php">
              Cadastrar cidade
            </a>

            <a class="navbar-item" id="register" href="../../userRegister/cadastro_usuario.php">
              Inscrever-se
            </a>

            <a class="navbar-item" id="login" href="../../login/login.php">
              Login
            </a>

            <a class="navbar-item" id="my-profile" href="../../userPerfil/perfil.php">
              Meu Perfil
            </a>

            <a class="navbar-item" id="logout" href="../../../scripts/php/logout/index.php">
              Logout
            </a>
            <?php
              
              session_start();

              if(isset($_SESSION['id_usuario'])) {
                echo '
                  <script>
                    document.querySelector("#login").style.display = "none";
                    document.querySelector("#register").style.display = "none";
                  </script>
                ';

                if (isset($_SESSION["tipo_usuario"])==3) {
                  echo '
                    <script>
                      document.querySelector("#city-register").style.display = "none";
                      document.querySelector("#pt-register").style.display = "none";
                    </script>
                  ';
                }
              } else {
                echo '
                  <script>
                    document.querySelector("#logout").style.display = "none";
                    document.querySelector("#my-profile").style.display = "none";
                    document.querySelector("#city-register").style.display = "none";
                    document.querySelector("#pt-register").style.display = "none";
                  </script>
                ';
              }

            ?>
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
  <?php

    require_once "../../../scripts/php/hospedagem/GetHosp.php";
    require_once "../../../scripts/php/conexao.php";

    $counter = quantHosp($conexao);

    if($counter > 0) {
        

      for($i = 1; $i <= $counter; $i++) {
        //box da hospedagem
        echo "<a href='../roomList/index.php?id=$i'><div class='box' style='height: 376px;'>";
        getHosp($conexao, $i);
        echo "</div></a>";
      }
    } else {
      echo "Nenhuma hospedagem cadastrada";
    }
  ?>
</body>
</html>