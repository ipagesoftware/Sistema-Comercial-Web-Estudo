<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Vendedor x Cliente
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Conexao\ConnClass;

class VendedorClienteDAO{   
    private $pdo;
    private $vendedor_id;
    private $cliente_id;
    public  $flag;
    
    /**
     * [__construct description]
     */
    public function __construct()
    {
      $this->pdo = ConnClass::getInstance();
      $this->sid = Session::getInstance();
      $this->sid->start();
      //
      if(!$this->sid->check()){      
        die('Sua sessão expirou, será necessário logar-se no sistema novamente!');// Usuário não logado
      }elseif( (int)$this->sid->getNode('procedencia_id') ==0){
        die('Impossível continuar, procedência não foi selecionada.');            
      }
    }


    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {    
      //CAPTAÇÃO DADOS
      if(!isset($_POST['cbo_vendedor']) OR !isset($_POST['list2'])){
        exit(": PARÂMETRO NÃO DEFINIDO");
      }else{
        $this->vendedor_id   = $_POST['cbo_vendedor'];
        $this->cliente_id    = $_POST['list2'];
      }
      //
      return 'OK';     
    }  

    /**
     * [insertReg description]
     * @return [type] [description]
     */
    public function insertReg()
    {
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }    
      //
      $pdo->beginTransaction(); /* Inicia a transação */
      // APAGO OS DADOS DA TABELA PARA A INSERÇÃO DE NOVOS
      $sql = "DELETE FROM vendedor_cliente WHERE `vendedor_id` =" . $this->vendedor_id;
  	  //CONSULTA DE EXECUÇÃO	
      try{    
        $result = $pdo->query($sql);
      }catch (PDOException $e) { 
        return $e->getMessage(); 
      }        
      //
      if(!$result){
        $pdo->rollBack();
        return "ERROR";
      }
      //    
      if( is_array($this->cliente_id)){       
        foreach($this->cliente_id as $key){
          $sql  = "INSERT INTO ";
          $sql .= "vendedor_cliente(";
          $sql .= "vendedor_id, ";
          $sql .= "cliente_id, ";
          $sql .= "vendedor_cliente_data_cadastro";
          $sql .= ") ";
          $sql .= "VALUES(";
          $sql .= $this->vendedor_id . ", ";
          $sql .= "'{$key}', ";
          $sql .= "'" . Date("Y-m-d H:i:s") ."')";              
          //
          try{    
            $result = $pdo->query($sql);
          } 
          catch (PDOException $e) {
            $pdo->rollBack();
            return $e->getMessage(); 
          }                
        }
      }
      //
      if(!$result)
      {
        $pdo->rollBack();      
        return 'ERROR';
      }
      //
      $pdo->commit();  
      return 'OK_INSERT';
    }
}
