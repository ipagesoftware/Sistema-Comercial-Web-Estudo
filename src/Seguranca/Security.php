<?php
/**
 * @version    1.0
 * @package    Seguranca
 * @subpackage Security
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
namespace App\Seguranca;
/**
  EXEMPLO DE USO:
  $enc = enc("123");
  //Revertendo o processo da criptografia
  $dec = dec($enc);
  //Saída HTML
  echo "<p>Criptografia: $enc</p>
        <p>Reversa: $dec</p>";  
**/
class Security{
  private static $instance;
  /**
  * @param string
  * @return string
  */  
  function console_log($_value)
  {
    $r = '<script>console.log("' . $_value .'")</script>';
    echo($r);
  }

  /**
   * [decodificarParametro description]
   * @param  [type] $parameter [description]
   * @return [type]            [description]
   */
  public function decodificarParametro($parameter){
    //DECODIFICA OS DADOS  
    $ret = $this->decodeGET($parameter);
    //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
    $ret = explode('&', $this->decodeGET($parameter));
    //
    //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
    $tmp = "";
    foreach($ret as $key => $value){
      $v = explode('=', $value);
      $tmp .= htmlspecialchars($v[1]) .'=';
      /**     ------------------------
                     ^
                     |
                     +--- EVITA MYSQL INJECTION
      */
    }
    return $tmp;
  }

  /********************************************/
  /* FUNÇÕES UTILIZADA PARA EMBARALHAR A URL * /
  /********************************************/
  /*
    * FUNÇÃO PARA CODIFICAR UMA STRING EM HEXADECIMAL
  */
  public function encodeHex($string)
  {
      $hex='';
      for ($i=0; $i < strlen($string); $i++)
      {
          $hex .= dechex(ord($string[$i]));
      }
      return $hex;
  }
  /*
    * FUNÇÃO PARA DECODIFICAR UMA HEXADECIMAL EM STRING
  */
  public function decodeHex($hex)
  {
      $string='';
      for ($i=0; $i < strlen($hex)-1; $i+=2)
      {
          $string .= chr(hexdec($hex[$i].$hex[$i+1]));
      }
      return $string;
  }
  /**
    *********************************************************************
  **/  
  public function encondeGET($value)
  {
    $ret = base64_encode($value);
    $value = $this->encodeHex($ret);
    return $value;    
  } 

  /**
    *********************************************************************
  **/  
  public function decodeGET($value)
  {
    $ret = $this->decodeHex($value);    
    $value = base64_decode($ret);
    return $value;    
  } 
  /**
    *********************************************************************
  **/  
  public function decodeReverseGET($value)
  {
    $ret = base64_decode($value);    
    $value = $this->decodeHex($ret);
    return $value;    
  }       
  /**
    *********************************************************************
  **/
    /**
    $parameters = array();
    for($i=0;$i<=4;$i++){
      srand((float)microtime()*1000000);
      $parameters["par$i"]=rand(1,10000);
    }
    
    $parameters["par5"]=$id;
    $tmp = $this->security->encodeTmpUrl($parameters);
    echo($tmp . '<br/>');
    
    $tmp2 = $this->security->decodeTmpUrl($tmp);
    echo($tmp2['par4']);
    */  
  public function encodeTmpUrl($parameters)
  {
    /**
     * GERO PARÂMETROS ALEATÓRIOS
     * E TROCO SEMPRE A POSIÇÃO DO TID NA URL
    */
    //$numbers = range(0,4);
    $palavra = rand(5, 15);
    //srand((float)microtime()*1000000);
    //shuffle($numbers);
    $i=0;
    $tmp = '';
    //
    foreach ($parameters as $number) {
        if($i == 0){
          $tmp .= '?';
        }else{
          $tmp .= "&amp;";
        }
        
       // echo($parameters["par$i"].'<br/>');
          //$tmp .= 'par=' . $this->encondeGET($tid);
        $tmp .= "par$i=" .  $this->encondeGET($parameters["par$i"]);
        $i++;
    }      
    
    return "$tmp";      
  }
  /**
   ****************************************************************************
  */
  public function parameterGenerator($num_par = 4)
  {
      $parameters = array();
      for($i=0;$i<=$num_par;$i++){
        srand((float)microtime()*1000000);
        $parameters["par$i"] = rand(1,10000);
      }
      return $parameters;     
  }  
  /**
    *********************************************************************
  **/
  public function decodeTmpUrl($tid){

    /**
     * GERO PARÂMETROS ALEATÓRIOS
     * E TROCO SEMPRE A POSIÇÃO DO TID NA URL
    */
    $pars = explode("&", $tid);
    $i=0;
    $tmp = '';
    $tmp2 = '';
    $val = array();
    //
    foreach ($pars as $par) {
        $values = explode("=", $par);
        $i=0;
        $tmp = '';
        foreach ($values as $value) {
          if($i % 2){
            $val[$tmp] = $this->decodeGET($value);
          }else{
            if($value == substr($value, 0,4) || substr($value, 0,1) =='?'){
              $tmp2 = str_replace("amp;", '', $value);
              $tmp2 = str_replace("?", '', $tmp2);
            }
            //
            $tmp = str_replace("amp;", '', $value);
            $tmp = str_replace("?", '', $tmp);            
          }
          //
          $i++;
        }
    }
    //          
    return $val;
  }
  /**
    *********************************************************************
  **/
  public function curPageURL()
  {
   $pageURL = 'http';
   //
   foreach($_SERVER as $value=>$key){
    echo($value . '=>' . $key . '<br/>');
   }
   if ($_SERVER["https"] == "on"){
    $pageURL .= "s";
   }
   //
   $pageURL .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   }
   return $pageURL;
  }
  /**
    *********************************************************************
  **/
  public function curPageName()
  {
   return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
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