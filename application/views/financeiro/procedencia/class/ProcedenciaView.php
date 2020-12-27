<?php
/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Procedência
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;
use App\Utilities\Util;

class ProcedenciaView{
  private $procedencia_id;
  private $pdo;
  private $security;
  public  $permission = [];
  private $tabela = 'procedencia';
  public  $myfields = [];
  public  $disabled;
  /**
   *************************************************************************
  */
  function __construct(){    
    $this->pdo = ConnClass::getInstance();
    $this->security = Security::getInstance();
    $this->sid = Session::getInstance();
    $this->sid->start();
    //
    if(!$this->sid->check())
    {
      die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
      exit();      
    }
    //
    $cPermission = new UserPermission();    
    $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);

    $Utilities = Util::getInstance();
    $this->procedencia_id = $Utilities->getValuesModal("Procedência");
    //
    if($this->procedencia_id){
      $this->getReg();
    }
  } 

  /**
    ***********************************************************************
  */  
  public function getReg(){    
    if((int)$this->procedencia_id==0){
      #return 'OK';
    }
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    } 
    //
    $sql  = "SELECT * FROM `procedencia` WHERE `procedencia_id`=" . (int)$this->procedencia_id;
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    $cols = $query->columnCount();
    //
    for($i=0;$i<$cols;$i++){
      $fld = $query->getColumnMeta($i);
      if($fld['name']=='procedencia_data_cadastro'){
        //
      }else{
        //
        if(!$rs || $query->rowCount()<=0){
          if($fld['name']=='procedencia_status'){            
            $tmp = '1';
          }else{
            $tmp = '';
          }
        }elseif($fld['name']=='procedencia_data_cadastro'){
          $tmp = implode("/",array_reverse(explode("-", $rs['procedencia_data_cadastro'])));
        }else{
          $tmp = utf8_decode($rs[$fld['name']]); 
        }
        //
        $this->myfields[$fld['name']] = $tmp;
      }
      //
      if ($this->sid->getNode('procedencia_id') == $rs['procedencia_id']) {
          $this->disabled = " disabled";
      }
    }
    return 'OK';
  }  
}
?>