

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bottons</title>
    
 <link rel="stylesheet" type="text/css" href = "estilo.css" />  
<style>
   .btnComprar {
	background-color:#4294FF;
	-moz-border-radius:28px;
	-webkit-border-radius:28px;
	border-radius:28px;
	border:1px solid #4294FF;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:23px;
	font-weight:bold;
	font-style:italic;
	padding:7px 30px;
	text-decoration:none;
	text-shadow:0px 1px 11px #2f6627;
}
.btnComprar:hover {
	background-color:#;
}
.btnComprar:active {
	position:relative;
	top:1px;
}
.myButton {
	-moz-box-shadow:inset 0px 1px 3px 0px #fc0a0a;
	-webkit-box-shadow:inset 0px 1px 3px 0px #fc0a0a;
	box-shadow:inset 0px 1px 3px 0px #fc0a0a;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff0000), color-stop(1, #856666));
	background:-moz-linear-gradient(top, #ff0000 5%, #856666 100%);
	background:-webkit-linear-gradient(top, #ff0000 5%, #856666 100%);
	background:-o-linear-gradient(top, #ff0000 5%, #856666 100%);
	background:-ms-linear-gradient(top, #ff0000 5%, #856666 100%);
	background:linear-gradient(to bottom, #ff0000 5%, #856666 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0000', endColorstr='#856666',GradientType=0);
	background-color:#ff0000;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	border:1px solid #ff0022;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:21px;
	font-weight:bold;
	padding:1px 6px;
	text-decoration:none;
	text-shadow:0px -1px 0px #f50c3b;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #856666), color-stop(1, #ff0000));
	background:-moz-linear-gradient(top, #856666 5%, #ff0000 100%);
	background:-webkit-linear-gradient(top, #856666 5%, #ff0000 100%);
	background:-o-linear-gradient(top, #856666 5%, #ff0000 100%);
	background:-ms-linear-gradient(top, #856666 5%, #ff0000 100%);
	background:linear-gradient(to bottom, #856666 5%, #ff0000 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#856666', endColorstr='#ff0000',GradientType=0);
	background-color:#856666;
}
.myButton:active {
	position:relative;
	top:1px;
}

</style>

</head>
<body>
  
<center>  
    
<div style="background-color: lightgrey;
width:999px;
height: 5000px;" >

<div id="home">
<a href="carrinho.php" title="Carrinho"><img src="imagens/cart.png" width="30px";class="carrinho"></a>
                
         <label class="qtdProd">0</label>  <H1>BOTTONS</H1> 

    </div>

            
    
<div id="logomarca">
<img src="imagens/storm.png" style="width:150px"> 

<!-- fechamento da div logomarca -->
</div>



    



<div id="navbar">
<!--área dos botões-->
     <a href="index.html"><button style="width: 100px; height: 39px;">Home</button></a>
     <a href="produtos.php"><button style="width: 100px; height: 39px;">Bottons</button></a>
     <a href="design.html"><button style="width: 100px; height: 39px;">Design</button></a>
     <a href="contato.html"><button style="width: 100px; height: 39px;">Contato</button></a>
     

                 
           

    </div>
<br>
<?php


try{
    
    $myPDO= new PDO("pgsql:host=localhost;dbname=storm","storm","26102001storm");
    
    
}catch(PDOException $e){
    
    echo $e->getMessage();
}
finally{
    
    $select=$myPDO->prepare("select * from produto");
    $select->execute();	
    $fetch=$select->fetchAll();       
           
}
?>



 <ul style="list-style-type: none;" class="bottons_list" > 
<?php
 foreach($fetch as $produto){ 
?>
    
	 <li> 
	<?php
   		echo'<img src="http://200.145.153.172/storm/imagens/'.$produto['imagem_produto'].'"width="40%; text-align:center;">';
	

  		echo'<h4>'.$produto['nome_produto'].' </h4><br>Quantidade Disponivel: '.$produto['quantidade_produto'].'<br>Valor:  '.$produto['preco_produto'].'<a href="carrinho.php?add=carrinho&id='.$produto['cod_produto'].'"><br><br>';
		echo "<a href='carrinho.php?acao=add&codproduto=".$linha['cod_produto']."'>Comprar</a>";
echo '&nbsp;&nbsp;&nbsp;<a href="index.html" class="myButton">+</a>';
		echo "<br><br>";
		   
  	?>    	
	</li> 
<?php
}
?>
</ul>

   <div id="rodape"> 
    <br><br><br>
   <a href="index.html"><button style="width: 100px; height: 39px;">Home</button></a>
     <a href="produtos.php"><button style="width: 100px; height: 39px;">Produtos</button></a>
     <a href="design.html"><button style="width: 100px; height: 39px;">Design</button></a>
     <a href="contato.html"><button style="width: 100px; height: 39px;">Contato</button></a>
     <a href="produtos.html"><button style="width: 100px; height: 39px;">Topo</button></a>
    
    
	<!-- fechamento da div rodape--> 
</div>       

<!-- fechamento da div mãe-->
</div>  
 
</center>             </body>
</html>
