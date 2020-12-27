<?php
/**
 *
 * @version    1.0
 * @package    views
 * @subpackage includes/captcha
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2019 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
  @session_start();
  $altura = 55;//$_GET["a"]; // recebe a altura
  $quantidade_letras = 5;//$_GET["ql"]; // recebe a quantidade de letras que o captcha terá
  $codigoCaptcha = substr(str_shuffle("AaBbCcDdEeFfGgHhiJjKkLMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),0,($quantidade_letras));
  $_SESSION["ckey"] = strtoupper($codigoCaptcha); // atribui para a sessao a palavra gerada
  $imagemCaptcha = imagecreatefrompng("fundocaptch.png");
  $fonteCaptcha = imageloadfont("anonymous.gdf");
  $background = array('66;137;245', '51;161;70', '132;64;163', '211;59;48');
  $idx = (int)rand(0,3);
  $rgb = explode(';', $background[$idx]);
  $corCaptcha = imagecolorallocate($imagemCaptcha,$rgb[0], $rgb[1], $rgb[2]);
  imagestring($imagemCaptcha,$fonteCaptcha,$altura,5,$codigoCaptcha,$corCaptcha);
  header("Content-type: image/png");
  imagepng($imagemCaptcha);
  imagedestroy($imagemCaptcha);
