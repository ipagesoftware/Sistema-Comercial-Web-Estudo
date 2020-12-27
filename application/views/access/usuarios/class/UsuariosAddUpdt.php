<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Usuários
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;

class UsuariosAddUpdt
{
    private $id;
    private $pdo;
    private $security;
    private $permission = [];
    //
    public $user_login    = '';
    public $user_password = '';
    public $user_nivel    = 'A';
    public $user_email    = '';
    public $user_status   = 1;
    public $user_id       = 0;
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
            // Usuário não logado
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
        //
        $cPermission      = new UserPermission();
        $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), '_user_permissions'), true);
        //
        if ($this->permission['negar'] != 1) {
            $module = $this->security->encondeGET("Cadastro Usuário");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
    }
    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        $module = $this->security->encondeGET("Usuários");
        $r      = $this->security->encondeGET(rand(1000, 5000));

        if (!isset($_GET['parameter1'])) {
            if ($this->permission['inserir'] != 1 || $this->permission['negar'] != 1) {
                header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
                exit();
            } else {
                return "OK";
            }
        }
        // Decodifica os dados
        $tmp = $this->security->decodificarParametro($_GET['parameter1']);
        // Passa os valores decompostos para as respectivas variáveis
        // Só esta aqui me interessa ----+
        // as demais são fictícias       |
        //                               v
        list($doomy1, $doomy2, $doomy3, $id) = explode('=', $tmp);
        $this->user_id = (int) $this->security->decodeGET($id);
        //
        if ($this->permission['editar'] != 1 || $this->permission['negar'] != 1) {
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            exit();
        }
        return 'OK';
    }
    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "SELECT * FROM user WHERE `user_id`=" . $this->user_id;
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$rs) {
            return 'ERROR';
        }
        //
        if (!$rs) {
            return 'ERROR_SELECT';
        }
        //
        $this->user_login    = $rs['user_login'];
        $this->user_password = '';
        $this->user_nivel    = $rs['user_nivel'];
        $this->user_email    = strtolower($rs['user_email']);
        $this->user_status   = $rs['user_status'];
        return 'OK';
    }
}
