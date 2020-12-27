<?php
/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Seleção da procedência financeira
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Conexao\ConnClass;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;

class SelProcedencia{
    private $pdo;
    private $security;
    private $tabela = 'procedencia';
    private $procedencia_id;
    private $procedencia_empresa;
    //
    public  $permission;
    public  $sid;
    
    /**
     * [__construct description]
     */
    function __construct()
    {
      $this->pdo = ConnClass::getInstance();
      $this->security = new Security();
      $this->sid = Session::getInstance();
      $this->sid->start();
      //
      if(!$this->sid->check()){
        header('Location: ' . SESSION_EXPIRED);
        exit();      
      }
      //    
      $cPermission = new UserPermission();
      $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);
      //    
      if($this->permission['negar']!=1){
        $module = $this->security->encondeGET("Procedência");
        $r = $this->security->encondeGET(rand(1000, 5000));      
        header("Location: " . URL . "3109.php?modulo=". $module ."&parameter=" . $r);
        die();
      }
      //
      if($this->sid->getNode('procedencia_count')<=1){
        $module = $this->security->encondeGET("Procedência");
        $r  = 'Ocorreu um imprevisto ao acessar a seleção da Procedência.<br />';
        $r .= '* verifique se o usuário em questão já está logado a esta procedência.<br />';
        $r .= '* verifique se o usuário está com as suas procedências definidas.<br />';
        $r .= '* verifique se o usuário em questão não foi bloqueado pelo administrador.';
        $r = $this->security->encondeGET($r);      
        header("Location: " . URL . "3109.php?modulo=". $module ."&parameter=" . $r);
        exit();
      }elseif(!FINANCAS){
        $module = $this->security->encondeGET("Procedência");
        $r  = 'O módulo finanças não está habilitado ou não foi definido para este projeto.<br />';
        $r .= '* verifique se o usuário em questão já está logado a esta procedência.<br />';
        $r .= '* verifique se o usuário está com as suas procedências definidas.<br />';
        $r .= '* verifique se o usuário em questão não foi bloqueado pelo administrador.';
        $r = $this->security->encondeGET($r);      
        header("Location: " . URL . "3109.php?modulo=". $module ."&parameter=" . $r);
        exit();
      } 
    }

    /**
     * [logar description]
     * @return [type] [description]
     */
    public function logar()
    {
      $this->sid->setNode('procedencia_id', $this->procedencia_id);
      $this->sid->setNode('procedencia_empresa', $this->procedencia_empresa);
      return 'OK';
    }

    /**
     * [loadProcedenciaIntoComboBox description]
     * @return [type] [description]
     */
    public function loadProcedenciaIntoComboBox()
    {
      if(intval($this->sid->getNode('procedencia_id'))==0){
        $p = "";
        $u = 0;      
      }
      //
      $t = '<option value="0" selected="">*** NENHUM ***</option>';
      $p = $this->sid->getNode('procedencia_empresa');
      $u = $this->sid->getNode('user_id');
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      /**
       * DEFINE A CONSULTA
      */
      $sql  = "SELECT procedencia.procedencia_empresa, procedencia.procedencia_id ";
      $sql .= "FROM procedencia_users INNER JOIN procedencia ";
      $sql .= "ON procedencia_users.procedencia_id = procedencia.procedencia_id ";
      $sql .= "WHERE (((procedencia.procedencia_empresa)<>'') ";
      $sql .= "AND ((procedencia.procedencia_status)<>0) ";
      $sql .= "AND ((procedencia_users.negar)=1) ";
      $sql .= "AND ((procedencia_users.user_id)=$u) ";
      $sql .= "AND ((procedencia.procedencia_id)<>" . intval($this->sid->getNode('procedencia_id'),10) . ")) ";
      $sql .= "ORDER BY procedencia.procedencia_empresa;";    
      //
      $query = $pdo->prepare($sql);    
      //
      try{    
        $query->execute();
      }catch (PDOException $e) { 
        return ""; 
      } 
      //    
      while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
        $t .='<option value="' . $rs[1] . '">' . $rs[0] . '</option>';
      }        
      //
      return $t; //CONDIÇÃO QUE INDICA ERRO    
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {  
      $tmp = "";
      $v = [];
      $ret = [];
      //CAPTAÇÃO DADOS
      $parameter   = $_POST['parameter1'];
      //      
      //DECODIFICA OS DADOS  
      $ret = explode('&', htmlspecialchars($this->security->decodeGET($parameter)));
      //
      //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
      foreach($ret as $key => $value){
        $v = explode('=', $value);
        if(isset($v[1])){
          $tmp .= htmlspecialchars($v[1]) .'=';
        }
        /**     ------------------------
                       ^
                       |
                       +--- EVITA MYSQL INJECTION
        */
      }
      //
      list($dummy1, $dummy2, $dymmy3, $dymmy4, $dummy5, $this->procedencia_id, $this->procedencia_empresa) = explode('=',$tmp);
      //
      $this->flag = intval($this->procedencia_id);
      //
      if(strlen($this->procedencia_empresa)==0){
        return 'INVALID_NAME';
      }
      //    
      if(intval($this->procedencia_id,10)==0){
        return 'INVALID_ID';
      }

      return 'OK';     
    }
}