<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class PermissoesSetDefault
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
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {        
        if(!isset($_POST['cbo_usuario'])){
              $json = array('id'=>'cbo_usuario',
                            'msg'=>utf8_encode('Usuário inválido, verifique!')
                            );
              return(json_encode($json));
        }
        //
        return 'OK';
    }

    /**
     * [setDefault description]
     * @param string $criterio [description]
     */
    public function setDefault($criterio = '')
    {
        if (strlen($criterio) == 0) {
            $criterio = (int)$_POST['cbo_usuario'];
        }
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "DELETE FROM _user_permissions WHERE `user_id`=" . $criterio . ";";
        //CONSULTA DE EXECUÇÃO
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        if (!$result) {
            return UNEXPECTED_ERROR;
        }
        /**
         * DEFINE A CONSULTA
         */
        $sql = "SELECT `user_login`, `user_nivel`, `user_id` FROM user WHERE ((`user_status`=1) AND (`user_id`)=" . $criterio . ");";
        $sql = str_ireplace('%%%', '%', $sql);
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$rs) {
            return UNEXPECTED_ERROR;
        }
        //
        $nivel = strtoupper(trim($rs['user_nivel']));
        //$col = $conn->MetaTables();// PEGO AS TABELAS DA BASE DE DADOS
        $sql   = "SHOW TABLES;";
        $query = $pdo->prepare($sql);
        $query->execute();
        #$count = $query->rowCount();
        //
        $excluir = 1;
        $editar  = 1;
        $negar   = 1;
        /*
         * INICIO O LOOP
         */
        while ($col = $query->fetch(PDO::FETCH_BOTH)) {
            switch ($nivel) {
                case 'A':
                    break;
                case 'O':
                    $excluir = 0;
                    break;
                default:
                    $editar  = 0;
                    $excluir = 0;
                    break;
            }
            /*
             * ENTRA A CONSULTA DE INSERÇÃO
             */
            $sql = "INSERT INTO `_user_permissions`(`user_id`, ";
            $sql .= "`table_name`, ";
            $sql .= "`inserir`, ";
            $sql .= "`editar`, ";
            $sql .= "`excluir`, ";
            $sql .= "`imprimir`, ";
            $sql .= "`negar`, ";
            $sql .= "`data_cadastro`) ";
            $sql .= "VALUES(";
            $sql .= "'" . (int) $criterio . "', ";
            $sql .= "'{$col[0]}', ";
            $sql .= "1, ";
            $sql .= "{$editar}, ";
            $sql .= "{$excluir}, ";
            $sql .= "1, ";
            $sql .= "{$negar}, ";
            $sql .= "'" . Date("Y-m-d H:i:s") . "' ";
            $sql .= ");";
            //CONSULTA DE EXECUÇÃO
            try {
                $result = $pdo->query($sql);
            } catch (PDOException $e) {
                return $e->getMessage();
            }
            //
            if (!$result) {
                return UNEXPECTED_ERROR;
            }
        }
        //
        return 'OK';
    }
}
