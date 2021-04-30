<?php
	function ChecaEmail($email, $conexao){
		$sql = $conexao -> query("SELECT email FROM usuario WHERE email ='$email'");
		$acheiemail = mysqli_num_rows($sql);
		
		if($acheiemail==1){
			return true;
		}else{
			return false;
		}
	}
	
?>