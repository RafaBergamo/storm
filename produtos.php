<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Design</title>
    
 <link rel="stylesheet" type="text/css" href = "estilo.css" />  
  

</head>
<body>
  
<center>  
    
<div id="prod" >

<div id="cliente"> 

<img src="imagens/user5.png" align="left" style="width:60px; margin-top: 8px;">

<div id="link_log">

<a href="login.html"> <button class="botaoAcesso"> Acesso </button> </a>

</div>


 </div> 	

<div id="logomarca">
<img src="imagens/storm.png" style="width:150px"> 
<div id="titulo" > <h1>BOTTONS</h1> </div>
<!-- fechamento da div logomarca -->
</div>



<div id="navbar">
<center>
     <a href="index.html"><button class="botaoMenu">Home</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="produtos.php"><button class="botaoMenu">Bottons</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="design.html"><button class="botaoMenu">Design</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="contato.html"><button class="botaoMenu">Contato</button></a>
  </center>

    </div>

<ul style="list-style-type: none;" class="bottons_list" > 

<?php
	require "conecta.php";

	$sql = "select * from produto where status_produto = 'true' order by nome_produto";
	$res = pg_query($banco, $sql);
	$qtde=pg_num_rows($res);
	if($qtde>0)
		while($linha = pg_fetch_array($res))
        {
?>
		<li>
	<?php
			echo "<img src='http://200.145.153.172/storm/imagens/".$linha['imagem_produto']."'  width='40%' <br>";

			echo "<h2>".$linha['nome_produto']."</h2> ";
           		
            		$precopro=floatval(str_replace("R$", "", "$precopro"));
           

			 $precopro=$linha['preco_produto'];
			
			echo "Valor : ".$linha['preco_produto']."<br />";
			echo "<a href='carrinho.php?acao=add&codproduto=".$linha['cod_produto']."'> <button> Comprar </button> </a>";
			echo "<br><br>";

	?>
		</li> 
	<?php
	}
	else
		echo "<br />N&atilde;o h&aacute; produtos dispon&iacute;veis!<br />";
    
?>
 </ul>  

<div id="rodape"> 
<center>
     <a href="index.html"><button class="botaoMenu">Home</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="produtos.php"><button class="botaoMenu">Bottons</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="design.html"><button class="botaoMenu">Design</button></a>&emsp;&emsp;&emsp;&emsp;&emsp;
     <a href="contato.html"><button class="botaoMenu">Contato</button></a>
  </center>

<!-- fechamento da div rodape--> 
</div>       

<!-- fechamento da div mãe-->
</div>  
 
</center>             </body>
</html>