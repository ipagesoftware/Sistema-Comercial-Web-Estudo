<?php
/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Procedência x usuário
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Utilities\Util;

class ProcedenciaUsuario
{
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    private $num_rows;
    public $paginacao;
    public $criterio;
    public $security;
    private $tabela = 'procedencia_users';
    public $permission;
    public $sid;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->criterio = "%";
        $this->sql      = "SELECT * FROM procedencia_users WHERE ";

        $this->sql = "SELECT user.user_login, procedencia.procedencia_empresa, ";
        $this->sql .= "procedencia_users.procedencia_id, user.user_id, procedencia_users.negar ";
        $this->sql .= "FROM (procedencia INNER JOIN procedencia_users ON procedencia.procedencia_id = procedencia_users.procedencia_id) ";
        $this->sql .= "INNER JOIN user ON procedencia_users.user_id = user.user_id ";
        $this->sql .= "ORDER BY user.user_login, procedencia_users.procedencia_id ";
        //
        $this->sql_count = "SELECT Count(procedencia_users.id) AS ContarDeid ";
        $this->sql_count .= "FROM (procedencia INNER JOIN procedencia_users ON ";
        $this->sql_count .= "procedencia.procedencia_id = procedencia_users.procedencia_id) ";
        $this->sql_count .= "INNER JOIN user ON procedencia_users.user_id = user.user_id;";
        //
        $this->pdo      = ConnClass::getInstance();
        $this->sid      = Session::getInstance();
        $this->security = Security::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            header('Location: ' . SESSION_EXPIRED);
            exit();
        } elseif ((int) $this->sid->getNode('procedencia_id') == 0 or !FINANCAS) {
            header('Location: ' . URL . 'sel_procedencia/');
            exit();
        }
        //
        $cPermission      = new UserPermission();
        $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);
        //
        if ($this->permission['negar'] != 1) {
            $module = $this->security->encondeGET("Procedência");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
        //
        $this->createProcedenciaUsers();
    }

    /**
     * [createProcedenciaUsers description]
     * @return [type] [description]
     */
    private function createProcedenciaUsers()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $pdo->beginTransaction(); /* Inicia a transação */
        $flag     = 0;
        $sql_user = "SELECT user_id FROM user ORDER BY user_id";
        //
        $query = $pdo->prepare($sql_user);
        $query->execute();
        //
        while ($rs_users = $query->fetch(PDO::FETCH_BOTH)) {
            $sql_procedencia = "SELECT procedencia_id FROM procedencia ORDER BY procedencia_id";
            #$rs_procedencia = $pdo->Execute($sql_procedencia);
            $query = $pdo->prepare($sql_procedencia);
            $query->execute();
            //
            while ($rs_procedencia = $query->fetch(PDO::FETCH_BOTH)) {
                // VERIFICA SE O USUÁRIO EXISTE NA TANELA PROCEDENCIA_USERS */
                $sql = "SELECT id ";
                $sql .= "FROM procedencia_users ";
                $sql .= "WHERE procedencia_id=" . $rs_procedencia['procedencia_id'];
                $sql .= " AND user_id=" . $rs_users['user_id'];
                //
                $query = $pdo->prepare($sql);
                $query->execute();
                $rs = $query->fetch(PDO::FETCH_BOTH);
                //
                if ($query->rowCount() <= 0) {
                    //INSIRO DADOS NA TABELA
                    $sql = "INSERT INTO procedencia_users(";
                    $sql .= "`procedencia_id`,";
                    $sql .= "`user_id`,";
                    $sql .= "`negar`,";
                    $sql .= "`data_cadastro`) ";
                    $sql .= "VALUES(";
                    $sql .= "'" . $rs_procedencia['procedencia_id'] . "', ";
                    $sql .= "'" . $rs_users['user_id'] . "', ";
                    $sql .= "'0', ";
                    $sql .= "'" . Date("Y-m-d H:i:s") . "'";
                    $sql .= ");";
                    //CONSULTA DE EXECUÇÃO
                    try {
                        $result = $pdo->query($sql);
                    } catch (PDOException $e) {
                        $pdo->rollBack();
                        return "ERROR_INSERT";
                    }
                    $flag = 1;
                }
            }
        }
        //
        if ($flag) {
            $pdo->commit();
        } else {
            $pdo->rollBack();
        }
    }

    /**
     * [atvDtv description]
     * @return [type] [description]
     */
    public function atvDtv()
    {
        if (!isset($_GET['atvdtv'])) {
            return;
        }
        //
        if ($this->permission['editar'] != 1) {
            $module = $this->security->encondeGET("Procedência X Usuários");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
        //
        $criterio = $_GET['atvdtv'];
        //DECODIFICA OS DADOS
        //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
        $parameter = $criterio;
        $ret       = explode('&', $this->security->decodeGET($parameter));
        $tmp       = '';
        //
        //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
        foreach ($ret as $key => $value) {
            $v = explode('=', $value);
            $tmp .= htmlspecialchars($this->security->decodeGET($v[1])) . '=';
            /**     ------------------------
            ^
            |
            +--- EVITA MYSQL INJECTION
             */
        }
        //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
        list($dummy1, $dummy2, $dummy3,
            $dummy4, $dummy5, $procedencia_negar, $procedencia_id, $user_id) = explode('=', $tmp);
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /**
         * DEFINO A PESQUISA
         */
        $sql = "UPDATE `procedencia_users` SET ";
        $sql .= "`negar`=" . $procedencia_negar;
        $sql .= " WHERE `procedencia_id`=" . $procedencia_id;
        $sql .= " AND `user_id`=" . $user_id;
        //
        //CONSULTA DE EXECUÇÃO
        try {
            $result = $pdo->query($sql);
        } catch (PDOException $e) {
            return "ERROR_UPDATE";
        }
        //
        return 'OK_UPDATE';
    }

    /**
     * [getCriteria description]
     * @return [type] [description]
     */
    private function getCriteria()
    {
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $query = $pdo->prepare($this->sql_count);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($query->rowCount()) {
            $this->num_rows = $result[0];
        } else {
            $this->num_rows = 1;
        }
        //
        if ($this->num_rows <= 0) {
            $this->num_rows = 1;
        }
        //
        $this->pages     = new App\Paginacao\Paginator($this->num_rows, 9, array(15, 3, 6, 9, 12, 25, 50, 100, 250, 'Tudo'));
        $this->paginacao = $this->pages->display_pages() . ' ' . $this->pages->display_jump_menu() . $this->pages->display_items_per_page() . ' Total Reg.: ' . $this->num_rows;
        $this->sql .= ' LIMIT ' . $this->pages->limit_start . ',' . $this->pages->limit_end;
    }

    /**
     * [insertDataIntoTable description]
     * @param  string $criterio [description]
     * @return [type]           [description]
     */
    public function insertDataIntoTable($criterio = '')
    {
        $COR  = ' class="danger"';
        $cor  = '';
        $flag = 0;
        //
        if (strlen($criterio) == 0) {
            $criterio = $this->criterio;
        }
        //
        if (strlen($criterio) == 0) {
            $criterio = "%";
        } else {
            $criterio = str_replace("'", "", $criterio);
        }
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /**
         * DEFINO A PESQUISA
         */
        $this->getCriteria($criterio);
        $query = $pdo->prepare($this->sql);
        $query->execute();
        //
        if ($query->rowCount() == 0) {
            $util = Util::getInstance();
            return $util->createEmptyTable($this->criterio);
        }
        //
        $b = '<div class="div-paginacao">Paginação : ' . $this->paginacao . '</div>';
        $b .= '<div class="table-responsive">';
        $b .= '<table class="table table-bordered table-hover table-striped">';
        $b .= $this->createTheader();
        $b .= '<tbody>';

        $rows = $query->rowCount();
        $cols = $query->columnCount();
        //
        $parameters = array();
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            for ($i = 0; $i < $cols; $i++) {
                $fld = $query->getColumnMeta($i);
                if ($i == 0) {
                    $flag = strtoupper($rs['negar']);
                    //
                    if ($flag == 0) {
                        $cor = $COR;
                    } else {
                        $cor = "";
                    }
                    //
                    $b .= '<tr ' . $cor . '>';
                }
                //
                if ($i == 0) {
                    $b .= '<td nowrap style="text-align: center;">';
                    //
                    $parameters         = $this->security->parameterGenerator(5);
                    $parameters['par5'] = ($rs['negar'] == 1) ? 0 : 1;
                    $parameters['par6'] = $rs['procedencia_id'];
                    $parameters['par7'] = $rs['user_id'];
                    $parameter1         = $this->security->encodeTmpUrl($parameters);
                    //
                    $ret = explode('parameter1=', $_SERVER["REQUEST_URI"]);
                    if (count($ret) == 2) {
                        $url = '?parameter1=' . $ret[1] . '&page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
                    } else {
                        $url = '?page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
                    }
                    $tmp = $url . '&atvdtv=' . $this->security->encondeGET($parameter1);
                    //
                    if ($this->sid->getNode('procedencia_id') == $rs['procedencia_id'] &&
                        $this->sid->getNode('user_id') == $rs['user_id']) {
                        if ($parameters['par5'] == 0) {
                            $b .= '&nbsp;<button type="button" class="btn btn-xs btn-default disabled">OFF</button>';
                        } else {
                            $b .= '&nbsp;<button type="button" class="btn btn-xs btn-default disabled">ON&nbsp;</button>';
                        }
                    } else {
                        if ($this->permission['editar'] == 1) {
                            if ($parameters['par5'] == 0) {
                                $b .= '&nbsp;<a href="procedencia_users/' . $tmp . '"><button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Desativa o registro">OFF</button></a>';
                            } else {
                                $b .= '&nbsp;<a href="procedencia_users/' . $tmp . '"><button type="button" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Ativa o registro">ON&nbsp;</button></a>';
                            }
                        } else {
                            if ($parameters['par5'] == 0) {
                                $b .= '&nbsp;<button type="button" class="btn btn-xs btn-default disabled">OFF</button>';
                            } else {
                                $b .= '&nbsp;<button type="button" class="btn btn-xs btn-default disabled">ON&nbsp;</button>';
                            }
                        }
                    }
                    $b .= '</td>';
                    $b .= '<td nowrap>' . ucwords(strtolower($rs[$fld['name']])) . '</td>';
                } else {
                    if (strtoupper($fld['name']) == "NEGAR") {
                        $ret = $rs[$fld['name']] == "1" ? "ATIVO" : "INATIVO";
                        $b .= '<td>' . $ret . '</td>';
                    } else {
                        if (strtoupper($fld['name']) != "DATA_CADASTRO" &&
                            strtoupper($fld['name']) != "PROCEDENCIA_ID" &&
                            strtoupper($fld['name']) != "USER_ID") {
                            $b .= '<td nowrap style="text-align: left;">' . ucwords(strtolower($rs[$fld['name']])) . '</td>';
                        }
                    }
                }
            }
            $b .= '</tr>';
        }
        /**
         * GERA O THEAD
         */
        $b .= '</tbody>';
        $b .= '</table>';
        $b .= '</div>';
        
        if ((int)$this->num_rows >= 9) {
            $b .= '<div class="div-paginacao">Paginação : ' . $this->paginacao . '</div>';
        }        
        return ($b);
    }

    /**
     * [createTheader description]
     * @return [type] [description]
     */
    private function createTheader()
    {
        $t = '<thead>';
        $t .= '  <tr>';
        $t .= '      <th style="text-align: center;width:80px;">MENU</th>';
        $t .= '      <th nowrap>USUÁRIO</th>';
        $t .= '      <th nowrap>PROCEDÊNCIA</th>';
        $t .= '      <th nowrap>STATUS</th>';
        $t .= '  </tr>';
        $t .= '</thead>';
        return $t;
    }
}
