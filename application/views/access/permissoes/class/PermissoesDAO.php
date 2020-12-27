<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class PermissoesDAO
{
    private $pdo;
    private $nivel;
    private $inserir;
    private $editar;
    private $excluir;
    private $imprimir;
    private $negar;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->pdo      = ConnClass::getInstance();
        $this->security = Security::getInstance();
        $this->sid      = Session::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            // Usuário não logado
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        // Realiza a segunda decomposição dos dados
        unset($_POST['token']);
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);
        }
        //
        if(!isset($_POST['cbo_usuario'])){
              $json = array('id'=>'cbo_usuario',
                            'msg'=>utf8_encode('Usuário inválido, verifique!')
                            );
              return(json_encode($json));
        }
        else if(!isset($_POST['list_tabela'])){
              $json = array('id'=>'list_tabela',
                            'msg'=>utf8_encode('Definição do nome da tabela inválido, verifique!')
                            );
              return(json_encode($json));
        }

        if(!isset($_POST['chk_inserir'])){
            $this->inserir = 0;
        }else{
            $this->inserir = 1;
        }

        if(!isset($_POST['chk_editar'])){
            $this->editar = 0;
        }else{
            $this->editar = 1;
        }

        if(!isset($_POST['chk_excluir'])){
            $this->excluir = 0;
        }else{
            $this->excluir = 1;
        }

        if(!isset($_POST['chk_imprimir'])){
            $this->imprimir = 0;
        }else{
            $this->imprimir = 1;
        }

        if(!isset($_POST['chk_negar'])){
            $this->negar = 0;
        }else{
            $this->negar = 1;
        }        
        //
        return 'OK';
    }

    /**
     * [saveReg description]
     * @return [type] [description]
     */
    public function saveReg()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $pdo->beginTransaction();
        // Verifica se o registro existe
        $sql = "UPDATE `_user_permissions` SET ";
        $sql .= "`table_name` = '" . strip_tags($_POST['list_tabela']) . "', ";
        $sql .= "`inserir` = " . (int) $this->inserir . ", ";
        $sql .= "`editar` = " . (int) $this->editar . ", ";
        $sql .= "`excluir` = " . (int) $this->excluir . ", ";
        $sql .= "`imprimir` = " . (int) $this->imprimir . ", ";
        $sql .= "`negar` = " . (int) $this->negar . ", ";
        $sql .= "`data_cadastro` = '" . Date("Y-m-d H:i:s") . "' ";
        $sql .= "WHERE ((`user_id` = " . (int) $_POST['cbo_usuario'] . ') ';
        $sql .= "AND (`table_name` = '" . strip_tags($_POST['list_tabela']) . "'));";
        //
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            $pdo->rollBack();
            return $e->getMessage();
        }
        //
        if ($result) {
            if ($result->rowCount() <= 0) {
                $sql = "INSERT INTO `_user_permissions`(`user_id`, ";
                $sql .= "`table_name`, ";
                $sql .= "`inserir`, ";
                $sql .= "`editar`, ";
                $sql .= "`excluir`, ";
                $sql .= "`imprimir`, ";
                $sql .= "`negar`, ";
                $sql .= "`data_cadastro`) ";
                $sql .= "VALUES(";
                $sql .= "'" . (int)$_POST['cbo_usuario'] . "', ";
                $sql .= "'" . strip_tags($_POST['list_tabela']) . "', ";
                $sql .= "" . (int) $this->inserir . ", ";
                $sql .= "" . (int) $this->editar . ", ";
                $sql .= "" . (int) $this->excluir . ", ";
                $sql .= "" . (int) $this->imprimir . ", ";
                $sql .= "" . (int) $this->negar . ", ";
                $sql .= "'" . Date("Y-m-d H:i:s") . "' ";
                $sql .= ");";
                //
                try {
                    $result = $pdo->query($sql);
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    return $e->getMessage();
                }
            }
        } else {
            $pdo->rollBack();
            return UNEXPECTED_ERROR;
        }
        //
        $pdo->commit();
        return 'OK';
    }
}
