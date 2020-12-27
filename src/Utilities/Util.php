<?php
/**
 * @version    1.0
 * @package    Utilities
 * @subpackage Util
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
namespace App\Utilities;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

/**
  EXEMPLO DE USO:
  $enc = enc("123");
  //Revertendo o processo da criptografia
  $dec = dec($enc);
  //Saída HTML
  echo "<p>Criptografia: $enc</p>
        <p>Reversa: $dec</p>";  
**/
class Util{
    private static $instance;

    /**
     * [createEmptyTable description]
     * @param  [type] $criterio [description]
     * @return [type]           [description]
     */
    public function createEmptyTable($criterio){
      $t  ='<table class="table table-bordered table-hover table-striped">';
      $t .= '<thead>';
      $t .= '  <tr>';
      $t .= '      <th>Resultado Consulta</th>';
      $t .= '  </tr>';
      $t .= '</thead>';
      $t .= '<tbody>';            
      $t .= '  <tr class="active">';
      $t .= '      <td>O critério: <strong>' . $criterio . '</strong>, não foi econtrado, tente outro valor!</td>';
      $t .= '  </tr>';
      $t .= '</tbody>';
      $t .= '</table>';    
      return $t;
    }
    /**
     * [decodificaCriterio description]
     * @return [type] [description]
     */
    public function decodificaCriterio()
    {
      $tmp = "";
      $security = Security::getInstance();

      if(isset($_GET['parameter1'])){
        $parameter1 = $_GET['parameter1'];
      }else{
        $parameter1 = '%';
      }
      //    
      if($parameter1 !='%'){
        //DECODIFICA OS DADOS
        //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
        $parameter = $parameter1;      
        $ret = explode('&', $security->decodeGET($parameter));
        //
        //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
        foreach($ret as $key => $value){
          $v = explode('=', $value);
          $tmp .= htmlspecialchars($v[1]) .'=';
          /**     ------------------------
                         ^
                         |
                         +--- EVITA MYSQL INJECTION
          */                           
        }

        //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
        list($dummy1, $dummy2, $dummy3, 
             $dummy4, $dummy5, $criterio) = explode('=',$tmp);
        //
        return $criterio;
      }else{
        return $parameter1;
      }
    }

    /**
     * [getSort description]
     * @return [type] [description]
     */
    public function getSort(&$order_sort, &$field_sort)
    {
      if(!isset($_GET['sort'])){
        return;
      }
      //
      $security = Security::getInstance();
      $criterio = $_GET['sort'];
      //DECODIFICA OS DADOS
      //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
      $parameter = $criterio; 
      $ret = explode('&', $security->decodeGET($parameter));
      $tmp = '';
      //
      //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
      foreach($ret as $key => $value){
        $v = explode('=', $value);      
        $tmp .= htmlspecialchars($security->decodeGET($v[1])) .'=';
        /**     ------------------------
                       ^
                       |
                       +--- EVITA MYSQL INJECTION
        */
      }    
      //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
      list($dummy1, $dummy2, $dummy3, 
           $dummy4, $dummy5, $order_sort, $field_sort) = explode('=',$tmp);
    }

    /**
     * [setStatus description]
     * @param [type] $tabela   [description]
     * @param [type] $criterio [description]
     */
    public function setStatus($tabela, $criterio){
      $conn = ConnClass::getInstance();
      $criterio = $_GET['atvdtv'];
      $security = Security::getInstance();
      //DECODIFICA OS DADOS
      //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
      $parameter = $criterio; 
      $ret = explode('&', $security->decodeGET($parameter));
      $tmp = '';
      //
      //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
      foreach($ret as $key => $value){
        $v = explode('=', $value);      
        $tmp .= htmlspecialchars($security->decodeGET($v[1])) .'=';
        /**     ------------------------
                       ^
                       |
                       +--- EVITA MYSQL INJECTION
        */
      }    
      //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
      list($dummy1, $dummy2, $dummy3, 
           $dummy4, $dummy5, $status, $id) = explode('=',$tmp);
      //
      $pdo = $conn->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      /**
       * DEFINO A PESQUISA
      */
      $sql  = "UPDATE {$tabela} SET ";
      $sql .= "{$tabela}_status=" . (int)$status . ", ";
      $sql .= "{$tabela}_data_cadastro ='" . date("Y-m-d H:i:s") . "' ";
      $sql .= "WHERE ";
      $sql .= "{$tabela}_id=" . (int)$id;
      //
    //CONSULTA DE EXECUÇÃO  
      try{    
        $result = $pdo->query($sql);
      } 
      catch (PDOException $e) { 
        return $e->getMessage(); 
      }        
      //
      if(!$result){
        return "ERROR_UPDATE";
      }
      //
      return 'OK_UPDATE';
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValuesModal($tabela)
    {
        $r = rand(1000, 5000);
        //
        $js  = '<script>';
        $js .= 'window.parent.location.href="%";';
        $js .= '</script>';
        // O Id não foi passado

        if(!isset($_GET['parameter1'])){
          exit(str_replace('%', URL . "3109.php?modulo=". $tabela ."&parameter=" . $r, $js));
        }
        //
        $security = Security::getInstance();
        // Decodifica os dados
        $tmp = $security->decodificarParametro($_GET['parameter1']);
        // Passa os valores decompostos para as respectivas variáveis
        // Só esta aqui me interessa ----+
        // as demais são fictícias       |
        //                               v
        list($doomy1, $doomy2, $doomy3, $id) = explode('=',$tmp);
        return (int) $security->decodeGET($id);;
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