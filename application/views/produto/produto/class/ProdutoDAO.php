<?php
/**
 * @version    1.0
 * @package    produto
 * @subpackage cadastro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

class ProdutoDAO
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
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
    }

    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {
        $this->flag = (int)$_POST['produto_id'];        
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);

            switch ($key) {
                case 'produto_descricao':
                    $ret = $this->duplicidadeNome($this->flag);
                    if($ret){
                      $json = array('id'=>$key,
                                    'msg'=>utf8_encode($ret)
                                    );
                        return(json_encode($json));
                    }
                case 'produto_um':
                case 'produto_um_quant':
                case 'produto_emb_com':
                case 'produto_grupo':
                case 'produto_codigo_interno':
                    if(!strlen($_POST[$key])){
                        $tmp  = "Campo inválido ou inexistente, verifique!";
                        $json = array('id'=>$key,
                                    'msg'=>utf8_encode($tmp)
                                    );
                        return(json_encode($json));                        
                    }
                    break;
                case 'produto_foto':
                    // No modo edição a foto não será editada
                    if($this->flag){
                        unset($_POST[$key]);
                    }else{
                        $_POST[$key] = $this->downloadImage($_POST[$key]);
                    }
                    break;
                case 'token':
                    if (strlen($_POST['token'])) {
                          $json = array('id'=>'cliente_nome',
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
    public function duplicidadeNome($flag)
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if ($flag == 0) {
            $sql = "SELECT produto_id FROM produto WHERE produto_descricao='" . fullTrimX($_POST['produto_descricao']) . "'";
        } else {
            $sql = "SELECT produto_id FROM produto WHERE produto_descricao='" . fullTrimX($_POST['produto_descricao']) . "' AND produto_id <> " . $_POST['produto_id'];
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($result OR $query->rowCount()) {
            $ret  = "Operação falhou.<p>Nome(" . $_POST['produto_descricao'] . ") ";
            $ret .= "já cadastrado para o id ( {$result['produto_id']} ), ";
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

        $sql = "INSERT INTO produto(";

        foreach ($_POST as $key => $value) {
            if ($key == 'produto_grupo_id') {
                $sql .= "`" . $key . "`,";
            } else {
                $sql .= "`" . $key . "`,";
            }
        }

        $sql .= "`produto_data_cadastro`) ";
        $sql .= "VALUES(";

        foreach ($_POST as $key => $value) {
            if ($key == 'produto_um') {
                $tmp = strtoupper(fullTrimX($_POST['produto_um']));
            } elseif ($key == 'produto_um_quant'
                || $key == 'produto_emb_com'
                || $key == 'produto_val_custo'
                || $key == 'produto_margem_lucro'
                || $key == 'produto_val_revenda'
                || $key == 'produto_desconto') {
                $tmp = replaceAllX($_POST[$key],',','');
            } else if ($key == 'produto_foto'){
                $tmp = strtolower($_POST[$key]);
            } elseif ($key == 'produto_grupo_id') {
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

        $sql = "UPDATE produto SET ";
        //
        foreach ($_POST as $key => $value) {
            if ($key == 'produto_um') {
                $tmp = strtoupper(fullTrimX($_POST['produto_um']));
            } else if ($key == 'produto_foto'){
                $tmp = strtolower($_POST[$key]);
            } else if ($key == 'produto_um_quant'
                || $key == 'produto_emb_com'
                || $key == 'produto_val_custo'
                || $key == 'produto_margem_lucro'
                || $key == 'produto_val_revenda') {
                $tmp = replaceAllX($_POST[$key],',','');
            } else {
                $tmp = fullTrimX($_POST[$key]);
            }
            $sql .= "`" . $key . "`= '" . $tmp . "', ";
        }
        //
        $sql .= "`produto_data_cadastro` ='" . Date("Y-m-d H:i:s") . "' ";
        $sql .= "WHERE `produto_id` =" . (int) $_POST['produto_id'] . ";";
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
     * [downloadImage description]
     * @param  [type] $url [description]
     * @return [type]      [description]
     */
    function downloadImage($url){
        $name = explode("/", $url);
        $name = array_filter($name);
        $name = $name[sizeof($name)];
        //
        if(!substr_count($name, ".")){
          $name .= ".jpg";
        }
        //
        $fileName = ROOT . "application" . DIRECTORY_SEPARATOR .
                    "views" . DIRECTORY_SEPARATOR .
                    "produto" . DIRECTORY_SEPARATOR .
                    "produto" . DIRECTORY_SEPARATOR .
                    "foto_edit" . DIRECTORY_SEPARATOR .
                    "foto" . DIRECTORY_SEPARATOR . $name;
        //
        if(file_exists($fileName)){
          return $name;
        }
        //
        $file = fopen($url, 'rb');
        //
        if ($file) {
            $newf = fopen($fileName, 'wb');
            if ($newf) {
                while (!feof($file)) {
                    fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                }
            }
        }
        //
        if ($file) {
          fclose($file);
        }
        //
        if ($newf) {
          fclose($newf);
        }
        //
        return $name;
    }
}
