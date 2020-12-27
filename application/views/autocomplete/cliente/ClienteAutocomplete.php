<?php
/**
 * @version    1.0
 * @package    Cadastro Cliente
 * @subpackage autocomplete
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class ClienteAutocomplete
{
    private $recibo_id;
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
        
        if (empty($_GET['q'])) {
            $this->criterio = "%";
        } else {
            $this->criterio = strip_tags(trim($_GET['q']));
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
        $criterio = str_replace("'", "", $this->criterio);
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql   = "SELECT cliente_nome, cliente_id FROM cliente WHERE cliente_nome LIKE '%" . $criterio . "%' ORDER BY cliente_nome;";
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        if ($query->rowCount() == 0) {
            return "NENHUM|0\n";
        }
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            echo utf8_encode($rs['cliente_nome'] . "|" . $rs['cliente_id']) . "\n";
        }
    }
}
