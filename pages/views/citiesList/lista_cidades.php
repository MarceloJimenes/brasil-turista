<?php
  include_once '../../../scripts/php/conexao.php';

  $id_estado = $_GET['e'];

  $sql =$conexao -> query("select * from cidades where id_estado=$id_estado");

  while ($cidades = mysqli_fetch_array($sql)) {
    echo "<p>Destino Turistico: <a href='../cityInfo/city.php?city=$cidades[id_cidade]'>$cidades[nome]</a></p>";
    echo "<img src='../../../img/fotos_capa/$cidades[foto]' width='500px'>";
  }

  /* $verif = mysqli_num_rows($sql);

  if ($verif == 0) {
    echo "não existe cidades cadastradas nesse estado";
  } else {
    while ($cidades = mysqli_fetch_array($sql)) {
      echo "<p>Destino Turistico: $cidades[nome]</p>";
      echo "<img src='../../img/fotos_capa/$cidades[foto]' width='200px'>";
    }
  } */
?>