<?php
/**
 * @version    1.0
 * @package    Jsonities
 * @subpackage Json
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
namespace App\Json;

/**
  EXEMPLO DE USO:
  $enc = enc("123");
  //Revertendo o processo da criptografia
  $dec = dec($enc);
  //Saída HTML
  echo "<p>Criptografia: $enc</p>
        <p>Reversa: $dec</p>";  
**/
class Json{
    private static $instance;
    #Coverte todo o array para utf8 de forma recursiva.
    private function utf8_converter($array)
    { #Método obtido no site: http://nazcalabs.com/blog/convert-php-array-to-utf8-recursively/
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                    $item = utf8_encode($item);
            }
        });

        return $array;
    }

    public function converter($arrayJson){
        $arrayJson = $this->utf8_converter($arrayJson);
        $var = json_encode($arrayJson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        return $var;// utf8_decode($var);
    }

    /**
     * [getInstance description]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }  
}