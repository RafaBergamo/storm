<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
BD: TesteBD1
Tabela: produto
*/


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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Carrinho de Compras</title>
</head>
 
<body>
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
				<td colspan="5"><a href="index.php">Continuar Comprando</a></td>
		</tfoot>
		  
		<tbody>
		   <?php
			 if(count($_SESSION['carrinho']) == 0){
				echo '<tr><td colspan="5">N&atilde;o h&aacute; produto no carrinho</td></tr>';
			 }else{
				require("conexao.php");
				$total = 0;
				foreach($_SESSION['carrinho'] as $codproduto => $qtd){
					$sql = "select * from produto where cod_produto=$codproduto	and status_produto = 'TRUE' 
							order by nome_produto";
					$res = pg_query($conecta, $sql);
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
</body>
</html>