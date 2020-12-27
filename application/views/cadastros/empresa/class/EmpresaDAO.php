<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Empresa
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class EmpresaDAO
{
    private $pdo;
    public $flag;
    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct()
    {
        $this->pdo      = ConnClass::getInstance();
        $this->sid      = Session::getInstance();
        $this->security = Security::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!'); // Usuário não logado
        }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        $this->flag = intval($_POST['empresa_id'], 10);
        //
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);

            switch ($key) {
                case 'empresa_nome':
                    $ret = $this->duplicidadeNome($this->flag);
                    if($ret){
                      $json = array('id'=>$key,
                                    'msg'=>utf8_encode($ret)
                                    );
                        return(json_encode($json));
                    }
                case 'empresa_email':
                    // Remove os caracteres ilegais do email
                    $email = filter_var($_POST['empresa_email'], FILTER_SANITIZE_EMAIL);
                    //
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                      $json = array('id'=>'empresa_email',
                                    'msg'=>utf8_encode('Email inválido, verifique!')
                                    );
                      return(json_encode($json));
                    }
                    // Verifica se o email é repetido
                    $ret = $this->duplicidadeEmail($this->flag);

                    if($ret){
                      $json = array('id'=>'empresa_email',
                                    'msg'=>utf8_encode($ret)
                                    );
                      return json_encode($json);
                    }
                case 'empresa_cep':
                case 'empresa_endereco':
                case 'empresa_bairro':
                case 'empresa_cidade':
                case 'empresa_uf':
                    if(!strlen($_POST[$key])){
                        $tmp  = "Campo inválido ou inexistente, verifique!";
                        $json = array('id'=>$key,
                                    'msg'=>utf8_encode($tmp)
                                    );
                        return(json_encode($json));                        
                    }
                    break;
                case 'token':
                    if (strlen($_POST['token'])) {
                          $json = array('id'=>'empresa_nome',
                                        'msg'=>utf8_encode(ROBOT)
                                        );
                          return(json_encode($json));
                    }
                    // Destrói o valor do token
                    unset($_POST['token']);
                    break;                
                default:
                    # code...
                    break;
            }
        }
        return 'OK';
    }

    /**
     * [duplicidadeNome description]
     * @param  [type] $flag [description]
     * @return [type]       [description]
     */
    private function duplicidadeNome($flag)
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if ($flag == 0) {
            $sql = "SELECT empresa_id FROM empresa WHERE empresa_nome='" . fullTrimX($_POST['empresa_nome']) . "'";
        } else {
            $sql = "SELECT empresa_id FROM empresa WHERE empresa_nome='" . fullTrimX($_POST['empresa_nome']) . "' AND empresa_id <> " . $_POST['empresa_id'];
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['empresa_nome'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['empresa_id']} ), ";
            $ret .= "tente outro valor!</p>";
            return $ret;
        }
    }

    /**
     * [duplicidadeEmail description]
     * @param  [type] $flag [description]
     * @return [type]       [description]
     */
    private function duplicidadeEmail($flag)
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if ($flag == 0) {
            $sql = "SELECT empresa_id FROM empresa WHERE empresa_email='" . fullTrimX($_POST['empresa_email'], 0) . "'";
        } else {
            $sql = "SELECT empresa_id FROM empresa WHERE empresa_email='" . fullTrimX($_POST['empresa_email'], 0) . "' AND empresa_id <> " . $_POST['empresa_id'];
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['empresa_email'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['empresa_id']} ), ";
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
        $tmp = '';
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /*
         * ENTRA A CONSULTA DE INSERÇÃO
         */
        $sql = "INSERT INTO empresa(";

        foreach ($_POST as $key => $value) {
            if ($key == 'empresa_contato4') {
                $sql .= "`" . $key . "`,";
            } else {
                $sql .= "`" . $key . "`,";
            }
        }

        $sql .= "`empresa_data_cadastro`) ";
        $sql .= "VALUES(";

        foreach ($_POST as $key => $value) {
            if ($key == 'empresa_email') {
                $tmp = strtolower(fullTrimX($_POST['empresa_email']));
            } elseif ($key == 'empresa_contato4') {
                $tmp = fullTrimX($_POST[$key]);
                $sql .= "'" . $tmp . "' ";
            } else {
                $tmp = fullTrimX($_POST[$key]);
            }
            //
            $sql .= "'" . $tmp . "', ";
        }

        $sql .= "'" . Date("Y-m-d H:i:s") . "'";
        $sql .= ");";
        //
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
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
     * [updtReg description]
     * @return [type] [description]
     */
    public function updtReg()
    {
        $tmp = '';
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /*
         * ENTRA A CONSULTA DE INSERÇÃO
         */
        $sql = "UPDATE empresa SET ";
        //
        foreach ($_POST as $key => $value) {
            if ($key == 'empresa_email') {
                $tmp = strtolower(fullTrimX($_POST['empresa_email']));
            } else {
                $tmp = fullTrimX($_POST[$key]);
            }
            $sql .= "`" . $key . "`= '" . $tmp . "', ";
        }
        //
        $sql .= "`empresa_data_cadastro` ='" . Date("Y-m-d H:i:s") . "' ";
        $sql .= "WHERE `empresa_id` =" . (int) $_POST['empresa_id'] . ";";
        //
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        if (!$result) {
            return UNEXPECTED_ERROR;
        }
        //
        return 'OK';
    }
}
