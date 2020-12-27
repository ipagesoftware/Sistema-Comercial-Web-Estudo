<?php
/**
 * @version    1.0
 * @package    Plano contas
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../";       
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";
require_once("PlanoContasAutocomplete.php");
//  
$class = new PlanoContasAutocomplete();
//
$ret = $class->getValues();
//
if($ret!='OK'){
  echo($ret);
}else{
  echo($class->getDados());
}
