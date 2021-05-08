<?php

function quantRooms($conexao, $idHosp) {
  $sql = $conexao -> query("select * from quarto where id_hosp=". $idHosp);

  $result = mysqli_num_rows($sql);

  return $result;
}

function getRooms($conexao, $idHosp) {

  $getRooms = $conexao -> query("select * from quarto where id_hosp=".$idHosp);

  while($quartos = $getRooms ->  fetch_array()){
    $idRoom = $quartos;
    //querys 
    $getAddRoom = $conexao -> query("select * from add_quarto where id_quarto=".$idRoom['id_quarto']);
    $getRoomPhotos = $conexao -> query("select * from fotos_quarto where id_quarto=".$idRoom['id_quarto']);


    if(mysqli_num_rows($getRoomPhotos) > 0) {

      echo "<div class = 'box'>";

      echo "<div class='galeria'>";

        while($fotos = $getRoomPhotos -> fetch_array()) {
          echo "<img src='../../../img/fotos_quarto/$fotos[tt_foto]' class='foto'>";
        }

      echo"</div>";

    }



    $add = array();

    while($i = $getAddRoom -> fetch_array()) {
      $add[] = $i['tt_add'];
    }

    $addList = implode(", ", $add);

    echo "

      <div class='info' style='padding: 15px;'>
        <h1 class = 'title'>$idRoom[tt_quarto]</h1>
        <p><strong>Valor:</strong> R$$idRoom[vl_quarto]</p>
        <p><strong>Adicionais:</strong> ".$addList.".</p>
        <p><strong>Camas:</strong> ".$idRoom['qt_camas']."</p>
      </div>

    ";

    echo "</div>";

  }

  


    
}