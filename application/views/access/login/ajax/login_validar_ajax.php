<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Login
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
$nivel = '../../../../../';
require_once "{$nivel}config.php";
require_once '../class/LoginValidar.php';
//
$validar = new LoginValidar();
$ret = $validar->getValues();
//
if ($ret != 'OK') {
    die($ret);
}
die($validar->logar());
