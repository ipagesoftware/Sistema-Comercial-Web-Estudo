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

class ProcedenciaAddUpdt{
    private $id;
    private $pdo;
    private $security;
    private $tabela = "procedencia";
    //
    public  $procedencia_id=0;
    public  $permission = [];
    public  $myfields = [];

    /**
     * [__construct description]
     */
    public function __construct()
    {    
      $this->pdo = ConnClass::getInstance();
      $this->sid = Session::getInstance();
      $this->security = Security::getInstance();
      $this->sid->start();
      //
      if(!$this->sid->check()){
        // Usuário não logado
        header('Location: ' . SESSION_EXPIRED);
        exit();      
      }elseif ((int)$this->sid->getNode('procedencia_id')==0 OR !FINANCAS){
        header('Location: ' . URL . 'sel_procedencia/');
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
        $this->procedencia_id = (int)$this->security->decodeGET($id);
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
      for($i=0;$i<$cols;$i++)
      {
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
          $this->myfields[$fld['name']] = array("valor"=>$tmp, "error"=>null);
        }
      }
      return 'OK';
    }
}