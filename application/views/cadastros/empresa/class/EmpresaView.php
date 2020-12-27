<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Empresa
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;
use App\Utilities\Util;

class EmpresaView
{
  private $id;
  private $pdo;
  private $security;
  public  $permission = [];
  private $tabela = 'empresa';
  public  $myfields = [];
  public  $empresa_id = 0;

  /**
   * [__construct description]
   */
  function __construct()
  {
    $this->pdo = ConnClass::getInstance();
    $this->security = Security::getInstance();
    $this->sid = Session::getInstance();
    $this->sid->start();
    //
    if(!$this->sid->check()){
      die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
      exit();      
    }
    //
    $Utilities = Util::getInstance();
    $this->empresa_id = $Utilities->getValuesModal("Empresa");
    //
    if($this->empresa_id){
      $this->getReg();
    }  
  } 

  /**
   * [getReg description]
   * @return [type] [description]
   */
  public function getReg()
  {    
    if((int)$this->empresa_id==0){
      #return 'OK';
    }
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    } 
    //
    $sql  = "SELECT * FROM `empresa` WHERE `empresa_id`=" . (int)$this->empresa_id;
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    $cols = $query->columnCount();
    //
    for($i=0;$i<$cols;$i++){
      $fld = $query->getColumnMeta($i);
      if($fld['name']=='empresa_data_cadastro'){
        //
      }else{
        if(!$rs || $query->rowCount()<=0){
          if($fld['name']=='empresa_status'){            
            $tmp = '1';
          }else{
            $tmp = '';
          }
        }elseif($fld['name']=='empresa_data_cadastro'){
          $tmp = implode("/",array_reverse(explode("-", $rs['empresa_data_cadastro'])));
        }else{
          $tmp = utf8_decode($rs[$fld['name']]); 
        }
        //
        $this->myfields[$fld['name']] = array("valor"=>$tmp, "error"=>null);
      }
    }
    return 'OK';
  }   
}
