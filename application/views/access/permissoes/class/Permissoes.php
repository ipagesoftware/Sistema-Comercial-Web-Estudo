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

class Permissoes
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
        // Realiza a segunda decomposição dos dados
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);
        }
        //
        if(!isset($_POST['user_id'])){
              $json = array('id'=>'cbo_usuario',
                            'msg'=>utf8_encode('Usuário inválido, verifique!')
                            );
              return(json_encode($json));
        }
        else if(!isset($_POST['tabela'])){
              $json = array('id'=>'list_tabela',
                            'msg'=>utf8_encode('Definição do nome da tabela inválido, verifique!')
                            );
              return(json_encode($json));
        }
        //
        return 'OK';
    }

    /**
     * [showPermission description]
     * @param  integer $pUsuarioId [description]
     * @param  string  $pTableName [description]
     * @return [type]              [description]
     */
    public function showPermission($pUsuarioId = 0, $pTableName = '')
    {
        if ($pUsuarioId == 0) {
            $pUsuarioId = $_POST['user_id'];
        }

        if ($pTableName == '') {
            $pTableName = $_POST['tabela'];
        }
        //
        $sql = "SELECT * FROM `_user_permissions` WHERE `user_id` = $pUsuarioId AND `table_name` ='$pTableName';";
        $pdo = $this->pdo->openDatabase();
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        // Verifica se tem dados, se a consulta retornou algum registro
        //
        if ($query->rowCount()) {
            $json  = '[{"inserir": "' . $rs['inserir'] . '"},';
            $json .= '{"editar": "' . $rs['editar'] . '"},';
            $json .= '{"excluir": "' . $rs['excluir'] . '"},';
            $json .= '{"imprimir": "' . $rs['imprimir'] . '"},';
            $json .= '{"negar": "' . $rs['negar'] . '"}';
            $json .= ']';
        } else {
            $json  = '[{"inserir": "0"},';
            $json .= '{"editar": "0"},';
            $json .= '{"excluir": "0"},';
            $json .= '{"imprimir": "0"},';
            $json .= '{"negar": "0"}';
            $json .= ']';
        }
        //
        return $json;
    }
}
