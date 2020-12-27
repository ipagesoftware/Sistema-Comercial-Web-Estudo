<?php
/**
 * @version    1.0
 * @package    produto cadastro
 * @subpackage fabricante
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
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
        die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!');// Usu�rio n�o logado
      }elseif( (int)$this->sid->getNode('procedencia_id')==0){
        die('Imposs�vel continuar, proced�ncia n�o foi selecionada.');            
      }
      //
      $cPermission = new UserPermission();   
      $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), 'plano_contas'), true);
      //
      if($this->permission['negar']!=1){
        echo('<p style="text-align: justify;">Usu�rio sem permiss�o para acessar a p�gina do m�dulo: <strong>PLANO CONTAS</strong>.</p>');
        echo('<p>Para maiores informa��es, contacte o usu�rio administrador.<br />');
        echo(FONE_ATENDIMENTO . ' / ' . EMAIL_ATENDIMENTO . '</p>');
        die();
      }elseif($this->permission['inserir']!=1){
        echo('<p style="text-align: justify;">Usu�rio sem permiss�o para inserir registro no m�dulo: <strong>PLANO CONTAS</strong>.</p>');
        echo('<p>Para maiores informa��es, contacte o usu�rio administrador.<br />');
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
                        'P'=>'P�BLICO');
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
