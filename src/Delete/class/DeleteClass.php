<?php
/**
 *
 * @version    1.0
 * @package    views
 * @subpackage Exclusão de registro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2019 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class DeleteClass{
  private $id;
  private $tabela;
  /**
   *************************************************************************
  */
  function __construct()
  {    
    $sid = Session::getInstance();
    //
    $sid->start();
    //
    if(!$sid->check())
    {      
      $ret = '<p style="text-align: justify;">Sua sessão expirou, será necessário logar-se no sistema novamente!</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }
    //
    $cPermission = new UserPermission();
    $permission = json_decode($cPermission->showPermission($sid->getNode('user_id'), "empresa"), true);
    //
    if($permission['negar']!=1){
      $ret  = '<p style="text-align: justify;">Usuário sem permissão para acessar a página do módulo: <strong>EMPRESA</strong>.</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }elseif($permission['excluir']!=1){
      $ret  = '<p style="text-align: justify;">Usuário sem permissão para excluir registro no módulo: <strong>EMPRESA</strong>.</p>';      
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }    
  }
    
  /**
   * [getValues description]
   * @return [type] [description]
   */
  public function getValues()
  {
    
    if(!isset($_POST['id'])){
      exit(UNEXPECTED_ERROR);
    }
    if(!isset($_POST['tabela'])){
      exit(UNEXPECTED_ERROR);
    }    
    $this->id = $_POST['id'];
    $this->tabela = $_POST['tabela'];
    //INICIO AS VALIDAÇÕES
    if(strlen($this->id)==0){
      $ret  = '<p style="text-align: justify;">Parâmetro passado a consulta é nulo ou vazio, verifique!</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;
      return $ret;
    }    
    //VERIFICA SE O ID É VÁLIDO
    if(intval($this->id)==0){
      $ret  = '<p style="text-align: justify;">Parâmetro passado a consulta é inválido, verifique!</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;           
      return $ret;
    }
    //
    return 'OK';     
  }

  /**
   * [execute description]
   * @return [type] [description]
   */
  public function execute(){    
    $conn = ConnClass::getInstance();
    $pdo = $conn->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }    
    //
    $sql  = "DELETE ";
    $sql .= "FROM ";
    $sql .= $this->tabela;
    $sql .= " WHERE ";
    $sql .= $this->tabela . "_id = " . (int)$this->id . ";";
    //
    try{    
      $result = $pdo->query($sql);
    } 
    catch (PDOException $e) { 
      $ret  = '<p style="text-align: justify;">'. $e->getMessage() .'</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;      
      return $ret;
    }        
    //
    if(!$result){
      return "ERROR_DELETE";
    } 
    return 'OK';    
  }  
}
