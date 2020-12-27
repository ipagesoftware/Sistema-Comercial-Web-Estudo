<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Fornecedor
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Utilities\Util;

class FornecedorView
{
    private $fornecedor_id;
    private $pdo;
    private $security;
    private $tabela = 'fornecedor';
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
        }
        //
        $Utilities        = Util::getInstance();
        $this->fornecedor_id = $Utilities->getValuesModal("Fornecedor");
        //
        if ($this->fornecedor_id) {
            $this->getReg();
        }
    }

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
        if ((int) $this->fornecedor_id == 0) {
            #return 'OK';
        }
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "SELECT * FROM `fornecedor` WHERE `fornecedor_id`=" . (int) $this->fornecedor_id;
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs   = $query->fetch(PDO::FETCH_BOTH);
        $cols = $query->columnCount();
        //
        for ($i = 0; $i < $cols; $i++) {
            /** EVITA QUE DETERMINADOS CAMPOS DA TABELA ENTRE NO CRITÉRIO DE BUSCA */
            $fld = $query->getColumnMeta($i);
            if ($fld['name'] == 'fornecedor_data_cadastro') {
                //
            } else {
                //
                if (!$rs || $query->rowCount() <= 0) {
                    if ($fld['name'] == 'fornecedor_status') {
                        $tmp = '1';
                    } else {
                        $tmp = '';
                    }
                } elseif ($fld['name'] == 'fornecedor_data_cadastro') {
                    $tmp = implode("/", array_reverse(explode("-", $rs['fornecedor_data_cadastro'])));
                } elseif ($fld['name'] == 'fornecedor_pessoa') {
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
