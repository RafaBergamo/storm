<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: TesteBD1
Tabela: produto
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Video Aula sobre Carrinho de Compras</title>
</head>
 
<body>
<?php
	require "conexao.php";

	$sql = "select * from produto where status_produto = 'true' order by nome_produto";
	$res = pg_query($conecta, $sql);
	$qtde=pg_num_rows($res);
	if($qtde>0)
		while($linha = pg_fetch_array($res))
        {
			echo "<h2>".$linha['nome_produto']."</h2> <br />";
            $precopro=$linha['preco_produto'];
            $precopro=floatval(str_replace("R$", "", "$precopro"));
           // echo "calculo=".$precopro;
            
			echo "Pre&ccedil;o : ".$linha['preco_produto']."<br />";
//echo "<img src='http://200.145.153.172/storm/imagens/".$linha['imagem_produto']."'  width='10%' <br />";
echo "<img src='http://200.145.153.172/storm/imagens/".$linha['imagem_produto']."'  width='10%' <br />";
			echo "<a href='carrinho.php?acao=add&codproduto=".$linha['cod_produto']."'>Comprar</a>";
			echo "<br /><hr />";
	}
	else
		echo "<br />N&atilde;o h&aacute; produtos dispon&iacute;veis!<br />";
    
?>
 
</body>
 
</html>