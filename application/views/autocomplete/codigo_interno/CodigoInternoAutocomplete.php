<?php
/**
 * @version    1.0
 * @package    Código interno
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class CodigoInternoAutocomplete
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
        $sql = "SELECT produto_codigo_interno AS codigo FROM produto ";
        //
        if ($this->criterio == '%') {
            $sql .= "WHERE TRUNCATE(produto_codigo_interno,0) LIKE '$this->criterio' ";
        } else {
            $sql .= "WHERE TRUNCATE(produto_codigo_interno,0) = '$this->criterio' ";
        }
        //
        $sql .= "ORDER BY produto_codigo_interno DESC LIMIT 1;";
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        if (!$query->rowCount()) {
            return "0";
        }
        //
        $tmp = [];
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            $tmp = explode('.', $rs['codigo']);
            echo $tmp[1];
        }
    }
}
