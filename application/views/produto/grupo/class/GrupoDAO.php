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
use App\Conexao\ConnClass;

class GrupoDAO
{   
    private $pdo;
    private $grupo_descricao;
    private $grupo_status;
    private $grupo_id;
    public  $flag;
  
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
        die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!');// Usu�rio n�o logado
      }
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
      //
      if(!isset($_POST['grupo_status'])){
        $_POST['grupo_status'] = 1;
      }

      $this->flag = intval($_POST['grupo_id']);
      //
      if(apenasLetras($_POST['grupo_descricao'])==0 || strlen($_POST['grupo_descricao'])==0){
              $json = array('id'=>'grupo_descricao',
                            'msg'=>utf8_encode('Nome do grupo inv�lido, verifique!')
                            );
              return(json_encode($json)); 
      }
      
      $ret = $this->duplicidadeNome($this->flag);

      if($ret){
        $json = array('id'=>'cliente_nome',
                      'msg'=>utf8_encode($ret)
                      );
        return(json_encode($json));
      }      
      //
      if (strlen($_POST['token'])) {
            $json = array('id'=>'grupo_descricao',
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
        $sql = "SELECT grupo_id FROM grupo WHERE grupo_descricao='{$_POST['grupo_descricao']}'";
      }else{
        $sql = "SELECT grupo_id FROM grupo WHERE grupo_descricao='{$_POST['grupo_descricao']}' AND grupo_id <> {$_POST['grupo_id']}";
      }
      //    
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
      //
      if ($result OR $query->rowCount()) {
          $ret  = "Opera��o falhou.<p>Descri��o(" . $_POST['grupo_descricao'] . ") ";
          $ret .= "j� cadastrado para o id ( {$result['grupo_id']} ), ";
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
      $sql  = "INSERT INTO grupo(";
      $sql .= "`grupo_descricao`,";
      $sql .= "`grupo_status`,";
      $sql .= "`grupo_data_cadastro`) ";
      $sql .= "VALUES(";
      $sql .= "'" . retiraAcentos(strip_tags($_POST['grupo_descricao'])) . "', ";
      $sql .= "'" . (int)$_POST['grupo_status'] . "', ";
      $sql .= "'" . Date("Y-m-d H:i:s"). "'";    
      $sql .= ");";
      //
    	//CONSULTA DE EXECU��O	
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
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
      $sql  = "UPDATE grupo SET ";
      $sql .= "`grupo_descricao`= '" . retiraAcentos(strip_tags($_POST['grupo_descricao'])) . "', ";
      $sql .= "`grupo_status`= '" . (int)$_POST['grupo_status'] . "', ";
      $sql .= "`grupo_data_cadastro` ='" . Date("Y-m-d H:i:s"). "' ";
  	  $sql .= "WHERE `grupo_id` =" . (int)$_POST['grupo_id'] . ";";
      //
    	//CONSULTA DE EXECU��O	
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
        return $e->getMessage(); 
      }
      //
      return 'OK';
    } 
}