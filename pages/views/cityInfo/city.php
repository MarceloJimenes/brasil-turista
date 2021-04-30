<?php

  require_once '../../../scripts/php/conexao.php';

  $sql = $conexao -> query 
  ("
    select id_cidade, c.nome as cidade, descritivo, foto, e.nome as estado, sigla, e.id_estado
    from cidades as c inner join estados as e 
    on e.id_estado = c.id_estado 
    where id_cidade = ".$_GET['city']
  );

  $cidade = $sql -> fetch_assoc();

  echo "<h1>$cidade[cidade] - $cidade[sigla]</h1>";
  echo "<h1>$cidade[estado]</h1>";

?>

  <table>
  
    <tr>
      <td><img src="../../../img/fotos_capa/<?php echo $cidade['foto']?>" alt="foto-cidade"></td>
    </tr>
    <tr>
      <td><?php echo $cidade['descritivo'] ?></td>
    </tr>

  </table>

<?php

  $fetchCities = $conexao -> query("select nome, id_cidade from cidades where id_estado = ".$cidade['id_estado']." and id_cidade <> ".$_GET['city']);

  if (mysqli_num_rows($fetchCities) != 0) {
    echo "<h3>Mais destinos em: $cidade[estado]</h3>";

    while ($md = mysqli_fetch_array($fetchCities)) {
      echo "<p><a href='city.php?city=$md[id_cidade]'>$md[nome]</a></p>";
    }
  }

  echo "<p>já esteve em $cidade[cidade]?<br>Então compartilhe sua experiência conosco</p>";

  session_start();

  if (isset($_SESSION['id_usuario'])) {
    echo "
      <form action='' method='post'>
        <p>
          <label for='title'>Título da Experincia:</label>
          <input type='text' name='title' id='title'>
        </p>
        <p>
          <label for='xp'>Descreva sua experiência:</label>
          <textarea name='xp' id='xp' cols='30' rows='10'></textarea>
        </p>
        <input type='submit' value='compartilhar'>
      </form>
    ";
  } else {
    echo "<a href='../../login/login.php'><p>Faça o login para compartilhar!</p></a>";
  }

  if (isset($_POST['xp'])) {

    $date = date('d-m-Y');

    $sql = $conexao -> query 
    ("
      insert into experiencias (id_cidade, id_usuario, titulo, texto, data) 
      values 
      ('$_GET[city]', '$_SESSION[id_usuario]', '$_POST[title]', '$_POST[xp]', '$date'
    ");

    if ($sql) {
      
    }

  }

?>

