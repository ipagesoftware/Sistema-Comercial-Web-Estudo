<?php
/**
 * @version    1.0
 * @package    Estoque
 * @subpackage Ajuste
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;

require_once "{$nivel}application/views/estoque/class/EstoqueClass.php";

class AjusteDAO
{
    private $pdo;
    private $nivel;
    private $quantidade;
    private $tipo_op;
    private $produto_id;
    public $flag;
    //
    public function __construct($nivel)
    {
        $this->nivel    = $nivel;
        $this->pdo      = ConnClass::getInstance();
        $this->sid      = Session::getInstance();
        $this->security = Security::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            die('Sua sess�o expirou, ser� necess�rio logar-se no sistema novamente!'); // Usu�rio n�o logado
        }
    }

    /**
     *************************************************************************
     */
    public function getValues()
    {
        //CAPTA��O DADOS
        if (!isset($_POST['parameter1'])) {
            exit(": PAR�METRO N�O DEFINIDO");
        } else {
            $parameter = $_POST['parameter1'];
        }
        //DECODIFICA OS DADOS
        $ret = explode('&#', $this->security->decodeGET($parameter));
        $tmp = '';
        //
        //REALIZO A SEGUNDA DECOMPOSI��O DOS DADOS
        foreach ($ret as $key => $value) {
            $v = explode('=', $value);
            $tmp .= htmlspecialchars($v[1]) . '=';
            /**     ------------------------
            ^
            |
            +--- EVITA MYSQL INJECTION
             */
        }
        //
        list($this->quantidade, $this->tipo_op, $this->produto_id) = explode('=', $tmp);
        $this->flag                                                = intval($this->produto_id);
        //
        return 'OK';
    }
    /**
     *************************************************************************
     */
    public function insertReg()
    {
        $class = new EstoqueClass($this->nivel);
        //
        switch ($this->tipo_op) {
            case 'E':
                $ret = $class->setEntradaEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE');
                break;
            case 'S':
                $ret = $class->setSaidaEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE');
                break;
            case 'ES':
                $ret = $class->setEstornoEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE', $this->tipo_op);
                break;
            case 'EE':
                $ret = $class->setEstornoEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE', $this->tipo_op);
                break;
            case 'P':
                $ret = $class->setPerdaEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE');
                break;
            case 'C':
                $ret = $class->setSaidaEstoque($this->produto_id, $this->quantidade, 0, 'AJUSTE ESTOQUE', $this->tipo_op);
                break;
        }
        //
        if ($ret != 1) {
            return 'ERROR';
        }
        //
        return 'OK_INSERT';
    }
    /**
     *************************************************************************
     */
    public function updtReg()
    {
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conex�o';
        }
        /*
         * ENTRA A CONSULTA DE INSER��O
         */
        $sql = "UPDATE grupo SET ";
        $sql .= "`grupo_descricao`= '" . retiraAcentos(strip_tags($this->grupo_descricao)) . "', ";
        $sql .= "`grupo_status`= '" . (int) $this->grupo_status . "', ";
        $sql .= "`grupo_data_cadastro` ='" . Date("Y-m-d H:i:s") . "' ";
        $sql .= "WHERE `grupo_id` =" . (int) $this->grupo_id . ";";
        //
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        //
        return 'OK_UPDATE';
    }
}
