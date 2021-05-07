<?php
  function insertRoom($conexao, $id_hosp, $tt, $value, $qtdcamas){
    $insert = $conexao -> query("INSERT INTO quarto (id_hosp, tt_quarto, vl_quarto, qt_camas) VALUES ($id_hosp, '$tt', $value, $qtdcamas)");
    if ($insert) {
      return true;
    }else {
      return false;
    }
  }

  function insertAddRoom($conexao, $id_quarto, $adic ){
    $insert = $conexao -> query("INSERT INTO add_quarto (id_quarto, tt_add) VALUES ($id_quarto, '$adic')");
    if ($insert) {
      return true;
    }else {
      return false;
    }
  }

  function insertPhotoRoom($conexao, $id_quarto, $photo){
    $insert = $conexao -> query("INSERT INTO fotos_quarto (id_quarto, tt_foto) VALUES ($id_quarto, '$photo')");
    if ($insert) {
      return true;
    }else {
      return false;
    }
  }
?>