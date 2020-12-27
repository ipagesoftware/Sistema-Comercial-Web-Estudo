<?php
/**
 * @version    1.0
 * @package    Fabricante
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class FabricanteAutocomplete
{
    private $pdo;
    private $sid;
    private $security;
    private $criterio;

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
            $js = '<script>';
            $js .= 'window.parent.location.href="' . URL . '";';
            $js .= '</script>';
            die($js);
        }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        (!isset($_GET['q'])) ? $tmp = '%' : $tmp = $_GET['q'];
        $this->criterio                = strip_tags(trim($tmp));
        //
        return 'OK';
    }

    /**
     * [getDados description]
     * @return [type] [description]
     */
    public function getDados()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $criterio = fullTrimX(str_replace("'", "", $this->criterio));
        $sql      = "SELECT fabricante_descricao, fabricante_id FROM fabricante WHERE ";
        $sql .= "fabricante_descricao LIKE '" . $criterio . "%' ";
        $sql .= " ORDER BY fabricante_descricao;";
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        if (!$query->rowCount()) {
            return "NENHUM|0\n";
        }
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            echo utf8_decode($rs['fabricante_descricao'] . "|" . $rs['fabricante_id']) . "\n";
        }
    }
}
