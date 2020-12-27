<?php

/**
 * @author IPAGE
 * @copyright 2020
 */
$nivel = '../../../../';
require_once("IPAGE_estoqueClass.php");
$class = new EstoqueClass($nivel);

$produto_id = 333;
echo('Entrada Estoque => ' . $class->getEntradaEstoque($produto_id) .'<br />');
echo('Estoque Atual => ' . $class->getEstoqueAtual($produto_id) .'<br />');
echo('Estoque Critico => ' . $class->getEstoqueCritico($produto_id) .'<br />');
echo('Saída Estoque => ' . $class->getSaidaEstoque($produto_id) .'<br />');
//
#echo($class->produtoExiste($produto_id));
#echo($class->setEntradaEstoque($produto_id,(int)rand(1,100)).'<br />');
#echo($class->setSaidaEstoque($produto_id,(int)rand(1,10)).'<br />');
#echo($class->setEstornoEstoque($produto_id,(int)rand(1,10)).'<br />');
echo($class->setPerdaEstoque($produto_id,(int)rand(1,10),(int)rand(1,1000),'TESTE').'<br />');
echo($class->setTrocaEstoque( $produto_id, 3,(int)rand(1,10),(int)rand(1,1000),'Troca produto ' . $produto_id . ' pelo produto 3').'<br />');
#echo($class->setTrocaEstoque( 3, $produto_id,(int)rand(1,10),(int)rand(1,1000),'Troca produto 3 pelo produto ' . $produto_id).'<br />');
?>