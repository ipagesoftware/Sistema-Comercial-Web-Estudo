<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class PermissoesIndex
{
    private $id;
    private $nivel;
    private $pdo;
    private $security;
    private $permission = [];
    
    public  $user_login ='';
    public  $user_password ='';
    public  $user_nivel='A';
    public  $user_email='';
    public  $user_status=1;
    public  $user_id=0;

    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct($nivel)
    { 
      $this->nivel = $nivel;
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
      $cPermission = new UserPermission(); 
      $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), '_user_permissions'), true);
    }  
    
    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
      if(empty($_GET['parameter1'])){
        return "OK";
      }
      $parameter   = $_GET['parameter1'];
      //DECODIFICA OS DADOS  
      $ret = $this->security->decodeGET($parameter);
      //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
      $ret = explode('&', $this->security->decodeGET($parameter));
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
      //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
      list($doomy1, $doomy2, $doomy3, $id) = explode('=',$tmp);
      //DECODIFICO DADOS
      
      $id = $this->security->decodeGET($id);
      //INICIO AS VALIDAÇÕES
      if(strlen($id)==0){
        return "EMPTY_REGISTER";
      }
      //VERIFICA SE O ID É VÁLIDO
      if(intval($id)<=0){
        return 'INVALID_ID';
      }
      //PASSO PARA A VARIPAVEL GLOBAL
      $this->user_id = $id;
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
      $sql  = "SELECT * FROM user WHERE `user_id`=" . $this->user_id;    
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);    
      //
      if($query->rowCount()<=0){
        return "ERROR_SELECT";
      }
      //
      $this->user_login = $rs['user_login'];
      $this->user_password = '';
      $this->nivel = $rs['user_nivel'];
      $this->user_email = strtolower($rs['user_email']);
      $this->user_status = $rs['user_status'];
      return 'OK';
    }
}