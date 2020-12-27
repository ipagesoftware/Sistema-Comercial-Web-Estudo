<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Cliente
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;

//
class ClienteAddUpdt
{
    private $id;
    private $pdo;
    private $security;
    private $tabela = 'cliente';
    //
    public $permission = []; //É UM ARRAY
    public $myfields   = [];
    public $cliente_id = 0;

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
            header('Location: ' . SESSION_EXPIRED);
            exit();
        }
        //
        $ret = $this->getValues();
        //
        if ($ret == 'OK') {
            $this->getReg();
        }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        $parameter1       = ((isset($_GET['parameter1'])) ? $_GET['parameter1'] : null);
        $cPermission      = UserPermission::getInstance();
        $this->permission = $cPermission->verificaPermissoes($this->tabela,
            $this->sid->getNode('user_id'),
            $this->security,
            $parameter1);

        if ($parameter1) {
            // Decodifica os dados
            $tmp = $this->security->decodificarParametro($parameter1);
            // Passa os valores decompostos para as respectivas variáveis
            // Só esta aqui me interessa ----+
            // as demais são fictícias       |
            //                               v
            list($doomy1, $doomy2, $doomy3, $id) = explode('=', $tmp);
            $this->cliente_id                    = (int) $this->security->decodeGET($id);
        }
        //
        return 'OK';
    }

    /**
     * [getReg description]
     * @return [type] [description]
     */
    public function getReg()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
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
