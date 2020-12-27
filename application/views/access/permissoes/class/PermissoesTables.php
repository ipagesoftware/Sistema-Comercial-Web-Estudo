<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;
class PermissoesTables
{
    private $pdo;
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
            // Usuário não logado
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
    }
    /**
     * [showTables description]
     * @return [type] [description]
     */
    public function showTables()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //    
        $query = $pdo->prepare("SHOW TABLES;");
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        $data = [];
        while ($rs = $query->fetch(PDO::FETCH_BOTH)){
            $ret = substr($rs[0], 0, 2);
            if ($ret != '_') {
                $data[] = ['descricao'=>$rs[0], 'id'=>(sizeof($data)+1)];
            }
        }
        //
        if (sizeof($data) > 0) {
            return json_encode($data);
        } else {
            return '[{"retorno": "Nenhum registro foi encontrado com o(s) dado(s) informado(s)!"}]';
        }
        return 'OK';
    }
}