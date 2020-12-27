<?php
  /**
   * @version    1.0
   * @package    produto
   * @subpackage fabricante
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */

  $nivel = "../../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once('../class/fabricanteDAO.php');  
  $FabricanteDAO = new FabricanteDAO($nivel);
  //    
  $ret = $FabricanteDAO->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    if($FabricanteDAO->flag==0){
      echo($FabricanteDAO->insertReg());
    }else{
      echo($FabricanteDAO->updtReg());
    }
  }  