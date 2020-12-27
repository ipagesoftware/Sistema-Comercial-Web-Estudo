<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage cadastro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;
use App\Utilities\Util;

class ProdutoView{
  private $produto_id;
  private $pdo;
  private $security;
  public  $permission = [];
  private $tabela = 'produto';
  public  $myfields = [];

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
      die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
    }
    //
    $cPermission = new UserPermission();    
    $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);
    //
    $Utilities = Util::getInstance();
    $this->produto_id = $Utilities->getValuesModal("Produto");
    //
    if($this->produto_id){
      $this->getReg();
    }    
  } 

  /**
   * [getReg description]
   * @return [type] [description]
   */
  public function getReg()
  {    
    $pdo = $this->pdo->openDatabase();
    //
    if(!$pdo){
        return 'Erro ao iniciar a conexão';
    } 
    //
    $sql  = "SELECT * FROM `produto` WHERE `produto_id`=" . (int)$this->produto_id;
    //
    $query = $pdo->prepare($sql);
    $query->execute();
    $rs = $query->fetch(PDO::FETCH_BOTH);
    $cols = $query->columnCount();
    //
    for($i=0;$i<$cols;$i++){
      $fld = $query->getColumnMeta($i);
      if($fld['name']=='produto_data_cadastro'){
        //
      }else{
        //
        if(!$rs || $query->rowCount()<=0){
          if($fld['name']=='produto_status'){
            $tmp = '1';
          }elseif($fld['name']=='produto_um'){
            $tmp='UN';
          }elseif($fld['name']=='produto_um_quant' 
                  || $fld['name']=='produto_emb_com' 
                  || $fld['name']=='produto_val_custo' 
                  || $fld['name']=='produto_margem_lucro' 
                  || $fld['name']=='produto_val_revenda' 
                  || $fld['name']=='produto_desconto'){
            $tmp='0.00';
          }else{
            $tmp = '';
          }
        }else{
          $tmp = utf8_decode($rs[$fld['name']]); 
        }
        //
        $this->myfields[$fld['name']] = $tmp;
      }
    }
    return 'OK';
  }  
}
