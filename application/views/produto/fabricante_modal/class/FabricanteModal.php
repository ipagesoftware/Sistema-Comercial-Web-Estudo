<?php
/**
 * @version    1.0
 * @package    produto cadastro
 * @subpackage fabricante
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class FabricanteModal
{
    private $id;
    private $pdo;
    private $permission = [];

    public  $fabricante_descricao;
    public  $fabricante_natureza_operacao;
    public  $fabricante_tipo;
    public  $fabricante_status=1;  
    public  $fabricante_id=0;
    public  $cbo_natureza_op;
    public  $cbo_tipo_op;

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
        die('Sua sessão expirou, será necessário logar-se no sistema novamente!');// Usuário não logado
      }elseif( (int)$this->sid->getNode('procedencia_id')==0){
        die('Impossível continuar, procedência não foi selecionada.');            
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
    }  

    /**
     * [loadregIntoComboBox description]
     * @return [type] [description]
     */
    public function loadregIntoComboBox()
    {
      $this->cbo_natureza_op = $this->loadNaturezaOpComboBox();
      $this->cbo_tipo_op = $this->loadTipoOpComboBox();
    }

    /**
     * [loadNaturezaOpComboBox description]
     * @return [type] [description]
     */
    private function loadNaturezaOpComboBox()
    {
      //
      $natureza = array(
                        'P'=>'PAGAR',
                        'A'=>'AMBOS'
                        );
      $t = '';
      //
      foreach($natureza as $value =>$key){
        if(strcmp($this->fabricante_natureza_operacao,$value)==0){
          $t .='<option value="' . $value . '" selected="">' . $key . '</option>';  
        }else{
          $t .='<option value="' . $value . '">' . $key . '</option>';
        }
      }       
      //
      return $t;     
    }

    /**
     * [loadTipoOpComboBox description]
     * @return [type] [description]
     */
    private function loadTipoOpComboBox()
    {
      //
      $natureza = array('R'=>'RESTRITO',
                        'P'=>'PÚBLICO');
      $t = '';
      //
      foreach($natureza as $value =>$key){
        if(strcmp($this->fabricante_tipo,$value)==0){
          $t .='<option value="' . $value . '" selected="">' . $key . '</option>';  
        }else{
          $t .='<option value="' . $value . '">' . $key . '</option>';
        }
      }       
      //
      return $t;     
    }
}
