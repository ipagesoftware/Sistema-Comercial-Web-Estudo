<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Vendedor
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Utilities\Util;

class VendedorView
{
    private $vendedor_id;
    private $pdo;
    private $security;
    private $tabela = 'vendedor';
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
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
            exit();
        }
        //
        $Utilities        = Util::getInstance();
        $this->vendedor_id = $Utilities->getValuesModal("Vendedor");
        //
        if ($this->vendedor_id) {
            $this->getReg();
        }
    }

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
        if ((int) $this->vendedor_id == 0) {
            #return 'OK';
        }
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "SELECT * FROM `vendedor` WHERE `vendedor_id`=" . (int) $this->vendedor_id;
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs   = $query->fetch(PDO::FETCH_BOTH);
        $cols = $query->columnCount();
        //
        for ($i = 0; $i < $cols; $i++) {
            /** EVITA QUE DETERMINADOS CAMPOS DA TABELA ENTRE NO CRITÉRIO DE BUSCA */
            $fld = $query->getColumnMeta($i);
            if ($fld['name'] == 'vendedor_data_cadastro') {
                //
            } else {
                //
                if (!$rs || $query->rowCount() <= 0) {
                    if ($fld['name'] == 'vendedor_status') {
                        $tmp = '1';
                    } else {
                        $tmp = '';
                    }
                } elseif ($fld['name'] == 'vendedor_data_cadastro') {
                    $tmp = implode("/", array_reverse(explode("-", $rs['vendedor_data_cadastro'])));
                } elseif ($fld['name'] == 'vendedor_pessoa') {
                    if ($rs[$fld['name']] == 'J') {
                        $tmp = "JURÍDICA";
                    } else {
                        $tmp = "FÍSICA";
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
