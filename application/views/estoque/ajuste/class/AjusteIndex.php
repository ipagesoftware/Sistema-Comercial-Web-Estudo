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
use App\Utilities\Util;
require_once "{$nivel}application/views/estoque/class/EstoqueClass.php";

class AjusteIndex{
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    public  $paginacao;
    public  $criterio;
    public  $security;
    private $tabela = 'estoque_log';
    public  $permission;
    public  $estoque;
    private $sid;
    //
    private $field_sort;
    private $order_sort;
    private $num_rows;
    public $produto_id;  
    public $estoque_atual=0;
    /**
      ***********************************************************************
    */  
    function __construct(){
      $this->criterio = "%";

      $sql  = "SELECT estoque_log.estoque_inicial, "; 
      $sql .= "estoque_log.quant_entrada, estoque_log.quant_saida, estoque_log.estoque_atu, "; 
      $sql .= "estoque_log.tipo_op, estoque_log.origem, produto.produto_descricao, estoque_log.usuario, estoque_log.critico, ";
      $sql .= "estoque_log.numvenda, estoque_log.data_cadastro, estoque_log.produto_id, estoque_log.id ";
      $sql .= "FROM produto INNER JOIN estoque_log ON produto.produto_id = estoque_log.produto_id ";
      $sql .= "WHERE ";    
      //
      $this->sql = $sql;     
      $this->sql_count = "SELECT COUNT(*) FROM produto INNER JOIN estoque_log ON produto.produto_id = estoque_log.produto_id WHERE ";
      $this->field_sort = "id";
      $this->order_sort = "DESC";
      //    
      $this->pdo = ConnClass::getInstance();
      $this->security = Security::getInstance();
      $this->sid = Session::getInstance();
      $this->estoque = new EstoqueClass();
      $this->sid->start();
      //
      if(!$this->sid->check())
      {      
        die('Sua sessão expirou, será necessário logar-se no sistema novamente!');// Usuário não logado
      }
      //
      $cPermission = new UserPermission();    
      $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), 'plano_contas'), true);
      //
      if($this->permission['negar']!=1){
        echo('<p style="text-align: justify;">Usuário sem permissão para acessar a página do módulo: <strong>PLANO CONTAS</strong>.</p>');
        echo('<p>Para maiores informações, contacte o usuário administrador.<br />');
        echo(FONE_ATENDIMENTO . ' / ' . EMAIL_ATENDIMENTO . '</p>');
        die();
      }elseif($this->permission['inserir']!=1){
        echo('<p style="text-align: justify;">Usuário sem permissão para inserir registro no módulo: <strong>PLANO CONTAS</strong>.</p>');
        echo('<p>Para maiores informações, contacte o usuário administrador.<br />');
        echo(FONE_ATENDIMENTO . ' / ' . EMAIL_ATENDIMENTO . '</p>');
        die();
      } 
      //
    }
    /**
     * [getSort description]
     * @return [type] [description]
     */
    public function getSort()
    {
      $util = Util::getInstance();
      $util->getSort($this->order_sort, $this->field_sort);      
    }   
    /**
      ***********************************************************************
    */  
    private function getCriteria(){
      $this->decodificaCriterio();
      
      $sql = $this->sql ." produto.produto_id =" . (int)$this->criterio ." ";
      $this->sql_count .= " produto.produto_id =" . (int)$this->criterio ." ";
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $query = $pdo->prepare($this->sql_count);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_BOTH);
    	//
      if($query->rowCount()>0){
        $num_rows = $result[0];
      }else{
        $num_rows = 1;
      }
    	//
      if($num_rows <= 0){
        $num_rows = 1;
      }
      //
      $this->pages = new App\Paginacao\Paginator($num_rows,9,array(6,3,6,9,12,25,50,100,250,'Tudo'));        
      $this->paginacao = $this->pages->display_pages() . ' ' . $this->pages->display_jump_menu().$this->pages->display_items_per_page() . ' Total Reg.: ' . $num_rows;  
      $sql .= ' ORDER BY ' . $this->field_sort . ' ' . $this->order_sort . ' LIMIT ' . $this->pages->limit_start . ',' . $this->pages->limit_end;
      //
      $this->num_rows = $num_rows;
      return $sql;
    }
    /**
     * [decodificaCriterio description]
     * @return [type] [description]
     */
    public function decodificaCriterio()
    {
      $util = Util::getInstance();
      $this->criterio = $util->decodificaCriterio();        
    }  
    /**
      ***********************************************************************
    */  
    public function insertDataIntoTable(){
      $op = array(
                  "E"=>array("valor"=>"ENTRADA", "cor"=>"#98d482"), 
                  "S"=>array("valor"=>"SAÍDA", "cor"=>"#90b9d2"),                
                  "ES"=>array("valor"=>"ESTORNO SAÍDA", "cor"=>"#ffeb9f"), 
                  "EE"=>array("valor"=>"ESTORNO ENTRADA", "cor"=>"#ffeb9f"), 
                  "P"=>array("valor"=>"PERDA", "cor"=>"#f17272"),
                  "C"=>array("valor"=>"CONSUMO", "cor"=>"#ff98e6"), 
                  "TE"=>array("valor"=>"TROCA ENTRADA", "cor"=>"#68a3c2"), 
                  "TS"=>array("valor"=>"TROCA SAÍDA", "cor"=>"#5cc790"),
                  );    
      //
      $COR = ' class="danger"';
      $cor = '';
      $flag=0;
      //    
      $this->estoque->produtoExiste($this->criterio);
      $pdo = $this->pdo->openDatabase();
      /**
       * DEFINO A PESQUISA
      */
      $sql = $this->getCriteria($this->criterio);
      $query = $pdo->prepare($sql);
      $query->execute();
      // 
      if($query->rowCount()==0){
        $util = Util::getInstance();
        return $util->createEmptyTable($this->criterio);
      }
      //
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      $this->produto_id = $rs['produto_id'];   
      $this->estoque_atual = number_format($this->estoque->getEstoqueAtual($rs['produto_id']),2,'.',',');
      $b  = '<div class="div-paginacao">Paginação : ' . $this->paginacao .'</div>';
      $b .='<div class="table-responsive">';
      $b .='<table class="table table-bordered table-hover table-striped">';    
      $b .= $this->createTheader();
      $b .='<tbody>';

      $rows = $query->rowCount();
      $cols = $query->columnCount();
      //
      $parameters = array();    
      //
      while ($rs = $query->fetch(PDO::FETCH_BOTH)) 
      {      
        for($i=0;$i<$cols;$i++)
        {
          $fld = $query->getColumnMeta($i);
          if($i==0){
            $flag = strtoupper($rs['critico']);
            //     
            if($flag!=0){
              $cor = $COR;
            }
            else{
              $cor = "";
            }
            //
            $b .= '<tr>';
            //
            if($rs[$fld['name']]<0){
              $ret = 'color:red;';
            }else{
              $ret='';
            }
            $b .= '<td nowrap style="text-align:right;' . $ret .'" >'. pintaTextoConsulta($rs[$fld['name']], $this->criterio).'</td>';
          }
          else{
            if(strtoupper($fld['name'])=="CRITICO")
            {
              $ret = $rs[$fld['name']] == "1" ? "SIM" : "NÃO";
              $b .='<td style="text-align:center;" ' . $cor .'>'. $ret .'</td>';
            }
            elseif(strtoupper($fld['name'])=="QUANT_ENTRADA"
                  || strtoupper($fld['name'])=="QUANT_SAIDA"
                  || strtoupper($fld['name'])=="ESTOQUE_ATU")
            {            
              if($rs[$fld['name']]<0){
                $ret = 'color:red;';
              }else{
                $ret='';
              }
              $b .= '<td nowrap style="text-align:right;' . $ret .'" >'. pintaTextoConsulta(number_format($rs[$fld['name']],2,'.',','), $this->criterio).'</td>';                      
            }
            elseif(strtoupper($fld['name'])=="NUMVENDA")
            {            
              $b .= '<td nowrap style="text-align:center;">'. pintaTextoConsulta($rs[$fld['name']], $this->criterio).'</td>';                      
            }
            elseif(strtoupper($fld['name'])=="PRODUTO_CODIGO_INTERNO")
            {            
              $b .= '<td nowrap style="text-align:center;">'. pintaTextoConsulta($rs[$fld['name']], $this->criterio).'</td>';                      
            }
            elseif(strtoupper($fld['name'])=="DATA_CADASTRO"){
              $dt = explode(' ', $rs[$fld['name']]);
              $d = implode("/",array_reverse(explode("-",$dt[0])));
              $b .='<td nowrap style="text-align:center">'. pintaTextoConsulta($d . ' ' . $dt[1], $this->criterio) .'</td>';            
            }                
            elseif(strtoupper($fld['name'])=="TIPO_OP")
            {            
              $b .= '<td nowrap style="text-align:center;font-weight: bold;background:' . $op[$rs['tipo_op']]['cor'] . ';">'. pintaTextoConsulta($op[$rs[$fld['name']]]['valor'], $this->criterio).'</td>';                      
            }
            elseif(strtoupper($fld['name'])=="ORIGEM")
            {
              $ret = utf8_decode($rs[$fld['name']]);
              if(strlen($ret)>14){
                $ret  = pintaTextoConsulta(substr($ret,0,20), $this->criterio) . '...';
                $str = base64_encode($rs[$fld['name']]); 
                $str = $this->security->encodeHex($str);
                $ret .= '<a href="javascript:myClass.showObs(\'' .$str . '\');void(0);"';
                $ret .= ' style="border: 1px solid;border-color: #aaaaaa;padding:4px;border-radius: 4px;">';
                $ret .= '<i class="fa fa-link" data-toggle="tooltip" data-placement="top" title="Leia o conteúdo completo"></i>';
                $ret .= '</a>';
              }else{
                $ret = pintaTextoConsulta($ret, $this->criterio);
              }
              $b .='<td nowrap>'. pintaTextoConsulta($ret, $this->criterio) .'</td>';
            }         
            else
            {
              if(strtoupper($fld['name'])!="PRODUTO_DESCRICAO"
                && strtoupper($fld['name'])!="PRODUTO_ID") {
                $b .='<td nowrap style="text-align: left;">'. pintaTextoConsulta($rs[$fld['name']], $this->criterio).'</td>';
              }          
            }    
          }
        }
        $b .= '</tr>';      
      }
      /**
       * GERA O THEAD
      */
      $b .= '</tbody>';
      $b .= '</table>';
      $b .='</div>';
      if(intval($this->num_rows,10)>=9){
        $b .= '<div class="div-paginacao">Paginação : ' . $this->paginacao .'</div>';
      }
      return ( $b);
    }
    /**
      ***********************************************************************
    */
    private function createTheader(){
      $t  = '<thead>';
      $t .= '  <tr>';
      #$t .= '      <th style="text-align: center;width:180px;">MENU</th>';
      $t .= $this->createSort('EST. INICIAL', 'estoque_inicial');
      $t .= $this->createSort('QT. ENTRADA', 'quant_entrada');
      $t .= $this->createSort('QT. SAÍDA', 'quant_saida');
      $t .= $this->createSort('EST. ATUAL', 'estoque_atu');
      $t .= $this->createSort('TIPO OP.', 'tipo_op');
      $t .= $this->createSort('ORIGEM', 'origem');
      #$t .= $this->createSort('PRODUTO', 'produto_descricao');    
      $t .= $this->createSort('USUÁRIO', 'usuario');
      $t .= $this->createSort('CRITICO?', 'critico');
      $t .= $this->createSort('NUM. VENDA', 'num_venda');
      $t .= $this->createSort('DT. OPERAÇÃO', 'data_cadastro');
      #$t .= $this->createSort('CÓD. PRODUTO', 'produto_id');
      $t .= $this->createSort('ID', 'id');
      $t .= '  </tr>';
      $t .= '</thead>';
      return $t;
    }
    /**
      ***********************************************************************
    */    
    private function createSort($caption, $campoTabela){    
      $parameters = $this->security->parameterGenerator(5);
      //
          
      if(strtoupper($this->field_sort) != strtoupper($campoTabela)){
        $icon = '';
        $ret  = 'ASC';
        $cor = '';
      }else{
        if(strtoupper($this->order_sort)=='ASC'){
          $ret = "DESC";
          $icon = '<i class="fa fa-fw fa-sort-alpha-asc"></i>';
          $cor = 'style="background:#5cb85c;color:#000;text-decoration:none;"';  
        }else{
          $ret = "ASC";
          $icon = '<i class="fa fa-fw fa-sort-alpha-desc"></i>';
          $cor = 'style="background:#337ab7;color:#000;text-decoration:none;"';
        }      
      }
      //
      $parameters['par5']= $ret;
      $parameters['par6']= $campoTabela;
      $parameter1 = $this->security->encodeTmpUrl($parameters);
      //VERIFICA SE TEMOS O PARÂMETRO FINDREG(PARAMETER1))
      $ret = explode('parameter1=', $_SERVER["REQUEST_URI"]);    
      if(count($ret)==2){
        $t = explode('&', $ret[1]);
        $tmp  = '?parameter1=' . $t[0] . '&page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
      }else{
        $tmp  = '?page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
      }
      //    
      $tmp .= '&sort=' . $this->security->encondeGET($parameter1);    
      //
      return '<th nowrap ' . $cor .'><a ' . $cor .' href="application/views/estoque/ajuste/' . $tmp . '">' . $caption . ' ' . $icon .'</a></th>';
    }
}