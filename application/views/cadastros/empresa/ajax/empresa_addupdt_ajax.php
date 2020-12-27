<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Empresa
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";
require_once "../class/EmpresaDAO.php";
$EmpresaDAO = new EmpresaDAO();
//    
$ret = $EmpresaDAO->getValues();
//
if($ret!='OK'){
  echo($ret);
}else{
  if($EmpresaDAO->flag==0){
    echo($EmpresaDAO->insertReg());
  }else{
    echo($EmpresaDAO->updtReg());
  }
}  
