<?php
   session_start();
if(!isset($_SESSION['carrinho'])){
         $_SESSION['carrinho'] = array();
      }

include "conexao.php";

echo "<pre>";
   print_r($_SESSION['carrinho']);
echo "</pre>";

foreach ($_SESSION['carrinho'] as $key => $value) :
  // $query = implode(',', $value);
    //echo "INSERT INTO teste (nome, dinheiro) VALUES ('{$query}')";
echo "$_SESSION['carrinho'][$codproduto]";
endforeach;

?>