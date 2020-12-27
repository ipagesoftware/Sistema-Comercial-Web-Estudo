<?php
/**
 * @version    1.0
 * @package    Conexão a base de dados
 * @subpackage PDO
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
namespace App\Conexao;
use \PDO;

class ConnClass extends PDO
{
    private $m_connType;
    private $error;
    private $sql;
    private $bind;
    private $errorCallbackFunction;
    private $errorMsgFormat;  
    private static $instance;
    //
    public $servidor;
    public $user;
    public $pwd;
    public $database;

    /**
     * [__construct description]
     */
    public function __construct()
    {
      /**
       * ENCONTRO O TIPO DE CONEXÃO AUTOMATICAMENTE
      */
      if(strtolower($_SERVER['HTTP_HOST'])=='localhost'){
        $this->connType(1);
      }elseif(strtolower($_SERVER['HTTP_HOST'])=='10.0.0.254'){
        $this->connType(2);
      }
      else{
        $this->connType(0);             
      }    
    }

    /**
     * [defConn description]
     * @param  [type] $type [description]
     * @return [type]       [description]
     */
    private function defConn($type)
    {
      switch($type){
        case 0:
          $this->servidor = 'nome_do_seu_servidor';
          $this->user = 'nome_usuario';
          $this->pwd = 'senha';
          $this->database = 'ipage234_scw';
          break;
        default:
          $this->servidor = 'localhost';
          $this->user = 'root';
          $this->pwd = '';
          $this->database = 'ipage234_scw';
          break;          
      }
    }

    /**
     * [isLoged description]
     * @param  [type]  $pdo [description]
     * @param  [type]  $sid [description]
     * @return boolean      [description]
     */
    public function isLoged($pdo=null, $sid)
    {
      if(is_null($pdo)){
        $pdo = $this->openDatabase();
        //
        if(!$pdo){
            return 'Erro ao iniciar a conexão';
        }
      }
      //
      $sql = "SELECT * FROM user WHERE user_id = '" . $sid->getNode('user_id') . "';";
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      if($query->rowCount() >0){
        if($rs['user_id']==0){
          return 'DISABLED_USER';
        }elseif($rs['user_status']==0){
          return 'DISABLED_USER';
        }
        /* DEFINO AS VARIÁVEIS DA SESSÃO PARA O LOGIN */
        /**/
        $sid->addNode( 'user_id', $rs['user_id'] );
        $sid->addNode( 'user_login', ucfirst($rs['user_login']));
        $sid->addNode( 'user_foto', $rs['user_foto']);
        $sid->addNode( 'user_email', strtolower($rs['user_email']));
        $sid->addNode( 'user_nivel', strtoupper($rs['user_nivel']));
        //
        return 'OK';      
      }else{
        return 'INVALID_ACCESS';
      }    
    }  

    /**
     * [dump description]
     * @return [type] [description]
     */
    public function dump()
    {
      $tmp  = "Tipo Conexão -> " . $this->connType();
      $tmp .= "</br/>Servidor -> " . $this->servidor;
      $tmp .= "</br/>Usuário -> " . $this->user;
      $tmp .= "</br/>Pwd -> " . $this->pwd;
      $tmp .= "</br/>Banco de Dados -> " . $this->database;
      return $tmp;
    }

    /**
     * [connType description]
     * @param  integer $value [description]
     * @return [type]         [description]
     */
    public function connType($value=0)
    {
      if($value){
        $this->m_connType = $value;
        $this->defConn($value);  
      }else{
        if (!isset($this->m_connType)){
          $this->m_connType=0;
          $this->defConn($value);
        }
        return $this->m_connType;
      }
    }  

    /**
     * [lastNumber description]
     * @param  [type] $tablename [description]
     * @return [type]            [description]
     */
    public function lastNumber($tablename)
    {
     	$this->sql = "SHOW TABLE STATUS LIKE '$tablename'";
    	$this->error = "";
      
      try{
        $conn = $this->openDatabase();
        $query = $conn->prepare($this->sql);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        
        if( ! $row){
            die("Erro na consulta, contacte o suporte técnico");
        }
        //
        return $row['Auto_increment'];      
      }catch(PDOException  $e ){
        $this->error = $e;
        die("Error: " . $e);
      }      
    }

    /**
     * [openDatabase description]
     * @return [type] [description]
     */
    public function openDatabase()
    {
      $options = array(
        PDO::ATTR_PERSISTENT => true, //true dá pau nas transações
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::MYSQL_ATTR_FOUND_ROWS => true
      );
      //
    	try {
        $conn = new PDO("mysql:host=" . $this->servidor . ";port=3306;dbname=" . $this->database, $this->user, $this->pwd, $options);
        return $conn;			
    	}catch (PDOException $e){
    		$this->error = $e->getMessage();
        die($e->getMessage());      
    	}
    }

    /**
     * [runSQL description]
     * @param  [type] $sql [description]
     * @return [type]      [description]
     */
    public function runSQL($sql)
    {
    	$this->sql = trim($sql);
    	$this->error = "";

      try{
        $conn = $this->openDatabase();
        $query = $conn->prepare($sql);
        $query->execute();
        return $query;
      }catch(PDOException  $e ){
        $this->error = $e;
        die("Error: " . $e);
      }    
    }

    /**
     * [debug description]
     * @return [type] [description]
     */
    private function debug()
    {
    	if(!empty($this->errorCallbackFunction)) {
    		$error = array("Error" => $this->error);
    		if(!empty($this->sql))
    			$error["SQL Statement"] = $this->sql;
    		if(!empty($this->bind))
    			$error["Bind Parameters"] = trim(print_r($this->bind, true));

    		$backtrace = debug_backtrace();
    		if(!empty($backtrace)) {
    			foreach($backtrace as $info) {
    				if($info["file"] != __FILE__)
    					$error["Backtrace"] = $info["file"] . " at line " . $info["line"];	
    			}		
    		}
        //
    		$msg = "";
        //
    		if($this->errorMsgFormat == "html") {
    			if(!empty($error["Bind Parameters"]))
    				$error["Bind Parameters"] = "<pre>" . $error["Bind Parameters"] . "</pre>";
    			$css = trim(file_get_contents(dirname(__FILE__) . "/error.css"));
    			$msg .= '<style type="text/css">' . "\n" . $css . "\n</style>";
    			$msg .= "\n" . '<div class="db-error">' . "\n\t<h3>SQL Error</h3>";
    			foreach($error as $key => $val)
    				$msg .= "\n\t<label>" . $key . ":</label>" . $val;
    			$msg .= "\n\t</div>\n</div>";
    		}
    		elseif($this->errorMsgFormat == "text") {
    			$msg .= "SQL Error\n" . str_repeat("-", 50);
    			foreach($error as $key => $val)
    				$msg .= "\n\n$key:\n$val";
    		}
        //
    		$func = $this->errorCallbackFunction;
    		$func($msg);
    	}
    }  

    /**
     * [cleanup description]
     * @param  [type] $bind [description]
     * @return [type]       [description]
     */
    private function cleanup($bind)
    {
    	if(!is_array($bind)) {
    		if(!empty($bind))
    			$bind = array($bind);
    		else
    			$bind = array();
    	}
    	return $bind;
    } 
  
    /**
    * Função para salvar mensagens de LOG no MySQL
    *
    * @param string $mensagem - A mensagem a ser salva
    *
    * @return bool - Se a mensagem foi salva ou não (true/false)
    */
    public function saveLog($pdo = null, $log_user, $id_customer, $email, $mensagem, $obs=null)
    {
      if(is_null($pdo)){
        $pdo = $this->openDatabase();
        //
        if(!$pdo){
            return 'Erro ao iniciar a conexão';
        }
      }
      //    
      $ip = $_SERVER['REMOTE_ADDR']; // Salva o IP do visitante
      $hora = date('Y-m-d H:i:s'); // Salva a data e hora atual (formato MySQL)
      // Usamos o mysql_escape_string() para poder inserir a mensagem no banco
      //   sem ter problemas com aspas e outros caracteres
      $mensagem = $this->fullTrimX(htmlspecialchars($mensagem,0),0);
      // Monta a query para inserir o log no sistema
      $sql  = "INSERT INTO `_logs` (id_customer, log_user, log_email, log_ip, log_mensagem, log_obs, log_data_cadastro) VALUES (";
      $sql .= "'" . $id_customer . "', ";
      $sql .= "'" . $this->fullTrimX($log_user, 0). "', ";
      $sql .= "'" . $email . "', ";
      $sql .= "'" . $ip . "', ";
      $sql .= "'" . $mensagem . "', ";
      $sql .= "'" . $this->fullTrimX(htmlspecialchars($obs,0),0) . "', ";
      $sql .= "'" . $hora . "')";
      //
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
        die( $sql);
        return $e->getMessage(); 
      }        
      //
      if(!$result){
        return "ERROR";
      }
      //
      return "OK";        
    }

    /**
     * [getInstance description]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
 }
