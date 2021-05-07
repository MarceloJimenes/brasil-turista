<?php

  session_start();

  if (isset($_SESSION['id_usuario'])) {

    require_once '../../scripts/php/conexao.php';

    
    $sql = $conexao -> query("select nome, email, cpf, telefone, sexo from usuario where id_usuario=".$_SESSION["id_usuario"]);

    $usuario = mysqli_fetch_array($sql);

    /* print_r($usuario); */
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- Links -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
      <link rel="stylesheet" href="../../styles/logo-font.scss">
      <link rel="stylesheet" href="../../styles/backgrounds.scss">
      <link rel="stylesheet" href="../../styles/form.scss">
      <link rel="stylesheet" href="style.css">

    <title>
      <?php 

        $getFirstName = explode(' ', $usuario['nome']);

        echo $getFirstName[0];
      
      ?>
    
      - perfil

    </title>

  </head>
  <body>
    <main>
      <section class="hero is-fullheight userBackground">

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
                  <a class="navbar-item" href="../../index.php">
                    Página inicial
                  </a>
                  <a class="navbar-item" id="hosp-register" href="../hospRegister/index.php">
                    Cadastrar Hospedagem
                  </a>
                  <a class="navbar-item" id="room-register" href="../roomRegister/index.php">
                    Cadastrar quarto
                  </a>
                  <a class="navbar-item" id="city-register" href="../cityRegister/cadastro_cidade.php">
                    Cadastrar cidade
                  </a>
                  <a class="navbar-item" id="pt-register">
                    Cadastrar Ponto Turístico
                  </a>
                  <a class="navbar-item" href="../../scripts/php/logout/index.php">
                    Logout
                  </a>
                  <?php
                  
                    if ($_SESSION["tipo_usuario"] == 3) {
                      echo '
                        <script>
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

        <form class="form " action="../../scripts/php/userUpdate/index.php" method="post">

          <h1 class="title has-text-centered">Meu Perfil</h1>

          <div class="editar">
            <!-- <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
            <img src="../../img/svg/pencil.svg" alt="pencil" onClick="habilitar()"/>
          </div>

          <div>
            <p class="label">Nome:</p">
            <input class="input" type="text" name="nome" value="<?php echo $usuario["nome"];?>" id= "nome" disabled>
          </div>
          
          <div>
            <p class="label">E-mail:</p>
            <input class="input" type="text" name="email" value="<?php echo $usuario["email"];?>" id="email" disabled>
          </div>

          <div>
            <p class="label">CPF:</p>
            <input class="input" type="text" name="cpf" value="<?php echo $usuario["cpf"];?>" id="cpf" disabled>
          </div>
          
          <div>
            <p class="label">Telefone:</p>
            <input class="input" type="text" name="telefone" value="<?php echo $usuario["telefone"];?>" id="telefone" disabled>
          </div>

          <div>
            <p class="label">Sexo:</p>
            <select class="select" name="sexo" id="sexo" disabled>
              <option value="<?php echo $usuario['sexo'] ?>">
                <?php 
                  if ($usuario['sexo'] === 'M') {
                    echo '
                      Masculino
                      </option>
                      <option value="F">Feminino</option>
                      <option value="I">Indefinido</option>
                    ';

                  } else if ($usuario['sexo'] === 'F') {
                    echo '
                      Feminino
                      </option>
                      <option value="M">Masculino</option>
                      <option value="I">Indefinido</option>
                    ';
                  } else {
                    echo '
                      Indefinido
                      </option>
                      <option value="M">Masculino</option>
                      <option value="F">Feminino</option>
                    ';
                  }
                ?>
            </select>
          </div>

          <div>
            <p class="label">
              Selo:
              <?php

                if ($_SESSION["tipo_usuario"] == 1) {
                  echo '<em>Administrador(a)</em>';
                } else if ($_SESSION["tipo_usuario"] == 2) {
                  echo '<em>Editor(a)</em>';
                } else {
                  echo '<em>Usuário Comum</em>';
                }

              ?>
            </p>
          </div>

          <div class="container has-text-centered botoes">
            <input class="button is-link" type="submit" value="Atualizar" id="update" disabled>

            <a href="../../scripts/php/deleteUser/index.php" class="button is-danger" id="delete" disabled>Deletar a minha Conta</a>

          </div>

        </form>

      </section>
    </main>
    <script>
      function habilitar() {
        document.querySelector("#nome").removeAttribute("disabled");
        document.querySelector("#email").removeAttribute("disabled");
        document.querySelector("#cpf").removeAttribute("disabled");
        document.querySelector("#telefone").removeAttribute("disabled");
        document.querySelector("#sexo").removeAttribute("disabled");
        document.querySelector("#update").removeAttribute("disabled");
        document.querySelector("#delete").removeAttribute("disabled");
      }
      
    </script>
  </body>
</html>

<?php
  } else {
    echo "
      <p>Por favor efetue o login para acessar essa página!<p>

      <a href='../login/login.php'><button>Ir para Login</button></a>

    ";
    
  }
?>