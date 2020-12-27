<?php
  $nivel = "../../../../../";       
  require_once($nivel . "application/views/financeiro/procedencia_users/class/delete.class.php");  
  //  
  $class = new IPAGE_Delete($nivel);
  //
  $ret = $class->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    echo($class->delReg());
  }
  //
?>