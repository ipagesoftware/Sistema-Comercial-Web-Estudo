<?php
/**
 * @version    1.0
 * @package    Produto
 * @subpackage Unidade de medida
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

class UmDAO
{   
  private $pdo;
  private $um_sigla;
  private $um_descricao;
  private $um_status;
  private $um_id;
  public  $flag;
  
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
        die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!');// Usu�rio n�o logado
      }
      //    
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {    
      foreach ($_POST as $key => $value) {
          $_POST[$key] = htmlspecialchars($value);
      }

      $this->flag = intval($_POST['um_id']);
      //
      if(!isset($_POST['um_sigla'])){
        $json = array('id'=>'um_sigla',
                      'msg'=>utf8_encode("Descri��o da sigla � inv�lida ou inexistente, verifique!")
                      );
        return(json_encode($json));
      }
      //
      if(!isset($_POST['um_descricao'])){
        $json = array('id'=>'um_sigla',
                      'msg'=>utf8_encode("Descri��o inv�lida ou inexistente, verifique!")
                      );
        return(json_encode($json));
      }    
      //VERIFICA SE O NOME DO USU�RIO � REPETIDO
      $ret = $this->duplicidadeNome($this->flag);

      if($ret){
        $json = array('id'=>'um_descricao',
                      'msg'=>utf8_encode($ret)
                      );
        return(json_encode($json));
      }
      //
      if (strlen($_POST['token'])) {
            $json = array('id'=>'um_descricao',
                          'msg'=>utf8_encode(ROBOT)
                          );
            return(json_encode($json));
      }
      // Destr�i o valor do token
      unset($_POST['token']);      
      return 'OK';     
    }

    /**
     * [duplicidadeNome description]
     * @param  [type] $flag [description]
     * @return [type]       [description]
     */
    public function duplicidadeNome($flag)
    {
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conex�o';
      }
      //
      if($flag==0){
        $sql = "SELECT um_id FROM um WHERE um_descricao='{$_POST['um_descricao']}'";
      }else{
        $sql = "SELECT um_id FROM um WHERE um_descricao='{$_POST['um_descricao']}' ";
        $sql .= "AND um_id <> {$_POST['um_id']}";
      }
      //    
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
      //
      if ($result OR $query->rowCount()) {
          $ret  = "Opera��o falhou.<p>Descri��o(" . $_POST['um_descricao'] . ") ";
          $ret .= "j� cadastrado para o id ( {$result['um_id']} ), ";
          $ret .= "tente outro valor!</p>";
          return $ret;
      }
    }  

    /**
     * [insertReg description]
     * @return [type] [description]
     */
    public function insertReg()
    {
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conex�o';
      }
      /*
        * ENTRA A CONSULTA DE INSER��O
      */
      $sql  = "INSERT INTO um(";
      $sql .= "`um_sigla`,";
      $sql .= "`um_descricao`,";
      $sql .= "`um_status`,";
      $sql .= "`um_data_cadastro`) ";
      $sql .= "VALUES(";
      $sql .= "'" . retiraAcentos(strip_tags($_POST['um_sigla'])) . "', ";
      $sql .= "'" . retiraAcentos(strip_tags($_POST['um_descricao'])) . "', ";
      $sql .= "'" . (int)$_POST['um_status'] . "', ";
      $sql .= "'" . Date("Y-m-d H:i:s"). "'";    
      $sql .= ");";
      //
    	//CONSULTA DE EXECU��O	
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
     * [updtReg description]
     * @return [type] [description]
     */
    public function updtReg()
    {
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conex�o';
      }
      /*
        * ENTRA A CONSULTA DE INSER��O
      */
      $sql  = "UPDATE um SET ";
      $sql .= "`um_sigla`= '" . retiraAcentos(strip_tags($_POST['um_sigla'])) . "', ";
      $sql .= "`um_descricao`= '" . retiraAcentos(strip_tags($_POST['um_descricao'])) . "', ";
      $sql .= "`um_status`= '" . (int)$_POST['um_status'] . "', ";
      $sql .= "`um_data_cadastro` ='" . Date("Y-m-d H:i:s"). "' ";
  	  $sql .= "WHERE `um_id` =" . (int)$_POST['um_id'] . ";";
      //
    	//CONSULTA DE EXECU��O	
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
