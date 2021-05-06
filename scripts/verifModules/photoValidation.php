<?php
  //essa função espera o parâmetro $FILES['name_do_input']
  function photoValid($fileName) {

    $countFiles = count($fileName['name']);

    for($j =0; $j < $countFiles; $j++) {

      $file = $fileName['name'][$j];

      if (!preg_match("/(.)+(jpg|JPG|jpeg|JPEG|gif|GIF|png|PNG|svg|SVG|bmp|BMP)/", $fileName['name'][$j])) {

        $result = array("status" => "false", "reason" => "Extensão do arquivo $file não é suportada.");
        return $result;

      } else {
    
        //manipulando tamanho da imagem
        $width = 20000;
        $height = 1000;
        //$tamanho = 2000000;
    
        $dimensions = getimagesize($fileName['tmp_name'][$j]);
    
        if ($dimensions[0] > $width || $dimensions[1] > $height) {
          $result = array("status" => "false", "reason" => "Dimensões do arquivo $file são acima das suportadas.");

          return $result;
        }
      }
    }

    for ($i = 0; $i < $countFiles; $i++) {
      
      $extension = explode(".", $fileName["name"][$i]);
      $archiveName = md5(uniqid(time())).".".$extension[1];
      $up = move_uploaded_file($fileName["tmp_name"][$i], "../../img/fotos_hosp/".$archiveName);

      if (!$up) {
        $result = array('status' => 'false', 'reason' => 'Erro na tentaiva de upload da imagem.');
        return $result;
      }
          
    }
    $result = array('status' => 'true', 'reason' => 'upload realizado com sucesso!');
    return $result;
  }

?>