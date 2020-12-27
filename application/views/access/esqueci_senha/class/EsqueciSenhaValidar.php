<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Esqueci a Senha
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
setlocale(LC_TIME, 'portuguese');
//date_default_timezone_set('America/Recife');
date_default_timezone_set("Brazil/East");
//
if (!isset($_SESSION)) {
    session_start();
}

class EsqueciSenhaValidar
{
    public $email;
    public $newpwd;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->newpwd = substr(str_shuffle("AaBbCcDdEeFfGgHhiJjKkLMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"), 0, (8));
    }

    /**
     * Captação dos dados vindos do form
     * @return string
     */
    public function getValues()
    {     
        $email   = $_POST['email'];
        $captcha = $_POST['captcha'];
        // Decodifica dados
        $email   = $this->decodeGET($email);
        //
        // Inicia as validações
        // Verifica se o email é válido
        // Remove os caracteres ilegais do email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        //
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $json = array('id' => 'txtemail',
                'msg'=> utf8_encode('O email possui caracteres inválidos ou foi digitado incorretamente, verifique!'),
            );
            return (json_encode($json));
        }
        //
        $this->email = $email;
        // Verifica se o captcha é válido
        $captcha = $_POST['captcha'];
        $captcha = $this->decodeGET($captcha);
        $ret = $this->getStatusCaptcha($captcha);
        //
        if (is_null($ret)) {
            $json = array('id' => 'txtkey',
                'msg'=> utf8_encode('Código acesso inválido, verifique!'),
            );
            return (json_encode($json));
        }        
        return 'OK';
    }

    /**
     * [getStatusCaptcha description]
     * @param  [type] $_captcha [description]
     * @return [type]           [description]
     */
    private function getStatusCaptcha($_captcha)
    {
        if (!$_captcha)return null;
        //
        $ret = strcasecmp($_captcha, $this->getCaptcha());
        //
        if ($ret!=0) {
            return null;
        } else {
            return 1;
        }
    }

    /**
     * Retorna o captcha gerado pelo sistema
     *
     * @return string
     */
    private function getCaptcha()
    {
        if (!isset($_SESSION["ckey"])) {
            $_SESSION["ckey"] = 'undefined';
        }
        //
        return $_SESSION["ckey"];
    }

    /**
     * Decodifica uma string em hexadecimal
     * @param  string hexadecimal
     * @return string decodificada
     */
    private function decodeHex($hex)
    {
        $string = '';
        //
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        //
        return $string;
    }

    /**
     * Decodifica uma url get codificada
     * @param  string url codificada
     * @return String decodificada
     */
    private function decodeGET($value)
    {
        $ret   = $this->decodeHex($value);
        $value = fulltrim(base64_decode($ret));
        return $value;
    }
}
