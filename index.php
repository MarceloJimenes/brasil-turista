<?php

  include_once 'scripts/php/conexao.php';

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="styles/logo-font.scss">
    <link rel="stylesheet" href="styles/backgrounds.scss">
    <link rel="stylesheet" href="styles/index.scss">

    <!-- Scripts -->
    <script src="scripts/javascript/selectedSection.js"></script>

    <title>Brasil Turista</title>
  </head>

  <body>

    <main>
      
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

                  <a class="navbar-item" href="#">
                    Página inicial
                  </a>

                  <a class="navbar-item" href="pages/views/hospList">
                    Hospedagens
                  </a>

                  <a class="navbar-item" id="city-register" href="pages/cityRegister/cadastro_cidade.php">
                    Cadastrar cidade
                  </a>

                  <a class="navbar-item" id="pt-register">
                    Cadastrar Ponto Turístico
                  </a>

                  <a class="navbar-item" id="register" href="pages/userRegister/cadastro_usuario.php">
                    Inscrever-se
                  </a>

                  <a class="navbar-item" id="login" href="pages/login/login.php">
                    Login
                  </a>

                  <a class="navbar-item" id="my-profile" href="pages/userPerfil/perfil.php">
                    Meu Perfil
                  </a>

                  <a class="navbar-item" id="logout" href="scripts/php/logout/index.php">
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

        <!-- HERO CONTENT -->
        <div class="hero-body">
          <div class="container has-text-centered">
            <p class="title logo-title">
              Brasil Turista
            </p>
            <p class="subtitle logo-subtitle">
              chegou a hora de conhecer o tesouro nacional
            </p>
          </div>
        </div>

        <!-- HERO FOOTER -->
        <div class="hero-foot">
          <nav class="tabs is-boxed is-fullwidth">
            <div class="container">
              <ul>
                <li><a id='tourist_attractions' href="#tourist_attractions" onclick="selectedTouristAtt()">Pontos Turísticos</a></li>
                <li id='experience'><a>Experiências</a></li>
                <li><a>(Em breve)</a></li>
                <li><a>(Em breve)</a></li>
                <li><a>(Em breve)</a></li>
                <li><a>(Em breve)</a></li>
              </ul>
            </div>
          </nav>
        </div>
      
      </section>

      <section id="tourist_attractions" class="hero">
        <div class="hero-body">
          <h3 class="subtitle">Principais Destinos</h3>

          <table class="table is-bordered">
            <tr>
              <td>
                FOTO DE SÃO PAULO
              </td>

              <td>
                FOTO DE APARECIDA
              </td>
            </tr>

            <tr>
              <td>
                SÃO PAULO
              </td>

              <td>
                APARECIDA
              </td>
            </tr>
          </table>
        
        </div>

        <div class="hero-body">
          <h3 class="subtitle">Destinos por tipo de turismo</h3>

          <ul>
            <?php
              $queryTipos = $conexao -> query("select id_tipo_turismo, nome from tipo_turismo order by nome asc");
              while ($tipos = mysqli_fetch_array($queryTipos)) {
                echo "<li><a href='pages/views/city_tt/cidades_tipo_turismo.php?tt=$tipos[id_tipo_turismo]&name=$tipos[nome]'>$tipos[nome]</a></li>";
              }
            ?>
          </ul>

          
        </div>

        <div class="hero-body">
          <h3 class="subtitle">Destino por estado</h3>

          <ul>
            <?php
              $queryEstados = $conexao -> query("
                select distinct a.nome, b.id_estado as id from estados as a
                inner join cidades as b
                on a.id_estado = b.id_estado
              ");
              while ($estados = mysqli_fetch_array($queryEstados)) {
                echo "<li><a href='pages/views/citiesList/lista_cidades.php?e=$estados[id]'>$estados[nome]</a></li>";
              }
            ?>
          </ul>
        </div>

      </section>

    </main>
  
  </body>

</html>