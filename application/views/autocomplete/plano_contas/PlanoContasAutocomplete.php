<?php
/**
 * @version    1.0
 * @package    Plano contas
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class PlanoContasAutocomplete
{
    private $contas_pagar_id;
    private $pdo;
    private $sid;
    private $security;
    private $criterio;
    private $natureza_operacao;

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
        if (isset($_GET['natureza_operacao'])) {
            $this->natureza_operacao = strip_tags(trim($_GET['natureza_operacao']));
        }
        //
        return 'OK';
    }

    /**
     * [getDados description]
     * @return [type] [description]
     */
    public function getDados()
    {
        $criterio = fullTrimX(str_replace("'", "", $this->criterio));
        $pdo      = $this->pdo->openDatabase();
        $sql      = "SELECT plano_contas_descricao, plano_contas_id FROM plano_contas WHERE ";
        $sql .= "plano_contas_descricao LIKE '%" . $criterio . "%' ";
        //
        if (isset($this->natureza_operacao)) {
            if ($this->natureza_operacao == "D") {
                $sql .= " AND plano_contas_natureza_operacao <> 'R' ";
            } else {
                $sql .= " AND plano_contas_natureza_operacao <> 'D' ";
            }
        }
        //
        $sql .= " AND procedencia_id = " . $this->sid->getNode('procedencia_id');
        $sql .= " AND plano_contas_status = 1 ";
        $sql .= " ORDER BY plano_contas_descricao;";
        $query = $pdo->prepare($sql);
        $query->execute();

        if (!$query->rowCount()) {
            return "NENHUM|0\n";
        }
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            echo utf8_decode($rs['plano_contas_descricao'] . "|" . $rs['plano_contas_id']) . "\n";
        }
    }
}
