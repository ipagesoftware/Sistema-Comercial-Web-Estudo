<?php
/**
 * @version    1.0
 * @package    Código interno
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";     
require_once("CodigoInternoAutocomplete.php");  
//  
$class = new CodigoInternoAutocomplete();
//
$ret = $class->getValues();
//
if($ret!='OK'){
  echo($ret);
}else{
  echo($class->getDados());
}