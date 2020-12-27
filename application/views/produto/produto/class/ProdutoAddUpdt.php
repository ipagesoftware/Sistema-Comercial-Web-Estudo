<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage cadastro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class ProdutoAddUpdt
{
    private $id;
    private $nivel;
    private $pdo;
    private $security;
    private $tabela = 'produto';

    public  $permission = [];
    public  $myfields = [];
    public  $produto_id = 0;

    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct($nivel)
    {    
      $this->nivel = $nivel;    
      $this->pdo = ConnClass::getInstance();
      $this->sid = Session::getInstance();
      $this->security = Security::getInstance();    
      $this->sid->start();
      //
      if(!$this->sid->check()){
        // Usuário não logado
        header('Location: ' . SESSION_EXPIRED);
        exit();      
      }
      //
      $ret = $this->getValues();
      //
      if($ret=='OK'){
        $this->getReg();
      }   
    } 

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {    
      $parameter1 = ((isset($_GET['parameter1']))?$_GET['parameter1']:null);
      $cPermission = UserPermission::getInstance();
      $this->permission = $cPermission->verificaPermissoes($this->tabela, 
                                                           $this->sid->getNode('user_id'),  
                                                           $this->security, 
                                                           $parameter1);

      if($parameter1){
        // Decodifica os dados
        $tmp = $this->security->decodificarParametro($parameter1);
        // Passa os valores decompostos para as respectivas variáveis
        // Só esta aqui me interessa ----+
        // as demais são fictícias       |
        //                               v
        list($doomy1, $doomy2, $doomy3, $id) = explode('=',$tmp);
        $this->produto_id = (int)$this->security->decodeGET($id);
      }
      //
      return 'OK';     
    }

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $sql  = "SELECT * FROM `produto` WHERE `produto_id`=" . (int)$this->produto_id;
      //
      $query = $pdo->prepare($sql);
      //
      try{    
        $query->execute();
      } 
      catch (PDOException $e) { 
        $module = $this->security->encondeGET("Produto");
        $r = $this->security->encondeGET($pdo->ErrorMsg());      
        header("Location: " . $this->nivel . "error.php?modulo=". $module ."&parameter=" . $r);
        die(); 
      }
      //
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      $cols = $query->columnCount();
      for($i=0;$i<$cols;$i++){
        $fld = $query->getColumnMeta($i);
        if($fld['name']=='produto_data_cadastro'){
          //
        }else{
          //
          if(!$rs || $query->rowCount()<=0){
            if($fld['name']=='produto_status'){
              $tmp = '1';
            }elseif($fld['name']=='produto_um'){
              $tmp='UN';
            }elseif($fld['name']=='produto_um_quant'){
              $tmp='1.00';
            }elseif($fld['native_type']=='FLOAT'){
              $tmp='0.00';
            }else{
              $tmp = '';
            }
          }else{
            $tmp = utf8_decode($rs[$fld['name']]); 
          }
          //
          $this->myfields[$fld['name']] = $tmp;
        }
      }
      return 'OK';
    }  
}
