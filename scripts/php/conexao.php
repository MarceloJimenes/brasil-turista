<?php
	ini_set('default_charset', 'UTF-8');
	$conexao = mysqli_connect('localhost', 'root', '','brasilturista') or die ('Erro de conexão');
	$conexao -> query("SET NAMES utf8");
	//var_dump($conexao);
?>