<?php
/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Procedencia
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

class ProcedenciaDAO{   
    private $pdo;
    private $procedencia_id = 0;
    public  $flag;
    //    
    function __construct(){
      $this->pdo = ConnClass::getInstance();
      $this->sid = Session::getInstance();
      $this->security = Security::getInstance();    
      $this->sid->start();
      //
      if(!$this->sid->check()){
        die(': Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!');// Usu�rio n�o logado
      }elseif((int)$this->sid->getNode('procedencia_id') ==0){
        die(': Imposs�vel continuar, proced�ncia n�o foi selecionada.');
      }elseif(!FINANCAS){
        die(': Imposs�vel continuar, m�dulo financeiro n�o est� habilitado para esta aplica��o.');
      }  
    }
     
    public function getValues(){  
        $this->flag = intval($_POST['procedencia_id'], 10);
        //
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);

            switch ($key) {
                case 'procedencia_empresa':
                    $ret = $this->duplicidadeNome($this->flag);
                    if($ret){
                      $json = array('id'=>$key,
                                    'msg'=>utf8_encode($ret)
                                    );
                        return(json_encode($json));
                    }
                case 'procedencia_email':
                    // Remove os caracteres ilegais do email
                    $email = filter_var($_POST['procedencia_email'], FILTER_SANITIZE_EMAIL);
                    //
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                      $json = array('id'=>'procedencia_email',
                                    'msg'=>utf8_encode('Email inv�lido, verifique!')
                                    );
                      return(json_encode($json));
                    }
                    // Verifica se o email � repetido
                    $ret = $this->duplicidadeEmail($this->flag);

                    if($ret){
                      $json = array('id'=>'procedencia_email',
                                    'msg'=>utf8_encode($ret)
                                    );
                      return json_encode($json);
                    }
                case 'procedencia_cep':
                case 'procedencia_endereco':
                case 'procedencia_bairro':
                case 'procedencia_cidade':
                case 'procedencia_uf':
                    if(!strlen($_POST[$key])){
                        $tmp  = "Campo inv�lido ou inexistente, verifique!";
                        $json = array('id'=>$key,
                                    'msg'=>utf8_encode($tmp)
                                    );
                        return(json_encode($json));                        
                    }
                    break;
                case 'token':
                    if (strlen($_POST['token'])) {
                          $json = array('id'=>'procedencia_empresa',
                                        'msg'=>utf8_encode(ROBOT)
                                        );
                          return(json_encode($json));
                    }
                    // Destr�i o valor do token
                    unset($_POST['token']);        
                    break;                
                default:
                    # code...
                    break;
            }
        }
        return 'OK';      
    }
 
    public function duplicidadeNome($flag){
      $pdo = $this->pdo->openDatabase();
      //
      if($flag==0){
        $sql = "SELECT procedencia_id FROM procedencia WHERE procedencia_empresa='" . fullTrimX($_POST['procedencia_empresa']) ."'";
      }else{
        $sql = "SELECT procedencia_id FROM procedencia WHERE procedencia_empresa='" . fullTrimX($_POST['procedencia_empresa']) ."' AND procedencia_id <> " . (int)$_POST['procedencia_id'];
      }
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
      //
      if ($result OR $query->rowCount()) {
          $ret  = "Opera��o falhou.<p>Nome(" . $_POST['procedencia_empresa'] . ") ";
          $ret .= "j� cadastrado para o id ( {$result['procedencia_id']} ), ";
          $ret .= "tente outro valor!</p>";
          return $ret;
      }
    }
  
    public function duplicidadeEmail($flag){
      $pdo = $this->pdo->openDatabase();
      //
      if($flag==0){
        $sql = "SELECT procedencia_id FROM procedencia WHERE procedencia_email='" . fullTrimX($_POST['procedencia_email'],0) ."'";
      }else{
        $sql = "SELECT procedencia_id FROM procedencia WHERE procedencia_email='" . fullTrimX($_POST['procedencia_email'],0) ."' AND procedencia_id <> " . (int)$_POST['procedencia_id'];
      }
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
      //
      if ($result OR $query->rowCount()) {
          $ret  = "Opera��o falhou.<p>Nome(" . $_POST['procedencia_empresa'] . ") ";
          $ret .= "j� cadastrado para o id ( {$result['procedencia_id']} ), ";
          $ret .= "tente outro valor!</p>";
          return $ret;
      }
    }    
      
    public function insertReg(){
      $tmp='';
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conex�o';
      }
      /*
        * ENTRA A CONSULTA DE INSER��O
      */
      $sql  = "INSERT INTO procedencia(";
      
      foreach($_POST as $key=>$value){
        if($key=='procedencia_contato'){
          $sql .= "`" . $key . "`,";
        }else{
          $sql .= "`" . $key . "`,";
        }
      }

      $sql .= "`procedencia_data_cadastro`) ";
      $sql .= "VALUES(";
      
      foreach($_POST as $key=>$value){
        if($key=='procedencia_email'){
          $tmp = strtolower(fullTrimX($_POST['procedencia_email']));
        }elseif($key=='procedencia_contato'){
          $tmp = $_POST[$key];
          $sql .= "'" . $tmp . "' ";
        }else{
          $tmp = $_POST[$key];
        }
        //
        $sql .= "'" . $tmp . "', ";
      }
          
      $sql .= "'" . Date("Y-m-d H:i:s"). "'";    
      $sql .= ");";
      //
      try{    
        $result = $pdo->query($sql);
      } 
      catch (PDOException $e) { 
        return $e->getMessage(); 
      }        
      //
      return 'OK';
    }  
    /**
     *************************************************************************
    */  
    public function updtReg(){
      $tmp = '';
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conex�o';
      }
      /*
        * ENTRA A CONSULTA DE INSER��O
      */
      $sql  = "UPDATE procedencia SET ";
      //    
      foreach($_POST as $key=>$value){
        if($key=='procedencia_email'){
          $tmp = strtolower(fullTrimX($_POST['procedencia_email']));
        }else{
          $tmp = $_POST[$key];
        }
        $sql .= "`" . $key . "`= '" . $tmp . "', ";
      }
      //
      $sql .= "`procedencia_data_cadastro` ='" . Date("Y-m-d H:i:s"). "' ";
  	  $sql .= "WHERE `procedencia_id` =" . (int)$_POST['procedencia_id'] . ";";
      //
      try{    
        $result = $pdo->query($sql);
      } 
      catch (PDOException $e) { 
        return $e->getMessage(); 
      }
      //
      return 'OK';
    }
}