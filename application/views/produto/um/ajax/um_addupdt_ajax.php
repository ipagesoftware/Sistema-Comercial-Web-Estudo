<?php
  /**
   * @version    1.0
   * @package    Produto
   * @subpackage Unidade de medida
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";

  require_once('../class/UmDAO.php');  
  $UmDAO = new UmDAO($nivel);
  //    
  $ret = $UmDAO->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    if($UmDAO->flag==0){
      echo($UmDAO->insertReg());
    }else{
      echo($UmDAO->updtReg());
    }
  }  
