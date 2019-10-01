<?php
 // Resultado da confirmação de e-mail que é recebido pelo utilizador.
 include "conecta.php";
 $id = $_GET["id"];
$sql = "UPDATE cliente SET status_cliente='true' WHERE cod_cliente=$id";
$result = pg_query($banco,$sql) or die(pg_last_error());
if($result)
{
echo '<div>A sua conta está ativa. Já pode <a href="login.html">Entrar.
</a></div>';
}
else
{
echo "Ocorreu um erro.";
}
?>