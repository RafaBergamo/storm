<?php
	session_start();
	$email=$_POST["email"];
	$senha=md5($_POST["senha"]);
	include "conecta.php";		
		$query = "select * from cliente where email_cliente = '$email' and senha_cliente = '$senha'";
		$busca=pg_query($banco,$query);
		$qtde=pg_num_rows($busca);
		if ( $qtde == 0)
		{
			echo "<script>alert('Cliente não existe ou senha incorreta !!');</script>";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.html'>";
      		}
		else
        	{
			$_SESSION['logou']="logado";
			echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.html'>";		
        	} 
        pg_close($banco);
?>
