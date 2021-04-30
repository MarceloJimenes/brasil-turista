<!DOCTYPE html>
<html lang="en">
  <head>
   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="../../../styles/logo-font.scss">
    <link rel="stylesheet" href="../../../styles/backgrounds.scss">
    <link rel="stylesheet" href="style.scss">
   
    <title>
      <?php
        echo $_GET['name'];
      ?> - Cidades
    </title>
  
  </head>

  <body>
    <main>

      <section class="hero is-fullheight is-dark">
        
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

                      if ($_SESSION["tipo_usuario"] == 3) {
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

        <div class="hero-content has-text-centered">
          <?php

            require_once '../../../scripts/php/conexao.php';


            $id_tt = $_GET['tt'];

            $sql =$conexao -> query("
              select nome, foto, descritivo, cidades.id_cidade as iddacidade from cidades
              inner join cidade_tipo_turismo as ctt
              on cidades.id_cidade = ctt.id_cidade
              where id_tipo_turismo = $id_tt

              order by nome asc
            ");

            $verif = mysqli_num_rows($sql);

            if ($verif == 0) {
              echo 'nenhuma cidade cadastrada para esse tipo de turismo';
            } else {
              while($cities = mysqli_fetch_array($sql)) {
                echo "
                  <div class='city'>
                    <h3 class='title'>$cities[nome]</h3>

                    <figure>
                      <img src='../../../img/fotos_capa/$cities[foto]' alt='Imagem ilustrativa de $cities[nome]' width='500px'/>
                    </figure>

                    <article>
                      $cities[descritivo]
                    </article>

                    <a href='../cityInfo/city.php?city=$cities[iddacidade]'><button class='button is-dark'>Veja mais</button></a>

                  </div>
                ";
              }
            }

          ?>
        </div>
      </section>
    </main>
    
  </body>
</html>

