<?php
/**
 * @version    1.0
 * @package    produto produto
 * @subpackage Edição foto
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class FotoEdit{
    private $pdo;
    //
    public  $produto_descricao ='';
    public  $produto_grupo='';
    public  $produto_um='';
    public  $produto_foto='';
    public  $produto_id=0;
    public  $produto_codigo_interno='';
    public  $criterio;
    public  $security;

    /**
     * [__construct description]
     */
    public function __construct()
    {
      global $nivel;
      $this->pdo = ConnClass::getInstance();
      $this->security = Security::getInstance();
      $this->sid = Session::getInstance();
      $this->sid->start();
      //
      if(!$this->sid->check())
      {
        // Usuário não logado
        header( 'Location: ' . URL);      
      }
      //
      $this->garbageFiles($nivel . 'application/views/produto/produto/foto_edit/foto');
    }

    /**
     * [createLinkMenu description]
     * @return [type] [description]
     */
    public function createLinkMenu()
    {
      $t  ='<div class="row">';
      $t .='    <div class="col-lg-12">';
      $t .='        <h1 class="page-header">';
      $t .='          Foto Produto <small> - ' . $this->sid->getNode('procedencia_empresa') . '</small>';
      $t .='        </h1>';
      $t .='        <ol class="breadcrumb">';
      $t .='          <li>';
      $t .='              <i class="fa fa-home"></i> <a href="' . URL . '">Home</a>';
      $t .='          </li>';
      $t .='          <li class="active">';
      $t .='              <i class="fa fa-refresh"></i> <a href="' . $_SERVER["REQUEST_URI"] . '">Atualizar</a>';
      $t .='          </li>';
      //    
      $t .='          <li>';
      $t .='              <i class="fa fa-plus"></i> <a href="produto/">Cadastro Produto</a>';
      $t .='          </li>';
      //
      $t .='        </ol>';
      $t .='    </div>';
      $t .='</div>';
      return $t;
    }  
    /**
     * *****************************************************
     *                        GARBAGE
     * ***************************************************** 
    */  
    /**
     * REMOVE OS FICHEIROS QUE NÃO TEM NENHUM VÍNCULO COM O BANCO DE DADOS
     * GARBAGE
    */
    public function garbageFiles($path)
    {
      $i = 0;
      $ret = $this->find_all_files($path);//ENCONTRO OS ARQUIVOS NA REFEDIDA PASTA
      //
      if(!is_array($ret)){
        return $i;
      }
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }    
      //
      foreach($ret as $arquivo){
        $extensao = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));
        $file = strtolower(pathinfo($arquivo, PATHINFO_FILENAME));
        //
        if(strlen($extensao)==0){
          $filename = $file ;
        }else{
          $filename = $file.'.' . $extensao; 
        } 
        // VERIFICA SE ESTÁ GRAVADO NA BASE DE DADOS
        
        if($filename=='produto.png'){
           // 
        }else{
          $sql = "SELECT produto_id from produto WHERE produto_foto ='$filename';"; 
          $query = $pdo->prepare($sql);
          $query->execute();
          $rs = $query->fetch(PDO::FETCH_BOTH);
          //
          if($query->rowCount()==0){
            //SE NÃO ENCONTROU, EXCLUI OS ARQUIVOS ÓRFÃOS
            $r = @unlink( $arquivo );
            if($r){
              $i++;
            }
          }
        }
      }
      return $i;  
    }

    /**
     * [find_all_files description]
     * @param  [type]  $dir     [description]
     * @param  integer $showdir [description]
     * @return [type]           [description]
     */
    private function find_all_files($dir, $showdir=1)
    {
      $root = scandir($dir);
      $result = [];
      //     
      foreach($root as $value){ 
        if($value === '.' || $value === '..') {continue;}
        // 
        if(is_file("$dir/$value")){
          if($showdir==1){
            $result[]="$dir/$value";
          }else{
            $result[]="$value";
          }
          continue;
        }
        //
        foreach(find_all_files("$dir/$value") as $value) {
            $result[]=$value;              
        }
      } 
      return $result;
    }  

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
      if(!isset($_GET['parameter1'])){
        $this->criterio = $this->sid->getNode('user_id');
      }else{
        //DECODIFICA OS DADOS
        //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
        $parameter = $_GET['parameter1']; 
        $ret = explode('&', $this->security->decodeGET($parameter));
        $tmp = '';
        //
        //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
        foreach($ret as $key => $value){
          $v = explode('=', $value);      
          $tmp .= htmlspecialchars($this->security->decodeGET($v[1])) .'=';
          /**     ------------------------
                         ^
                         |
                         +--- EVITA MYSQL INJECTION
          */
        }    
        //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
        list($dummy1, $dummy2, $dummy3, 
             $this->criterio) = explode('=',$tmp);      
      }
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $sql  = "SELECT * FROM `produto` WHERE `produto_id`=" . $this->criterio;
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      if(!$rs){
        return 'ERROR_SELECT';
      }
      //
      $this->produto_descricao = $rs['produto_descricao'];    
      $this->produto_grupo  = $rs['produto_grupo'];
      $this->produto_um = $rs['produto_um'];
      $this->produto_foto = $rs['produto_foto'];
      $this->produto_id = $rs['produto_id'];
      $this->produto_codigo_interno = $rs['produto_codigo_interno'];
      return 'OK';
    }
}
