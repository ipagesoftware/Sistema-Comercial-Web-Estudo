<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage usuários x Vendedor
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class UsersVendedorAjax{   
    private $pdo;
    private $descricao;    
    /**
     * [__construct description]
     */
    public function __construct(){
      $this->pdo = ConnClass::getInstance();
      $this->sid = Session::getInstance();
      $this->security = Security::getInstance();
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
        if(isset($_POST['descricao'])){
          $this->descricao = (int)$_POST['descricao'];
        }else{
          $this->descricao = 0;
        }
    }  

    /**
     * [getDados description]
     * @return [type] [description]
     */
    public function getDados()
    {
      if(!$this->descricao){
        /*
        $sql  = "SELECT vendedor.vendedor_nome, vendedor.vendedor_id ";
        $sql .= "FROM users_vendedor RIGHT JOIN vendedor ON users_vendedor.vendedor_id = vendedor.vendedor_id ";
        $sql .= "WHERE (((users_vendedor.user_vendedor_id) Is Null) AND ((vendedor.vendedor_status)=1)) ";
        $sql .= "ORDER BY vendedor.vendedor_nome;";
        */
       
        $sql = "SELECT vendedor_nome, vendedor_id ";
        $sql .= "FROM vendedor ";
        $sql .= "WHERE vendedor_status = 1 ORDER BY vendedor_nome;";
      }else{
        $sql  = "SELECT vendedor.vendedor_nome, vendedor.vendedor_id "; 
        $sql .= "FROM users_vendedor INNER JOIN vendedor ON users_vendedor.vendedor_id = vendedor.vendedor_id "; 
        $sql .= "WHERE (((vendedor.vendedor_status)=1) AND ((users_vendedor.user_id)=$this->descricao)) "; 
        $sql .= "ORDER BY vendedor.vendedor_nome;";
      }
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $recordcount = $query->rowCount();     
      // Verifica se tem dados, se a consulta retornou algum registro
      if ($recordcount>0){
        $json = '[';
        $i = 0;      
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
  				$i = $i+1;
          $json = $json . '[{"descricao": "'.$rs[0].'"},';
          if ($i == $recordcount){
            $json = $json . '{"id": "'.$rs[1].'"}]';
          }else{
            $json = $json . '{"id": "'.$rs[1].'"}],';
          }
        }
        if(strlen($json)>0){
          $json = $json . ']';
          return (utf8_encode($json));
        }else{
          return '[{"retorno": "Nenhum registro foi encontrado com o(s) dado(s) informado(s)!"}]';
        }      
      }else{
        $sql='';
    		$json =  '[{"retorno": "Nenhum registro foi encontrado com o(s) dado(s) informado(s)!'.$sql.' - '.$this->descricao.'"}]';      
        return $json;
      }
      //    
      return -1; // Condição que indica erro 
    }
}