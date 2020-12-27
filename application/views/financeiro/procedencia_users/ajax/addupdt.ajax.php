<?php
  /**
   * @version    1.0
   * @package    Financeiro
   * @subpackage Procedência x usuário
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../../";       
  require_once($nivel .'application/views/financeiro/procedencia_users/class/addupdt.class.php');  
  $class = new IPAGE_addUpdtClass($nivel);
  //    
  $ret = $class->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    if($class->flag==0){
      echo($class->insertReg());
    }else{
      echo($class->updtReg());
    }
  }  
?>