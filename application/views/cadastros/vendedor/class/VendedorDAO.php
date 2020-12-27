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

class VendedorDAO
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
        $this->flag = intval($_POST['vendedor_id'], 10);
        //
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);

            switch ($key) {
                case 'vendedor_nome':
                    $ret = $this->duplicidadeNome($this->flag);
                    if($ret){
                      $json = array('id'=>$key,
                                    'msg'=>utf8_encode($ret)
                                    );
                        return(json_encode($json));
                    }
                case 'vendedor_email':
                    // Remove os caracteres ilegais do email
                    $email = filter_var($_POST['vendedor_email'], FILTER_SANITIZE_EMAIL);
                    //
                    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                      $json = array('id'=>'vendedor_email',
                                    'msg'=>utf8_encode('Email inválido, verifique!')
                                    );
                      return(json_encode($json));
                    }
                    // Verifica se o email é repetido
                    $ret = $this->duplicidadeEmail($this->flag);

                    if($ret){
                      $json = array('id'=>'vendedor_email',
                                    'msg'=>utf8_encode($ret)
                                    );
                      return json_encode($json);
                    }
                case 'vendedor_pessoa':
                case 'vendedor_cep':
                case 'vendedor_endereco':
                case 'vendedor_bairro':
                case 'vendedor_cidade':
                case 'vendedor_uf':
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
                          $json = array('id'=>'vendedor_nome',
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
            $sql = "SELECT vendedor_id FROM vendedor WHERE vendedor_nome='" . fullTrimX($_POST['vendedor_nome']) . "'";
        } else {
            $sql = "SELECT vendedor_id FROM vendedor WHERE vendedor_nome='" . fullTrimX($_POST['vendedor_nome']) . "' AND vendedor_id <> " . $_POST['vendedor_id'];
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['vendedor_nome'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['vendedor_id']} ), ";
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
            $sql = "SELECT vendedor_id FROM vendedor WHERE vendedor_email='" . fullTrimX($_POST['vendedor_email'], 0) . "'";
        } else {
            $sql = "SELECT vendedor_id FROM vendedor WHERE vendedor_email='" . fullTrimX($_POST['vendedor_email'], 0) . "' AND vendedor_id <> " . $_POST['vendedor_id'];
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['vendedor_email'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['vendedor_id']} ), ";
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
        $sql = "INSERT INTO vendedor(";

        foreach ($_POST as $key => $value) {
            if ($key == 'vendedor_contato4') {
                $sql .= "`" . $key . "`,";
            } else {
                $sql .= "`" . $key . "`,";
            }
        }

        $sql .= "`vendedor_data_cadastro`) ";
        $sql .= "VALUES(";

        foreach ($_POST as $key => $value) {
            if ($key == 'vendedor_email') {
                $tmp = strtolower(fullTrimX($_POST['vendedor_email']));
            } elseif ($key == 'vendedor_contato4') {
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
        $sql = "UPDATE vendedor SET ";
        //
        foreach ($_POST as $key => $value) {
            if ($key == 'vendedor_email') {
                $tmp = strtolower(fullTrimX($_POST['vendedor_email']));
            } else {
                $tmp = fullTrimX($_POST[$key]);
            }
            $sql .= "`" . $key . "`= '" . $tmp . "', ";
        }
        //
        $sql .= "`vendedor_data_cadastro` ='" . Date("Y-m-d H:i:s") . "' ";
        $sql .= "WHERE `vendedor_id` =" . (int) $_POST['vendedor_id'] . ";";
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
