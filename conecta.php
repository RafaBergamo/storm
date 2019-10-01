<?php
	$banco = pg_connect("host=localhost port=5432 dbname=storm  user=storm password=26102001storm");
                if ( ! $banco )
                        {
                                echo "Erro de conexao !!";
                                exit;
                        }
?>
