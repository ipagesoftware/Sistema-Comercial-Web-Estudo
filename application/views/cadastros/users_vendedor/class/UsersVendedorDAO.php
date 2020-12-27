<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage usu�rios x Vendedor
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class UsersVendedorDAO
{
    private $pdo;
    private $usuario_id;
    private $vendedor_id;
    public $flag;
    
    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->pdo      = ConnClass::getInstance();
        $this->sid      = Session::getInstance();
        $this->security = Security::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!'); // Usu�rio n�o logado
        } elseif ((int) $this->sid->getNode('procedencia_id') == 0) {
            die('Imposs�vel continuar, proced�ncia n�o foi selecionada.');
        }
        //
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        $this->usuario_id  = $_POST['cbo_user'];
        $this->vendedor_id = $_POST['list2'];
        //
        return 'OK';
    }
    /**
     * [insertReg description]
     * @return [type] [description]
     */
    public function insertReg()
    {
        $pdo = $this->pdo->openDatabase();
        $pdo->beginTransaction(); /* Inicia a transa��o */
        /*
         * APAGO OS DADOS DA TABELA PARA A INSER��O DE NOVOS
         */
        $sql = "DELETE FROM users_vendedor WHERE `user_id` =" . $this->usuario_id;
        //CONSULTA DE EXECU��O
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        if (!$result) {
            $pdo->rollBack();
            return "ERROR";
        }
        //
        if (is_array($this->vendedor_id)) {
            foreach ($this->vendedor_id as $key) {
                $sql = "INSERT INTO ";
                $sql .= "users_vendedor(";
                $sql .= "user_id, ";
                $sql .= "vendedor_id, ";
                $sql .= "user_vendedor_data_cadastro";
                $sql .= ") ";
                $sql .= "VALUES(";
                $sql .= $this->usuario_id . ", ";
                $sql .= "'{$key}', ";
                $sql .= "'" . Date("Y-m-d H:i:s") . "')";
                //
                try {
                    $result = $pdo->query($sql);
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    return $e->getMessage();
                }
            }
        }
        //
        if (!$result) {
            $pdo->rollBack();
            return 'ERROR';
        }
        //
        $pdo->commit();
        //
        return 'OK_INSERT';
    }
}
