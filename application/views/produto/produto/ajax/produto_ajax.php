<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage cadastro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";
require_once "../class/ProdutoDAO.php";
$ProdutoDAO = new ProdutoDAO();
//    
$ret = $ProdutoDAO->getValues();
//
if($ret!='OK'){
  echo($ret);
}else{
  if($ProdutoDAO->flag==0){
    echo($ProdutoDAO->insertReg());
  }else{
    echo($ProdutoDAO->updtReg());
  }
}  
