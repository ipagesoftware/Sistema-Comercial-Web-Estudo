<?php
/**
 * @version    1.0
 * @package    Unidade de medida
 * @subpackage autocomplite
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */

use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class UmAutocomplete
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
        $criterio = fullTrimX(str_replace("'", "", $this->criterio));
        $pdo      = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "SELECT um_sigla, um_id FROM um WHERE ";
        $sql .= "um_sigla LIKE '" . trim($criterio) . "%' ";
        $sql .= " ORDER BY um_sigla;";
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        if (!$query->rowCount()) {
            return "NENHUM|0\n";
        }
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            echo utf8_decode($rs['um_sigla'] . "|" . $rs['um_id']) . "\n";
        }
    }
}
