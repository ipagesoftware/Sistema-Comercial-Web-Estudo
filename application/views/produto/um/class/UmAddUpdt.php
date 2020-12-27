<?php
/**
 * @version    1.0
 * @package    Produto
 * @subpackage Unidade de medida
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class UmAddUpdt
{
    private $id;
    private $pdo;
    private $security;
    private $tabela = 'um';
    public  $um_sigla="";
    public  $um_descricao="";
    public  $um_status=1;
    public  $um_id=0;
    public  $permission = [];

    /**
     * [__construct description]
     */
    public function __construct()
    {    
      $this->pdo = ConnClass::getInstance();
      $this->security = Security::getInstance();
      $this->sid = Session::getInstance();
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
        $this->um_id = (int)$this->security->decodeGET($id);
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
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $sql  = "SELECT * FROM `um` WHERE `um_id`=" . $this->um_id;
      //
      $query = $pdo->prepare($sql);
      //  
      try{    
        $query->execute();
      }catch (PDOException $e) { 
        $module = $this->security->encondeGET("UM");
        $r = $this->security->encondeGET($e->getMessage());      
        header("Location: " . URL . "error.php?modulo=". $module ."&parameter=" . $r);
        die();
         
      }        
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      if(!$rs || $query->rowCount()<=0){
        return 'ERROR_SELECT';
      }
      //
      $this->um_sigla = $rs['um_sigla'];
      $this->um_descricao = $rs['um_descricao'];
      $this->um_status = $rs['um_status'];
      return 'OK';
    }
}