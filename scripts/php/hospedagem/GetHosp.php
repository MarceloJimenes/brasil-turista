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
          echo "<img src='../../../img/fotos_hosp/$fotos[tt_foto]' width='420px' height='250px' style='object-fit: cover; margin: 10px;' class='foto'>";
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

      <div class='info'>
        <h1>$data[tt_hosp]</h1>
        <p>localizada em: <span>$city[nome].</span></p>
        <p>Endereço: $data[end_hosp]</p>
        <p>tipo de hospedagem: $type.<p>
        <p>adicionais: ".$addList.".</p>
        <p>número de quartos: ".$counterRoom."</p>

        <div class='contato'>
          <h3>contato</h3>
          <p>telefone: $data[tel_hosp]</p>
          <p>email: $data[email_hosp]</p>
        </div>


      </div>

    ";


  } else {
    echo "Nenhuma hospedagem cadastrada!";
  }

}