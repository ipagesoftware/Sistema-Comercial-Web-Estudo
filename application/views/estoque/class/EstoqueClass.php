<?php
  /**
   * @version    1.0
   * @package    Estoque
   * @subpackage Ajuste
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

setlocale(LC_TIME, 'portuguese'); 
//date_default_timezone_set('America/Recife');
date_default_timezone_set("Brazil/East");
/**
 * @author IPAGE
 * @copyright 2020
 */

class EstoqueClass{  
  //
  private $pdo;
  private $permission;
  private $tabela = 'estoque';
  private $security;
  public  $sid;  
  public  $data_movimentacao;
  /**
    ***********************************************************************
  */                           
  function __construct()
  {    
    $this->data_movimentacao = date("Y-m-d H:i:s");
    //    
    $this->pdo = ConnClass::getInstance();
    $this->security = Security::getInstance();
    $this->sid = Session::getInstance();
    $this->sid->start();
    //
    if(!$this->sid->check())
    {      
      $ret = '<p style="text-align: justify;">Sua sessão expirou, será necessário logar-se no sistema novamente!</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }
    //
    $cPermission = new UserPermission();
    $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);
    //
    if($this->permission['negar']!=1){
      $ret  = '<p style="text-align: justify;">Usuário sem permissão para acessar o módulo: <strong>ESTOQUE</strong>.</p>';
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }elseif($this->permission['excluir']!=1){
      $ret  = '<p style="text-align: justify;">Usuário sem permissão para excluir registro no módulo: <strong>ESTOQUE</strong>.</p>';      
      $ret .= FONE_EMAIL_ATENDIMENTO;
      die($ret);
    }
  }

  /**
    ***********************************************************************
  */
  public function getEntradaEstoque($produto_id){
    $sql = "SELECT quant_entrada FROM estoque WHERE produto_id = " . $produto_id . ";";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()>0){
      return $rs[0]*1;
    }else{
      return 0;
    }
  }
  /**
    ***********************************************************************
  */
  public function getEstoqueAtual($produto_id){
    //
    $sql = "SELECT estoque_atu FROM estoque WHERE produto_id = " . $produto_id . ";";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()>0){
      return $rs[0]*1;
    }else{
      return 0;
    }
  }
  /**
    ***********************************************************************
  */
  public function getEstoqueCritico($produto_id, $quant_atual = -1){
    $estoque_minimo = 0;
    //
    if($quant_atual==-1){
      $quant_atual = $this->getEstoqueAtual($produto_id);
    }
    //
    $sql  = "SELECT produto_estoque_minimo FROM produto WHERE produto_id=" . $produto_id . ";";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()>0){
      $estoque_minimo = $rs[0]*1;
    }
    //
    if($quant_atual <= $estoque_minimo){
      return true;
    }else{
      return false;
    }    
  }
  /**
    ***********************************************************************
  */
  public function getSaidaEstoque($produto_id){
    $estoque_minimo = 0;
    //
    if($quant_atual==-1){
      $quant_atual = $this->getEstoqueAtual($produto_id);
    }
    //
    $sql = "SELECT quant_saida FROM estoque WHERE produto_id = " . $produto_id . ";";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()>0){
        return $rs[0]*1;
    }else{
      return 0;
    }    
  }
  /**
    ***********************************************************************
    * Descrição             : Verifica se o produto existe no estoque.
    *                       : Se não existir lance com o valor zero para
    *                       : quantidade entrada, saida e tipo operação = entrada
    * Parâmetros Passados   :
    * Parâmetros Retornados : 1 se existir, 0 se não existir,
    *                       : 255 erro, 2 criado na tabela estoque
  **/
  public function produtoExiste($produto_id){
    //
    $sql = "SELECT produto_id FROM produto WHERE (produto_id = " . $produto_id . ");";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()<=0){
       return 0;
    }
    //
    $critico = 0;
    $sql = "SELECT produto_id FROM estoque WHERE (produto_id = " . $produto_id . ");";
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()<=0){
      $critico = ($this->getEstoqueCritico($produto_id, 0))?1:0;      
      #
      #/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
      #> INSIRO O VALOR PADRÃO NO ESTOQUE <
      #/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\
      #
      $sql  = "INSERT INTO estoque(`produto_id`, `quant_entrada`, `quant_saida`, `estoque_atu`, `tipo_op`, `usuario`, `critico`, `origem`, `data_cadastro`) ";
      $sql .= "VALUES(" . $produto_id . ", ";
      $sql .= "'0', ";
      $sql .= "'0', ";
      $sql .= "'0', ";
      $sql .= "'E', ";
      $sql .= "'" . $this->sid->getNode('user_login') . "', ";
      $sql .= "'" . $critico . "', ";
      $sql .= "'CADASTRO AUTOMATICO', ";
      $sql .= "'" . $this->data_movimentacao . "'); ";
      //
      try{    
        $result = $pdo->query($sql);
      } 
      catch (PDOException $e) { 
        return 255;
      }
      //      
      $this->setEntradaEstoque($produto_id,0,0,'ABERTURA ESTOQUE');        
      return 2;      
    }else{
      $sql = "SELECT produto_id FROM estoque_log WHERE (produto_id = " . $produto_id . ");";
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);    
      //
      if($query->rowCount()<=0){
        $this->setEntradaEstoque($produto_id,0,0,'ABERTURA ESTOQUE');
      }
    }
    return 1;
  }
  /*********************************************************************/
  public function normalize(){
    $sql = "SELECT produto_id FROM produto ORDER BY produto_id ASC;";
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    //
    while ($rs = $query->fetch(PDO::FETCH_BOTH)){
      $this->produtoExiste($rs[0]);
    }    
  }
  /**
    ***********************************************************************
    * 1 - OK, 0 - Deu erro
    *********************************************************************** 
  */  
  public function setEntradaEstoque($produto_id, $quantidade = 0, $numero_venda = 0, $origem = "NAO INFORMADO", $tipo_op = "E"){
    //[E]entrada, [S]aída, [ES] Estorno Saída, [EE] Estorno Entrada, [P]erda, [C]onsumo, [TE] Troca Entrsa, [TS] Troca Saída
    //
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #> PEGO O ESTOQUE ATUAL <
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #
    $quant_atual = $this->getEstoqueAtual($produto_id);
    $total = (float)$quantidade + (float)$quant_atual;
    $critico = ($this->getEstoqueCritico($produto_id, $total))?1:0;    
    //
    $sql  = "UPDATE estoque ";
    $sql .= "SET quant_entrada ='" . (float)($quantidade) . "', ";
    $sql .= "estoque_atu ='" . (float)$total . "', ";
    $sql .= "tipo_op = '" . $tipo_op ."', ";
    $sql .= "usuario = '" . $this->sid->getNode("user_login") . "', ";
    $sql .= "critico = '" . $critico . "', ";
    $sql .= "origem = '" . fullTrimX(utf8_encode(strtoupper($origem))) . "', ";
    $sql .= "data_cadastro = '" . $this->data_movimentacao . "' ";
    $sql .= "WHERE produto_id = " . $produto_id;    
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    try{    
      $result = $pdo->query($sql);
    } 
    catch (PDOException $e) { 
      return 0; 
    }
    //    
    return $this->setEstoqueLog($produto_id, $quantidade, $quant_atual, $tipo_op, $numero_venda, $critico, $origem);        
  }
  /**
    ***********************************************************************
    * 1 - OK, 0 - Deu erro
    *********************************************************************** 
  */  
  public function setSaidaEstoque($produto_id, $quantidade = 0, $numero_venda = 0, $origem = "NAO INFORMADO", $tipo_op = "S"){
    //[E]entrada, [S]aída, [ES] Estorno Saída, [EE] Estorno Entrada, [P]erda, [C]onsumo, [TE] Troca Entrsa, [TS] Troca Saída
    //
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #> PEGO O ESTOQUE ATUAL <
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #
    $quant_atual = $this->getEstoqueAtual($produto_id);
    $total = (float)$quant_atual - (float)$quantidade;
    $critico = ($this->getEstoqueCritico($produto_id, $total))?1:0;    
    //
    $sql  = "UPDATE estoque ";
    $sql .= "SET quant_saida ='" . (float)($quantidade) . "', ";
    $sql .= "estoque_atu ='" . (float)$total . "', ";
    $sql .= "tipo_op = '" . $tipo_op ."', ";
    $sql .= "usuario = '" . $this->sid->getNode("user_login") . "', ";
    $sql .= "critico = '" . $critico . "', ";
    $sql .= "origem = '" . fullTrimX(utf8_encode(strtoupper($origem))) . "', ";
    $sql .= "data_cadastro = '" . $this->data_movimentacao . "' ";
    $sql .= "WHERE produto_id = " . $produto_id;
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    try{    
      $result = $pdo->query($sql);
    } 
    catch (PDOException $e) { 
      return 0; 
    }
    //    
    return $this->setEstoqueLog($produto_id, $quantidade, $quant_atual, $tipo_op, $numero_venda, $critico, $origem);        
  }
  /**
    ***********************************************************************
    * 1 - OK, 0 - Deu erro
    *********************************************************************** 
  */  
  public function setPerdaEstoque($produto_id, $quantidade = 0, $numero_venda = 0, $origem = "NAO INFORMADO"){
    return $this->setSaidaEstoque($produto_id, $quantidade, $numero_venda, $origem, "P");        	
  } 
  /**
    ***********************************************************************
    * 1 - OK, 0 - Deu erro
    *********************************************************************** 
  */  
  public function setTrocaEstoque($produto_id1, $produto_id2, $quantidade = 0, $numero_venda = 0, $origem = "NAO INFORMADO"){
    // VERIFICA SE PROD1 E PROD 2 EXISTEM
    if($this->produtoExiste($produto_id1)!=1){
      return 0;
    }
    
    if($this->produtoExiste($produto_id2)!=1){
      return 0;
    }
    //        
    $ret = $this->setEntradaEstoque($produto_id1, $quantidade, $numero_venda, $origem, "TE");
    if($ret){
      $ret = $this->setSaidaEstoque($produto_id2, $quantidade, $numero_venda, $origem, "TS");
    }
    //
    return $ret;
  }   
  /**
    ***********************************************************************
    * 1 - OK, 0 - Deu erro
    *********************************************************************** 
  */  
  public function setEstornoEstoque($produto_id, $quantidade = 0, $numero_venda = 0, $origem = "NAO INFORMADO", $tipo_op="EE"){
    //[E]entrada, [S]aída, [ES] Estorno Saída, [EE] Estorno Entrada, [P]erda, [C]onsumo, [TE] Troca Entrsa, [TS] Troca Saída
    //
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #> PEGO O ESTOQUE ATUAL <
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #
    $quant_atual = $this->getEstoqueAtual($produto_id);    
    $quant_saida = abs((float)$this->getSaidaEstoque($produto_id) - (float)$quantidade);    
    
    if(strtoupper($tipo_op)=="EE"){
      $total = (float)$quant_atual + (float)$quantidade;
    }
    elseif(strtoupper($tipo_op)=="ES"){
      $total = (float)$quant_atual - (float)$quantidade;
    }else{
      return 0;//ERRO
    }
    //
    $critico = ($this->getEstoqueCritico($produto_id, $total))?1:0;    
    //
    $sql  = "UPDATE estoque ";
    $sql .= "SET quant_entrada ='" . (float)($quantidade) . "', ";
    $sql .= "quant_saida ='" . (float)($quant_saida) . "', ";
    $sql .= "estoque_atu ='" . (float)$total . "', ";
    $sql .= "tipo_op = '" . $tipo_op . "', ";
    $sql .= "usuario = '" . $this->sid->getNode("user_login") . "', ";
    $sql .= "critico = '" . $critico . "', ";
    $sql .= "origem = '" . fullTrimX(utf8_encode(strtoupper($origem))) . "', ";
    $sql .= "data_cadastro = '" . $this->data_movimentacao . "' ";
    $sql .= "WHERE produto_id = " . $produto_id;
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    try{    
      $result = $pdo->query($sql);
    } 
    catch (PDOException $e) { 
      return 0; 
    }
    //    
    return $this->setEstoqueLog($produto_id, $quantidade, $quant_atual, $tipo_op, $numero_venda, $critico, $origem);        
  }   
  /**
    ***********************************************************************
    *
    *********************************************************************** 
  */
  public function setEstoqueLog($produto_id, $quantidade = 0, $quant_atual = 0, $tipo_op = "E", $numero_venda = 0, $critico = -1, $origem = "NAO INFORMADO"){
    $controle;
    $inicial=0;
    $quant_entrada = 0;
    $quant_saida = 0;
    $quantidade_atual = 0;
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #> VERIFICA SE HÁ DADOS <
    #/\/\/\/\/\/\/\/\/\/\/\/\
    #
    $sql = "SELECT estoque_atu, controle FROM estoque_log WHERE produto_id = " . $produto_id . " ORDER BY id DESC LIMIT 1;";
    //
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    }
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    //
    if($query->rowCount()>0){
      $inicial = $rs["estoque_atu"];
      $controle = (int)$rs["controle"] + 1;      
    }else{
      $controle = 1;
      $inicial = $quant_atual;      
    }
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\/
    #> INSERE NO ESTOQUE_LOG <
    #/\/\/\/\/\/\/\/\/\/\/\/\/
    #
    $sql = "INSERT INTO estoque_log(controle, produto_id, estoque_inicial, quant_entrada, ";
    $sql .= "quant_saida, estoque_atu, tipo_op, usuario, critico, origem, numvenda, data_cadastro) ";
    $sql .= "VALUES ('" . $controle . "', ";
    $sql .= "'" . $produto_id . "', ";
    $sql .= "'" . (float)$inicial . "', ";
    #    
    switch (strtoupper($tipo_op)){
      case 'E':
        #ENTRADA
        $quant_entrada = $quantidade;
        $quant_saida = 0;
        break;    
      case 'EE':
        #ESTORNO ENTRADA
        $quant_entrada = $quantidade;
        $quant_saida = 0;
        break;
      case 'S':
        #SAIDA
        $quant_entrada = 0;
        $quant_saida = $quantidade;
        break;
      case 'ES':
        $quant_entrada = 0;
        $quant_saida = $quantidade;
        break;
      case 'P':
        #SAIDA
        $quant_entrada = 0;
        $quant_saida = $quantidade;
        break;
      case 'C':
        #SAIDA
        $quant_entrada = 0;
        $quant_saida = $quantidade;
        break;
      case "TS":
        #SAIDA
        $quant_entrada = 0;
        $quant_saida = $quantidade;
        break;
      case 'TE':
        #ENTRADA
        $quant_entrada = $quantidade;
        $quant_saida = 0;
        break;
      default:
        #ENTRADA
        $quant_entrada =0;
        $quant_saida = 0;
    }
    //
    $sql .= "'" . (float)$quant_entrada . "', ";
    $sql .= "'" . (float)$quant_saida . "', ";
    #
    $quantidade_atual = ((float)$inicial + (float)$quant_entrada) - (float)$quant_saida;
    #
    #/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
    #> VERIFICA SE O ESTOQUE CRITICO FOI <
    #> PASSADO COMO PARAMETRO.           <
    #/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/
    #
    
    if($critico < 0 Or $critico > 1){
      $critico = ($this->getEstoqueCritico($produto_id, $quantidade_atual))? 1: 0;      
    }
    #
    $sql .= "'" . (float)$quantidade_atual . "', ";
    $sql .= "'" . $tipo_op . "', ";
    $sql .= "'" . $this->sid->getNode("user_login") . "', ";
    $sql .= "'" . $critico . "', ";
    $sql .= "'" . fullTrimX(utf8_encode(strtoupper($origem))) . "', ";
    $sql .= "'" . $numero_venda . "', ";
    $sql .= "'" . $this->data_movimentacao  . "');";
    #
    try{    
      $result = $pdo->query($sql);
    } 
    catch (PDOException $e) { 
      return 0; 
    } 
    #
    return 1;    
  } 
}
?>