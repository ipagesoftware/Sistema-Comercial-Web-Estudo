<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage cadastro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";

$dados = array();
$error = null;
//
if($_POST){
  if(isset($_POST['cod_barras'])){
    if(!empty($_POST['cod_barras'])){
      $url = "https://www.ipage.com.br/ws/v1/codebar/";
      $url .= $_POST['cod_barras'] . "/";
      $url .= API_PRODUTOS;// Chave teste da api
      //
      $response = file_get_contents($url);
      //$dados = (array)json_decode($response);
      echo $response;
    }else{
      $dados = array('error'=>true, 'msg'=>'Ipage Webservice: Invalid Codebar. Please contact technical support through our web site: www.ipage.com.br');
      //
      echo(json_encode($dados));
    }
  }
  //

}