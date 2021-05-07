<?php
  function insertHosp($conexao, $nome, $endereco, $cidade, $telcel, $email, $tp){
    $insert = $conexao -> query("INSERT INTO hospedagem (tt_hosp, end_hosp,	city_hosp,	tel_hosp,	email_hosp,	tp_hosp) VALUES ('$nome', '$endereco','$cidade', '$telcel', '$email', $tp) ");
    if ($insert==1) {
      return true;
    }else{
      return false;
    }

  }

  function insertAdd($conexao, $id, $tt){
    $insert = $conexao -> query("INSERT INTO add_hosp (id_hosp, tt_add) VALUES ($id, '$tt')");
    if ($insert==1) {
      return true;
    }else{
      return false;
    }

  }

  function insertPhoto($conexao, $id_hosp, $foto){
    $insert = $conexao -> query("INSERT INTO fotos_hosp (id_hosp, tt_foto) VALUES ($id_hosp, '$foto')");
    if ($insert==1) {
      return true;
    }else{
      return false;
    }
  }

?>