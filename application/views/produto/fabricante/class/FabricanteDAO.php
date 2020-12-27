<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage fabricante
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

class FabricanteDAO
{   
    private $pdo;
    private $fabricante_descricao;
    private $fabricante_status;
    private $fabricante_id;
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
        die('Sua sessão expirou, será necessário logar-se no sistema novamente!');// Usuário não logado
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
      if(!isset($_POST['fabricante_status'])){
        $_POST['fabricante_status'] = 1;
      }

      $this->flag = intval($_POST['fabricante_id']);
      //
      if(apenasLetras($_POST['fabricante_descricao'])==0 || strlen($_POST['fabricante_descricao'])==0){
              $json = array('id'=>'fabricante_descricao',
                            'msg'=>utf8_encode('Nome do fabricante inválido, verifique!')
                            );
              return(json_encode($json)); 
      }
      
      $ret = $this->duplicidadeNome($this->flag);

      if($ret){
        $json = array('id'=>'fabricante_descricao',
                      'msg'=>utf8_encode($ret)
                      );
        return(json_encode($json));
      }
      //
      if (strlen($_POST['token'])) {
            $json = array('id'=>'fabricante_descricao',
                          'msg'=>utf8_encode(ROBOT)
                          );
            return(json_encode($json));
      }
      // Destrói o valor do token
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
          return 'Erro ao iniciar a conexão';
      }
      //
      if($flag==0){
        $sql = "SELECT fabricante_id FROM fabricante WHERE fabricante_descricao='{$_POST['fabricante_descricao']}'";
      }else{
        $sql = "SELECT fabricante_id FROM fabricante WHERE fabricante_descricao='{$_POST['fabricante_descricao']}' AND fabricante_id <> {$_POST['fabricante_id']}";
      }
      //    
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
      //
      if ($result OR $query->rowCount()) {
          $ret  = "Operação falhou.<p>Descrição(" . $_POST['fabricante_descricao'] . ") ";
          $ret .= "já cadastrado para o id ( {$result['fabricante_id']} ), ";
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
          return 'Erro ao iniciar a conexão';
      }    
      /*
        * ENTRA A CONSULTA DE INSERÇÃO
      */
      $sql  = "INSERT INTO fabricante(";
      $sql .= "`fabricante_descricao`,";
      $sql .= "`fabricante_status`,";
      $sql .= "`fabricante_data_cadastro`) ";
      $sql .= "VALUES(";
      $sql .= "'" . retiraAcentos(strip_tags($_POST['fabricante_descricao'])) . "', ";
      $sql .= "'" . (int)$_POST['fabricante_status'] . "', ";
      $sql .= "'" . Date("Y-m-d H:i:s"). "'";    
      $sql .= ");";
      //
    	//CONSULTA DE EXECUÇÃO	
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
          return 'Erro ao iniciar a conexão';
      }
      /*
        * ENTRA A CONSULTA DE INSERÇÃO
      */
      $sql  = "UPDATE fabricante SET ";
      $sql .= "`fabricante_descricao`= '" . retiraAcentos(strip_tags($_POST['fabricante_descricao'])) . "', ";
      $sql .= "`fabricante_status`= '" . (int)$_POST['fabricante_status'] . "', ";
      $sql .= "`fabricante_data_cadastro` ='" . Date("Y-m-d H:i:s"). "' ";
  	  $sql .= "WHERE `fabricante_id` =" . (int)$_POST['fabricante_id'] . ";";
      //
    	//CONSULTA DE EXECUÇÃO	
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
        return $e->getMessage(); 
      }
      //
      return 'OK';
    } 
}