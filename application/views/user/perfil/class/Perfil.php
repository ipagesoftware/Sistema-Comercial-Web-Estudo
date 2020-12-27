<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Perfil
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;

class Perfil
{
    private $pdo;
    public  $user_login ='';
    public  $user_nivel='A';
    public  $user_email='';
    public  $user_foto='';
    public  $criterio;
    public  $security;

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
        header('Location: ' . SESSION_EXPIRED);
      }
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
      $t .='          Perfil Usuário <small> - ' . $this->sid->getNode('procedencia_empresa') . '</small>';
      $t .='        </h1>';
      $t .='        <ol class="breadcrumb">';
      $t .='          <li>';
      $t .='              <i class="fa fa-home"></i> <a href="' . URL . '">Home</a>';
      $t .='          </li>';
      $t .='          <li class="active">';
      $t .='              <i class="fa fa-refresh"></i> <a href="application/views/user/perfil/">Atualizar</a>';
      $t .='          </li>';
      
      $t .='          <li>';
      $t .='              <i class="fa fa-user-md"></i> <a href="application/views/user/redefinir_senha/">Redefinir Senha</a>';
      $t .='          </li>';
      //    
      if($this->sid->getNode('user_nivel')=='A'){
        $t .='          <li>';
        $t .='              <i class="fa fa-user-plus"></i> <a href="usuarios/">Cadastro Usuário</a>';
        $t .='          </li>';
      }
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
        
        if($filename=='foto.png' ||
           $filename=='admin@admin.com.jpg'){
           // 
        }else{
          $sql = "select user_id from user where user_foto ='$filename';"; 
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
    private function find_all_files($dir, $showdir=1){     
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
    public function getReg(){
      if(!isset($_GET['parameter1'])){
        $this->criterio = $this->sid->getNode('user_id');
      }else{
        // Decodifica os dados
        $tmp = $this->security->decodificarParametro($_GET['parameter1']);
        // Passa os valores decompostos para as respectivas variáveis
        // Só esta aqui me interessa ----+
        // as demais são fictícias       |
        //                               v
        list($doomy1, $doomy2, $doomy3, $criterio) = explode('=',$tmp);
        $this->criterio = $this->security->decodeGET($criterio);
      }
      //
      $pdo = $this->pdo->openDatabase();
      //
      if(!$pdo){
          return 'Erro ao iniciar a conexão';
      }
      //
      $sql  = "SELECT * FROM `user` WHERE `user_id`=" . $this->criterio;
      //
      $query = $pdo->prepare($sql);
      $query->execute();
      $rs = $query->fetch(PDO::FETCH_BOTH);
      //
      if(!$rs){
        return 'ERROR_SELECT';
      }
      //
      $this->user_login = $rs['user_login'];
      
      if(strtoupper($rs['user_nivel'])!='A'){
        $this->user_nivel = 'Padrão';
      }else{
        $this->user_nivel = 'Administrador';
      }
      //
      $this->user_email = strtolower($rs['user_email']);
      $this->user_foto = $rs['user_foto'];
      return 'OK';
    }   
}