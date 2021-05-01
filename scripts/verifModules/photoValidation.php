<?php
  //essa função espera o parâmetro $FILES['name_do_input']
  function photoValid($fileName) {
    if (!preg_match("/(.)+(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG|svg|SVG|bmp|BMP)/", $fileName['name'])) {

      exit(json_encode(array('status' => 'false', 'reason' => 'Extensão de arquivo não suportada.')));
    } else {
  
      //manipulando tamanho da imagem
      $width = 20000;
      $height = 1000;
      //$tamanho = 2000000;
  
      $dimensions = getimagesize($fileName['tmp_name']);
  
      if ($dimensions[0] > $width || $dimensions[1] > $height) {
        exit(json_encode(array('status' => 'false', 'reason' => 'Dimensões acima das suportadas.')));
      } else {
        $extension = explode(".", $fileName["name"]);
        $archiveName = md5(uniqid(time())).".".$extension[1];
        $up = move_uploaded_file($fileName["tmp_name"], "../../img/fotos_hosp/".$archiveName);
      }
    }
  }

?>