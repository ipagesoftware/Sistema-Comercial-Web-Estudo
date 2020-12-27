<?php
/**
 *
 * @version    1.0
 * @package    views
 * @subpackage Exclusão de registro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2019 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/

  $nivel = "../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once("../class/DeleteClass.php");  
  //  
  $DeleteClass = new DeleteClass($nivel);
  //
  $ret = $DeleteClass->getValues();
  //
  if($ret!='OK'){
    echo($ret);
  }else{
    echo($DeleteClass->execute());
  }

