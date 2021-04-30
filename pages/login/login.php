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
  <link rel="stylesheet" href="style.scss">

  <!-- Include the Borderless theme -->
  <link rel="stylesheet" href="../../node_modules/@sweetalert2/theme-borderless/borderless.css">

  <!-- Scripts JS -->
  <script src="../../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

  <title>Login</title>
</head>

<body>

  <main>
      
    <section class="hero is-hero-background is-fullheight">

      <!-- HERO HEAD -->
      <div class="hero-head">
        <header class="navbar">
          <div class="container">
            <div class="navbar-brand">
              <a href="../../index.php" class="navbar-item">
                <p class="has-text-light">
                  &larr; voltar
                </p>
              </a>
            </div>            
          </div>
        </header>
      </div>

      <!-- HERO CONTENT -->
      <div class="hero-body">
        <div class="container">
  
          <form class="form" action="" method="post">

            <p class="title logo-title-menu has-text-centered">
                  Brasil Turista
            </p>

            <h2 class="has-text-centered">Efetue o login:</h2>

            <div>
              <label class="label">E-mail: </label>
              <input class="input" type="text" name="email" required/>
            </div>

            <div>
            <label class="label">Senha: </label>
              <input class="input" type="password" name="senha" required/>
            </div>

            <div class="botoes has-text-centered">
              <input class="button is-success" type="submit" value="Login"/>
            </div>

          </form>

          <?php
          
            if (isset($_POST['email']) && isset($_POST['senha'])) {

              require_once '../../scripts/php/conexao.php';

              $email = $_POST['email'];
              $senha = sha1($_POST['senha']);


              $sql = $conexao -> query("select id_usuario, email, senha, user_type from usuario where email = '$email' and senha = '$senha'");

              $achei = mysqli_num_rows($sql);
              
              if ($achei == 1) {

                $login = mysqli_fetch_array($sql);
                
                session_start();
                $_SESSION["id_usuario"] = $login["id_usuario"];
                $_SESSION["tipo_usuario"] = $login["user_type"];
                header("Location: ../userPerfil/perfil.php");

              } else {
                echo '
                  <script>
                    function error() {
                      Swal.fire({
                        position: "top-end",
                        toast: true,
                        icon: "error",
                        title: "usuário ou senha inválidos",
                        footer: "verifique os dados e tente novamente",
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true
                      })
                    }

                    error();
                  </script>
                ';
              }

            }

          ?>
        </div>
      </div>
    </section>
  </main>

</body>

</html>