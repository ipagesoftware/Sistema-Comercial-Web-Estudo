<?php
  /**
   * @version    1.0
   * @package    Cadastros
   * @subpackage Vendedor x Cliente
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once('../class/VendedorClienteDAO.php');  
  $class = new VendedorClienteDAO();
  //    
  $ret = $class->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    echo($class->insertReg());
  }