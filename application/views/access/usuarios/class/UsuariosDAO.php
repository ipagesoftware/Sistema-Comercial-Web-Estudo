<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Usuários
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Conexao\ConnClass;

class UsuariosDAO
{
    private $pdo;
    public $flag;
    
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
             die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
    }
    
    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        if(!isset($_POST['user_login'])){
              $json = array('id'=>'user_login',
                            'msg'=>utf8_encode('Nome inválido, verifique!')
                            );
              return(json_encode($json));
        }else if(!isset($_POST['user_nivel'])){
              $json = array('id'=>'user_nivel',
                            'msg'=>utf8_encode('Nível do usuário inválido, verifique!')
                            );
              return(json_encode($json));             
        }else if(!isset($_POST['user_email'])){
              $json = array('id'=>'user_email',
                            'msg'=>utf8_encode('Email inválido, verifique!')
                            );
              return(json_encode($json));
        }
        //
        $this->flag = intval($_POST['user_id']);
        //
        if (apenasLetras($_POST['user_login']) == 0) {
              $json = array('id'=>'user_login',
                            'msg'=>utf8_encode('Nome inválido, verifique!')
                            );
              return(json_encode($json));
        }
        // Verifica se o nome do usuário é repetido
        $ret = $this->duplicidadeUserLogin($this->flag);

        if ($ret) {
              $json = array('id'=>'user_login',
                            'msg'=>utf8_encode($ret)
                            );
              return(json_encode($json));
        }
        //VERIFICA SE A SENHA É VÁLIDA
        if ($this->flag == 0) {
            if (strlen($_POST['user_password']) < 6) {
              $json = array('id'=>'user_password',
                            'msg'=>utf8_encode('Senha com menos de 6 caracateres, verifique!')
                            );
              return(json_encode($json));
            }
        }
        //    
        $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL); //REMOVE OS CARACTERES ILEGAIS DO EMAIL
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
              $json = array('id'=>'user_email',
                            'msg'=>utf8_encode('Email inválido, verifique!')
                            );
              return(json_encode($json));
        }
        // Verifica se o email do usuário é repetido
        $ret = $this->duplicidadeUserEmail($this->flag);

        if($ret){
          $json = array('id'=>'user_email',
                        'msg'=>utf8_encode($ret)
                        );
          return(json_encode($json));
        }

        if (strlen($_POST['token'])) {
              $json = array('id'=>'user_login',
                            'msg'=>utf8_encode(ROBOT)
                            );
              return(json_encode($json));
        }
        // Destrói o valor do token
        unset($_POST['token']); 
        return 'OK';
    }
    
    /**
     * [duplicidadeUserLogin description]
     * @param  [type] $flag [description]
     * @return [type]       [description]
     */
    public function duplicidadeUserLogin($flag)
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if ($flag == 0) {
            $sql = "SELECT user_id FROM user WHERE user_login='" . utf8_decode($_POST['user_login']) . "'";
        } else {
            $sql  = "SELECT ";
            $sql .= "user_id FROM user ";
            $sql .= "WHERE user_login='" . utf8_decode($_POST['user_login']) . "' ";
            $sql .= "AND user_id <> {$_POST['user_id']}";
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['user_login'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['user_id']} ), ";
            $ret .= "tente outro valor!</p>";
            return $ret;
        }
    }
    
    /**
     * [duplicidadeUserEmail description]
     * @param  [type] $flag [description]
     * @return [type]       [description]
     */
    public function duplicidadeUserEmail($flag)
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if ($flag == 0) {
            $sql = "SELECT user_id FROM user WHERE user_email='{$_POST['user_email']}'";
        } else {
            $sql = "SELECT user_id FROM user WHERE user_email='{$_POST['user_email']}' ";
            $sql .= "AND user_id <> {$_POST['user_id']}";
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Email(" . $_POST['user_email'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['user_id']} ), ";
            $ret .= "tente outro valor!</p>";
            return $ret;
        }
    }
    
    /**
     * [insertReg description]
     * @return [type] [description]
     */
    public function insertReg()
    {
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /*
         * ENTRA A CONSULTA DE INSERÇÃO
         */
        $sql = "INSERT INTO `user`(";
        $sql .= "`user_login`, ";
        $sql .= "`user_password`, ";
        $sql .= "`user_nivel`, ";
        $sql .= "`user_email`, ";
        $sql .= "`user_status`,";
        $sql .= "`user_data_cadastro`) ";
        $sql .= "VALUES(";
        $sql .= "'" . ucwords(strtolower(utf8_encode(addslashes(strip_tags(($_POST['user_login'])))))) . "', ";
        $sql .= "'" . encrypt($_POST['user_password']) . "', ";
        $sql .= "'" . strip_tags($_POST['user_nivel']) . "', ";
        $sql .= "'" . strtolower(strip_tags($_POST['user_email'])) . "', ";
        $sql .= "'" . (int) $_POST['user_status'] . "', ";
        $sql .= "'" . Date("Y-m-d H:i:s") . "'";
        $sql .= ");";
        //
        //
        try {
            $result = $pdo->query($sql);
        }
        catch (PDOException $e) {
            $pdo->rollBack();
            return $e->getMessage();
        }
        //
        $last_id = $pdo->lastInsertId(); //PEGO O ID GERADO NA INSERÇÃO
        //
        if (!$result) {
            return 'ERROR';
        }
        //
        return $this->setDefault($pdo, $last_id);
    }
    
    /**
     * [updtReg description]
     * @return [type] [description]
     */
    public function updtReg()
    {
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /*
         * ENTRA A CONSULTA DE INSERÇÃO
         */
        $sql = "UPDATE `user` SET ";
        $sql .= "`user_login` = '" . ucwords(strtolower(utf8_encode(addslashes(strip_tags(($_POST['user_login'])))))) . "', ";
        //
        if (strlen(trim($_POST['user_password'])) > 0) {
            $sql .= "`user_password` = '" . encrypt($_POST['user_password']) . "', ";
        }
        //
        $sql .= "`user_nivel` = '{$_POST['user_nivel']}', ";
        $sql .= "`user_email` = '" . strtolower($_POST['user_email']) . "', ";
        $sql .= "`user_status` = '{$_POST['user_status']}' ";
        $sql .= "WHERE user_id = {$_POST['user_id']}";
        //
        try {
            $result = $pdo->query($sql);
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        if (!$result) {
            return UNEXPECTED_ERROR;
        }
        //
        return 'OK';
    }
    
    /**
     * [setDefault description]
     * @param [type] $pdo      [description]
     * @param string $criterio [description]
     */
    public function setDefault($pdo = null, $criterio = '')
    {
        if (is_null($pdo)) {
            $pdo = $this->pdo->openDatabase();
            //
            if (!$pdo) {
                return 'Erro ao iniciar a conexão';
            }
        }
        //
        if (strlen($criterio) == 0) {
            return UNEXPECTED_ERROR;
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
        }
        catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        if (!$result) {
            return UNEXPECTED_ERROR;
        }
        /**
         * DEFINE A CONSULTA
         */
        $sql   = "SELECT `user_login`, `user_nivel`, `user_id` FROM `user` WHERE ((`user_status`=1) AND (`user_id`)=" . $criterio . ");";
        $sql   = str_ireplace('%%%', '%', $sql);
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
            $sql .= "'$col[0]', ";
            $sql .= "1, ";
            $sql .= "$editar, ";
            $sql .= "$excluir, ";
            $sql .= "1, ";
            $sql .= "$negar, ";
            $sql .= "'" . Date("Y-m-d H:i:s") . "' ";
            $sql .= ");";
            //CONSULTA DE EXECUÇÃO  
            try {
                $result = $pdo->query($sql);
            }
            catch (PDOException $e) {
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