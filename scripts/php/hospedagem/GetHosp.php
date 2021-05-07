<?php

function quantHosp($conexao) {
  $sql = $conexao -> query("select tt_hosp from hospedagem");

  $result = mysqli_num_rows($sql);

  return $result;
}

function getHosp($conexao, $idHosp) {

  //querys hospedagem
  $gethosp = $conexao -> query("select * from hospedagem where id_hosp=".$idHosp);
  $getAddHosp = $conexao -> query("select * from add_hosp where id_hosp=".$idHosp);
  $getHospPhotos = $conexao -> query("select * from fotos_hosp where id_hosp=".$idHosp);
  $getRoom= $conexao -> query("select tt_quarto from quarto where id_hosp=".$idHosp);

  $add = array();

  while($i = $getAddHosp -> fetch_array()) {
    $add[] = $i['tt_add'];
  }

  $addList = implode(", ", $add);

  $counterRoom = mysqli_num_rows($getRoom);
  


  if(mysqli_num_rows($gethosp) > 0) {

    if(mysqli_num_rows($getHospPhotos) > 0) {

      echo "<div class='galeria'>";

        while($fotos = $getHospPhotos -> fetch_array()) {
          echo "<img src='../../../img/fotos_hosp/$fotos[tt_foto]' class='foto'>";
        }

      echo"</div>";

    }

    $data = $gethosp -> fetch_assoc();

    $getHospCity = $conexao -> query("select nome from cidades where id_cidade = ".$data["city_hosp"]);

    $city = $getHospCity -> fetch_assoc();

    switch ($data['tp_hosp']) {
      case 1:
        $type = "Hostel";
      break;

      case 2:
        $type = "Pousada";
      break;

      case 3:
        $type = "Resort";
      break;
      
      default:
        $type = "Hotel";
      break;
    }

    echo "

      <div class='info' >
        <h1 class='title'>$data[tt_hosp]</h1>
        <p><strong>Localizada em:</strong> <span>$city[nome].</span></p>
        <p><strong>Endereço:</strong> $data[end_hosp]</p>
        <p><strong>Tipo de Hospedagem:</strong> $type.<p>
        <p><strong>Adicionais:</strong> ".$addList.".</p>
        <p><strong>Número de Quartos:</strong> ".$counterRoom."</p>

        <div class='contato'>
          <h3>Contato</h3>
          <p><strong>Telefone:</strong> $data[tel_hosp]</p>
          <p><strong>Email:</strong> $data[email_hosp]</p>
        </div>


      </div>

    ";


  } else {
    echo "Nenhuma hospedagem cadastrada!";
  }

}