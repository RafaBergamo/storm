<!DOCTYPE html>
<html lang "pt-br">
<head>
<link rel="stylesheet" type="text/css" href = "estilo.css" /> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carrinho de Compras</title>
</head>
 
<body>

<center> <div id="mae" >
<div id="cliente"> 

<img src="imagens/user5.png" align="left" style="width:60px; margin-top: 8px;">

<div id="link_log">

<a href="login.html"> <button class="botaoAcesso"> Acesso </button> </a>

</div>


 </div> 



<div id="logomarca">
<img src="imagens/storm.png" style="width:150px"> 
<div id="titulo" > <h1>CARRINHO</h1> </div>


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


<?php


      session_start();
       
      if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }
       
      //adiciona produto
       
      if(isset($_GET['acao'])){
          
         //ADICIONAR CARRINHO
         if($_GET['acao'] == 'add'){
            $codproduto = intval($_GET['codproduto']);
            if(!isset($_SESSION['carrinho'][$codproduto])){
               $_SESSION['carrinho'][$codproduto] = 1;
            }else{
               $_SESSION['carrinho'][$codproduto] += 1;
            }
         }
          
         //REMOVER CARRINHO
         if($_GET['acao'] == 'del'){
            $codproduto = intval($_GET['codproduto']);
            if(isset($_SESSION['carrinho'][$codproduto])){
               unset($_SESSION['carrinho'][$codproduto]);
            }
         }
          
         //ALTERAR QUANTIDADE
         if($_GET['acao'] == 'up'){
            if(is_array($_POST['prod'])){
               foreach($_POST['prod'] as $codproduto => $qtd){
                  $codproduto  = intval($codproduto);
				  //desprezar a parte decimal
                  $qtd = intval($qtd);
                  if(!empty($qtd) && $qtd > 0){
                     $_SESSION['carrinho'][$codproduto] = $qtd;
                  }else{
                     unset($_SESSION['carrinho'][$codproduto]);
                  }
               }
            }
         }
       
      }
       
       
?>
	<table>
		<caption>Carrinho de Compras</caption>
		<thead>
			  <tr>
				<th width="244">Produto</th>
				<th width="79">Quantidade</th>
				<th width="89">Pre&ccedil;o</th>
				<th width="100">SubTotal</th>
				<th width="64">Remover</th>
			  </tr>
		</thead>
		<form action="?acao=up" method="post">
		<tfoot>
			   <tr>
				<td colspan="5"><input type="submit" value="Atualizar Carrinho" /></td>
				<tr>
				<td colspan="5"><a href="produtos.php">Continuar Comprando</a></td>
		</tfoot>
		  
		<tbody>
		   <?php
			 if(count($_SESSION['carrinho']) == 0){
				echo '<tr><td colspan="5">N&atilde;o h&aacute; produto no carrinho</td></tr>';
			 }else{
				require("conecta.php");
				$total = 0;
				foreach($_SESSION['carrinho'] as $codproduto => $qtd){
					$sql = "select * from produto where cod_produto=$codproduto	and status_produto = 'TRUE' 
							order by nome_produto";
					$res = pg_query($banco, $sql);
					$regs = pg_num_rows($res);
                    
					if($regs>0){
						$linha = pg_fetch_array($res);
						  
                        
						$descricao = $linha['nome_produto'];
						
                        $preco = $linha['preco_produto'];
                        //$preco=doubleval(str_replace("R$", "", "$preco"));                        
						$sub = strval($preco);//transforma em string
						$sub = str_replace(".","", $sub);//onde achar ponto, retira. Esse procedimento é para evitar problema com preços maiores que R$ 1.000,00.
						$sub = str_replace(",",".", $sub);//onde achar vírgula, substitui por ponto. Esse procedimento converte para padrão americano.
						$sub = str_replace("R$","", $sub);//onde achar R$, retira.
						$sub = floatval($sub);//transforma em float
						$sub *= $qtd; 
						$total += $sub;
						$sub = number_format($sub, 2, ',', '.');//formata para padrão brasileiro.	
					}
                       				echo "<img src='http://200.145.153.172/storm/imagens/".$linha['imagem_produto']."'  width='8%' <br>";
                        
					echo '<tr>
						   
						 <td>'.$descricao.'</td>
						 <td><input type="text" size="3" name="prod['.$codproduto.']" value="'.$qtd.'" /></td>
						 <td>'.$preco.'</td>
						 <td> R$ '.$sub.'</td>
						 <td><a href="?acao=del&codproduto='.$codproduto.'">Remove</a></td>
					  </tr>';
				}//FECHA FOREACH
				   $total = number_format($total, 2, ',', '.');
				   echo '<tr>
							<td colspan="3">Total</td>
							<td> R$ '.$total.'</td>
					  </tr>';
			 }//FECHA ELSE
		   ?>
		
		 </tbody>
			</form>
	</table>
 
 <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
  <a href="lancamento.php">Finalizar compra</a>
 <!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
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
 
</center> 
</body>
</html>