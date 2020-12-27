<?php
/**
 * @version    1.0
 * @package    Seguranca
 * @subpackage Permissões do usuário
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
namespace App\Seguranca;

use App\Conexao\ConnClass;
use \PDO;
use \stdClass;

class UserPermission
{
    private $pdo;
    private $user_id;
    private $tabela;
    private $inserir;
    private $editar;
    private $excluir;
    private $imprimir;
    private $negar;
    private static $instance;
    //
    public function __construct()
    {
        $this->pdo = ConnClass::getInstance();
    }

    /**
     * [getPostValues description]
     * @return void
     */
    public function getPostValues()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user_id = intval($_POST['user_id'], 10);
            $this->tabela  = htmlspecialchars($this->formatField($_POST['tabela']));
        } else {
            $this->user_id = intval($_GET['user_id'], 10);
            $this->tabela  = htmlspecialchars($_GET['tabela']);
        }
    }

    /**
     * [showPermission description]
     * @param  integer $pUsuarioId [description]
     * @param  string  $pTableName [description]
     * @return [type]              [description]
     */
    public function showPermission($pUsuarioId = 0, $pTableName = '')
    {
        if ($pUsuarioId == 0) {
            $pUsuarioId = $this->user_id;
        }
        //
        if ($pTableName == '') {
            $pTableName = $this->tabela;
        }
        //
        $sql = "SELECT";
        $sql .= " * ";
        $sql .= "FROM ";
        $sql .= "_user_permissions ";
        $sql .= "WHERE ";
        $sql .= "user_id = '{$pUsuarioId}' ";
        $sql .= "AND ";
        $sql .= "table_name ='{$pTableName}';";

        /* Abre a conexão */
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            die('Erro ao iniciar a conexão');
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$rs) {
            return 'ERROR';
        }
        // Verifica se tem dados, se a consulta retornou algum registro
        if ($query->rowCount()) {
            $json = json_encode($rs);
        } else {
            //
            // Não encontrou os dados relacionados a
            // permissões do usuário.
            // Nesta caso ele cria um json com todos os
            // valores zerados
            //
            $std           = new stdClass();
            $std->inserir  = 0;
            $std->editar   = 0;
            $std->excluir  = 0;
            $std->imprimir = 0;
            $std->negar    = 0;
            $json          = json_encode($std);
        }
        //
        return $json;
    }
    /**
     *************************************************************************
     */
    public function showPermissionX($pUsuarioId = 0, $pTableName = '')
    {
        //
        if ($pUsuarioId == 0) {
            $pUsuarioId = $this->user_id;
        }
        //
        if ($pTableName == '') {
            $pTableName = $this->tabela;
        }
        //
        $sql = "SELECT * FROM _user_permissions WHERE user_id = $pUsuarioId AND table_name ='$pTableName';";
        /* ABRO A CONEXÃO */
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            die('Erro ao iniciar a conexão');
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$rs) {
            return 'ERROR';
        }
        //VERIFICA SE TEM DADOS, SE A CONSULTA RETORNOU ALGUM REGISTRO
        if ($query->rowCount() > 0) {
            $json['inserir']  = $rs['inserir'];
            $json['editar']   = $rs['editar'];
            $json['excluir']  = $rs['excluir'];
            $json['imprimir'] = $rs['imprimir'];
            $json['negar']    = $rs['negar'];
        } else {
            $json['inserir']  = 0;
            $json['editar']   = 0;
            $json['excluir']  = 0;
            $json['imprimir'] = 0;
            $json['negar']    = 0;
        }
        //
        return $json;
    }

    /**
     * [verificaPermissoes description]
     * @param  [type] $tabela   [description]
     * @param  [type] $user_id  [description]
     * @param  [type] $security [description]
     * @param  [type] $id       [description]
     * @return [type]           [description]
     */
    public function verificaPermissoes($tabela, $user_id, $security, $id = null)
    {
        $permission = json_decode($this->showPermission($user_id, $tabela), true);
        $module     = $security->encondeGET($tabela);
        $r          = $security->encondeGET(rand(1000, 5000));
        //
        if ($id) {
            if (!$permission['negar'] or !$permission['editar']) {
                header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
                exit();
            }
        } else {
            if (!$permission['negar'] or !$permission['inserir']) {
                header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
                exit();
            }
        }
        return $permission;
    }
    /**
     * [getInstance description]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
