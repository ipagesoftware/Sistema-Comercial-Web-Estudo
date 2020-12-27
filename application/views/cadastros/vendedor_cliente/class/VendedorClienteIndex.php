<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Vendedor x Cliente
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;

class VendedorClienteIndex
{
    private $pdo;
    private $security;
    public $permission = [];
    private $tabela    = 'vendedor_cliente';

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
            header('Location: ' . SESSION_EXPIRED);
            exit();
        }
        //
        $cPermission      = new UserPermission();
        $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);

        if (!$this->permission['negar'] or
            !$this->permission['inserir'] or
            !$this->permission['editar']) {
            $module = $this->security->encondeGET("Vendedor x Cliente");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
    }

    /**
     * [loadVendedorIntoComboBox description]
     * @return [type] [description]
     */
    public function loadVendedorIntoComboBox()
    {
        $t   = '<option value="0" selected="">*** NENHUM ***</option>';
        $pdo = $this->pdo->openDatabase();
        /**
         * DEFINE A CONSULTA
         */
        $sql = "SELECT vendedor_nome, vendedor_id FROM vendedor WHERE vendedor_status = 1 ";
        $sql .= "ORDER BY vendedor.vendedor_nome;";
        //
        $query = $pdo->prepare($sql);
        //
        try {
            $query->execute();
        } catch (PDOException $e) {
            $t .= '<option value="0">' . $e->getMessage() . '</option>';
        }
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            $t .= '<option value="' . $rs['vendedor_id'] . '">' . $rs['vendedor_nome'] . '</option>';
        }
        //
        return $t; //CONDIÇÃO QUE INDICA ERRO
    }
}
