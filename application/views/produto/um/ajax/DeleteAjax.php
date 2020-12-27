<?php
  $nivel = "../../../../../";       
  require_once($nivel . "application/views/produto/um/class/DeleteClass.php");  
  //  
  $class = new DeleteClass($nivel);
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