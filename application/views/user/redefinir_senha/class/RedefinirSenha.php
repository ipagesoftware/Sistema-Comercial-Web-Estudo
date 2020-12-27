<?php
/**
 * @version    1.0
 * @package    usuário
 * @subpackage redefinir a senha
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

class RedefinirSenha
{
    private $security;
    private $pdo;
    //
    public $user_senha_atual ='';
    public $user_nova_senha ='';
    public $user_confirmar_senha ='';
    public $user_id=0;
    public $sid;  

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
        header('Location: ' . SESSION_EXPIRED);
      }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {    
      //CAPTAÇÃO DADOS      
      if($_SERVER['REQUEST_METHOD']=='POST'){
        $parameter   = $_POST['parameter1'];
      }elseif($_SERVER['REQUEST_METHOD']=='GET'){
        $parameter   = $_GET['parameter1'];
      }          
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
      list($this->user_senha_atual,
           $this->user_nova_senha,
           $this->user_confirmar_senha,
           $this->user_id) = explode('=',$tmp);

      //INICIO AS VALIDAÇÕES
      //VERIFICA SE A NOVA SENHA É IGUAL A CONFIRMAÇÃO DA NOVA SENHA    
      if(strtoupper($this->user_nova_senha) !=  strtoupper($this->user_confirmar_senha)){
        return('NO_MACTH_NEW_PASSWORD');
      }    
      //VERIFICA SE A NOVA SENHA É IGUAL A SENHA ATUAL
      if(strtoupper($this->user_senha_atual) ==  strtoupper($this->user_nova_senha)){
        return 'EQUAL_PASSWORDS';
      }    
      //
      return 'OK';
    }

    /**
     * [verificaSenha description]
     * @return [type] [description]
     */
    public function verificaSenha()
    {
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }    
      //
      $sql  = "SELECT user_id FROM user WHERE `user_password` = '"  . encrypt($this->user_senha_atual) . "' AND `user_id`=" . $this->user_id;
      //    
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      if(!$rs OR $query->rowCount()<=0){
        return 'NO_MATCH';
      }
      //
      //TUDO OK
      $sql  = "UPDATE user SET ";
      $sql .= "`user_password`='" . encrypt($this->user_nova_senha) . "' ";
      $sql .= " WHERE `user_id`=" . (int)$this->user_id;
      //
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
        return $e->getMessage(); 
      }
      //
      if(!$result){
        return "ERROR_UPDATE";
      }    
      return 'OK';
    }   

    /**
     * [createLinkMenu description]
     * @return [type] [description]
     */
    public function createLinkMenu()
    {
      $t  ='<div class="row">';
      $t .='    <div class="col-lg-12">';
      $t .='        <h1 class="page-header">';
      $t .='          Redefinir Senha <small> - ' . $this->sid->getNode('procedencia_empresa') . '</small>';
      $t .='        </h1>';
      $t .='        <ol class="breadcrumb">';
      $t .='          <li>';
      $t .='              <i class="fa fa-home"></i> <a href="' . URL . '">Home</a>';
      $t .='          </li>';
      //
      $t .='          <li class="active">';
      $t .='              <i class="fa fa-refresh"></i> <a href="application/views/user/redefinir_senha_/">Atualizar</a>';
      $t .='          </li>';    
      //
      $t .='          <li class="active">';
      $t .='              <i class="fa fa-user"></i> <a href="application/views/user/perfil/">Perfil</a>';
      $t .='          </li>';
      //    
      if($this->sid->getNode('user_nivel')=='A'){
        $t .='          <li>';
        $t .='              <i class="fa fa-plus"></i> <a href="usuarios/">Cadastro Usuário</a>';
        $t .='          </li>';
      }
      //
      $t .='        </ol>';
      $t .='    </div>';
      $t .='</div>';
      return $t;
    }
}