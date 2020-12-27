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
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class VendedorClienteAjax
{   
    private $pdo;
    private $descricao;
   
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
      if(empty($_POST['descricao'])){
        $this->descricao = '';
      }else{            
        $this->descricao = strip_tags(trim($_POST['descricao']));
      }
    }  

    /**
     * [getDados description]
     * @return [type] [description]
     */
    public function getDados()
    {
      //
      if(strlen($this->descricao)==0){
        /*
        $sql = "SELECT cliente.cliente_nome, cliente.cliente_id ";
        $sql .= "FROM vendedor_cliente RIGHT JOIN cliente ON vendedor_cliente.cliente_id = cliente.cliente_id ";
        $sql .= "WHERE (((vendedor_cliente.vendedor_cliente_id) Is Null) AND ((cliente.cliente_status)=1)) ";
        $sql .= "ORDER BY cliente.cliente_nome;";
        */
        $sql = "SELECT cliente_nome, cliente_id ";
        $sql .= "FROM cliente ";
        $sql .= "WHERE cliente.cliente_status=1 ORDER BY cliente.cliente_nome;";
      }else{
        $sql = "SELECT cliente.cliente_nome, cliente.cliente_id "; 
        $sql .= "FROM vendedor_cliente INNER JOIN cliente ON vendedor_cliente.cliente_id = cliente.cliente_id "; 
        $sql .= "WHERE (((cliente.cliente_status)=1) AND ((vendedor_cliente.vendedor_id)=$this->descricao)) "; 
        $sql .= "ORDER BY cliente.cliente_nome;";      
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
      //VERIFICA SE TEM DADOS, SE A CONSULTA RETORNOU ALGUM REGISTRO
      $recordcount = $query->rowCount();
      //
      if ($recordcount>0){
        $json ='[';
        $i=0;      
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)){
  				$i = $i+1;
          $json = $json . '[{"descricao": "'.$rs[0].'"},';
          if ($i == $recordcount){
            $json = $json . '{"id": "'.$rs[1].'"}]';
          }else{
            $json = $json . '{"id": "'.$rs[1].'"}],';
          }
        }
        //
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
      return -1; //CONDIÇÃO QUE INDICA ERRO 
    }
}