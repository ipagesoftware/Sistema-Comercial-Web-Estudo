<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage grupo
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class GrupoAddUpdt
{
    private $id;
    private $pdo;
    private $security;
    private $tabela = 'grupo';    
    public  $grupo_descricao;
    public  $grupo_status=1;
    public  $grupo_id=0;
    public  $permission = [];

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
          // Passa os valores decompostos para as respectivas vari�veis
          // S� esta aqui me interessa ----+
          // as demais s�o fict�cias       |
          //                               v
          list($doomy1, $doomy2, $doomy3, $id) = explode('=',$tmp);
          $this->grupo_id = (int)$this->security->decodeGET($id);
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
          return 'Erro ao iniciar a conex�o';
      }
      //
      $sql  = "SELECT * FROM `grupo` WHERE `grupo_id`=" . $this->grupo_id;
      //
      $query = $pdo->prepare($sql);
      //  
      try{    
        $query->execute();
      }catch (PDOException $e) { 
        $module = $this->security->encondeGET("Grupo");
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
      $this->grupo_descricao = $rs['grupo_descricao'];
      $this->grupo_status = $rs['grupo_status'];
      return 'OK';
    }
}
