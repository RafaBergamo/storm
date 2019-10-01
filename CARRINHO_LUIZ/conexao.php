<?php
	//Conecta com o PostgreSQL
	$conecta = pg_connect("host=localhost port=5432 dbname=storm user=storm password=26102001storm"); 
	if (!$conecta)
	{
		echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
		exit;
	}
?>
