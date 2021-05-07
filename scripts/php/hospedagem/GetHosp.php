<?php

function getHosp($conexao) {

  $sql = $conexao -> query 
  ("
    select 
    
    add_quarto.tt_add as tt_add_quarto, add_hosp.tt_add as tt_add_hosp,
    fotos_quarto.id_foto as id_foto_quarto, fotos_hosp.id_foto as id_foto_hosp,
    fotos_quarto.tt_foto as tt_foto_quarto, fotos_hosp.tt_foto as tt_foto_hosp,
    tt_hosp, city_hosp,tel_hosp, email_hosp, tp_hosp, hospedagem.id_hosp as id_hospedagem,
    quarto.id_quarto as id_room, tt_quarto, vl_quarto, qt_camas   

    from hospedagem
    inner join quarto
    on quarto.id_hosp = hospedagem.id_hosp
    inner join fotos_hosp
    on fotos_hosp.id_hosp = hospedagem.id_hosp
    inner join fotos_quarto
    on fotos_quarto.id_quarto = quarto.id_quarto
    inner join add_hosp
    on add_hosp.id_hosp = hospedagem.id_hosp
    inner join add_quarto
    on add_quarto.id_quarto = quarto.id_quarto
  ");

  if(mysqli_num_rows($sql) > 0) {

    $data = array();

    $data = $sql -> fetch_array();
    
    echo json_encode($data);

  } else {
    echo "Nenhuma hospedagem cadastrada!";
  }

}