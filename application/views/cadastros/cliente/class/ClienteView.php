<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Cliente
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Utilities\Util;

class ClienteView
{
    private $cliente_id;
    private $pdo;
    private $security;
    private $tabela = 'cliente';
    //
    public $permission = [];
    public $myfields   = [];

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
            die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!');
        }
        //
        $Utilities        = Util::getInstance();
        $this->cliente_id = $Utilities->getValuesModal("Cliente");
        //
        if ($this->cliente_id) {
            $this->getReg();
        }
    }

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
        if ((int) $this->cliente_id == 0) {
            #return 'OK';
        }
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conex�o';
        }
        //
        $sql = "SELECT * FROM `cliente` WHERE `cliente_id`=" . (int) $this->cliente_id;
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs   = $query->fetch(PDO::FETCH_BOTH);
        $cols = $query->columnCount();
        //
        for ($i = 0; $i < $cols; $i++) {
            /** EVITA QUE DETERMINADOS CAMPOS DA TABELA ENTRE NO CRIT�RIO DE BUSCA */
            $fld = $query->getColumnMeta($i);
            if ($fld['name'] == 'cliente_data_cadastro') {
                //
            } else {
                //
                if (!$rs || $query->rowCount() <= 0) {
                    if ($fld['name'] == 'cliente_status') {
                        $tmp = '1';
                    } else {
                        $tmp = '';
                    }
                } elseif ($fld['name'] == 'cliente_data_cadastro') {
                    $tmp = implode("/", array_reverse(explode("-", $rs['cliente_data_cadastro'])));
                } elseif ($fld['name'] == 'cliente_pessoa') {
                    if ($rs[$fld['name']] == 'J') {
                        $tmp = "JUR�DICA";
                    } else {
                        $tmp = "F�SICA";
                    }
                } else {
                    $tmp = utf8_decode($rs[$fld['name']]);
                }
                //
                $this->myfields[$fld['name']] = $tmp;
            }
        }
        return 'OK';
    }
}
