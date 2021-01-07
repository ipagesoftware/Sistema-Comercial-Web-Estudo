<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Usuários
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Utilities\Util;

class UsuariosIndex
{
    private $nivel;
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    private $tabela = 'user';
    private $sid;
    private $field_sort;
    private $order_sort;

    public $paginacao;
    public $criterio;
    public $security;
    public $permission;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->criterio   = "%";
        $this->sql        = "SELECT * FROM user WHERE ";
        $this->sql_count  = "SELECT COUNT(*) FROM user WHERE ";
        $this->field_sort = "user_data_cadastro";
        $this->order_sort = "DESC";

        $this->pdo      = ConnClass::getInstance();
        $this->security = Security::getInstance();
        $this->sid      = Session::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            header('Location: ' . SESSION_EXPIRED);
            exit();
        }
        //
        $cPermission      = new UserPermission();
        $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);

        if ($this->permission['negar'] != 1) {
            $module = $this->security->encondeGET("Usuários");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
    }

    /**
     * [createLinkMenu description]
     * @return [type] [description]
     */
    public function createLinkMenu()
    {
        $t = '<div class="row">';
        $t .= '    <div class="col-lg-12">';
        $t .= '        <h1 class="page-header">';
        $t .= '          Lista de Usuários <small> - ' . $this->sid->getNode('procedencia_empresa') . '</small>';
        $t .= '        </h1>';
        $t .= '        <ol class="breadcrumb">';
        $t .= '          <li>';
        $t .= '              <i class="fa fa-home"></i> <a href="' . URL . '">Home</a>';
        $t .= '          </li>';
        //
        if ($this->sid->getNode('user_nivel') == 'A') {
            $t .= '          <li>';
            $t .= '              <i class="fa fa-refresh"></i> <a href="usuarios/">Atualizar</a>';
            $t .= '          </li>';
        }
        //
        $t .= '          <li>';
        $t .= '              <i class="fa fa-user-md"></i> <a href="application/views/user/perfil/">Perfil</a>';
        $t .= '          </li>';

        $t .= '          <li>';
        $t .= '              <i class="fa fa-user-md"></i> <a href="application/views/user/redefinir_senha/">Redefinir Senha</a>';
        $t .= '          </li>';
        //
        if ($this->sid->getNode('user_nivel') == 'A') {
            if ($this->permission['inserir'] != 1) {
                $t .= '          <li>';
                $t .= '            <i class="fa fa-ban"></i> Adicionar</a>';
                $t .= '          </li>';
            } else {
                $t .= '          <li>';
                $t .= '            <i class="fa fa-plus"></i> <a href="usuarios/addupdt/">Adicionar</a>';
                $t .= '          </li>';
            }
        }
        //
        $t .= '          <li>';
        $t .= '               <i class="fa fa-search"></i> <a href="javascript:void(0);" id="mnu_pesquisar">Pesquisar</a>';
        $t .= '          </li>';
        //
        $t .= '        </ol>';
        $t .= '    </div>';
        $t .= '</div>';
        return $t;
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
        
        $util = Util::getInstance();      
        //
        if ($this->permission['editar'] != 1) {
            $module = $this->security->encondeGET("Usuários");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
        //
        $criterio = $_GET['atvdtv'];
        return $util->setStatus($this->tabela, $criterio);
    }

    /**
     * [getSort description]
     * @return [type] [description]
     */
    public function getSort()
    {
        $util = Util::getInstance();
        $util->getSort($this->order_sort, $this->field_sort);
    }

    /**
     * [getCriteria description]
     * @return [type] [description]
     */
    public function getCriteria()
    {
        $sql = $this->sql . " user_id = -1;";

        if (strlen($this->criterio) == 0) {
            return $sql;
        }
        //
        if ($this->criterio != '%') {
            //DECODIFICA OS DADOS
            //REALIZO A PRIMEIRA DECOMPOSIÇÃO DOS DADOS
            $parameter = $this->criterio;
            $ret       = explode('&', $this->security->decodeGET($parameter));
            $tmp       = '';
            //
            //REALIZO A SEGUNDA DECOMPOSIÇÃO DOS DADOS
            foreach ($ret as $key => $value) {
                $v = explode('=', $value);
                $tmp .= htmlspecialchars($v[1]) . '=';
                /**     ------------------------
                ^
                |
                +--- EVITA MYSQL INJECTION
                 */
            }
            //PASSO OS VALORES DECOMPOSTOS PARA AS RESPECTIVAS VARIÁVEIS
            list($dummy1, $dummy2, $dummy3,
                $dummy4, $dummy5, $this->criterio) = explode('=', $tmp);
            //
        }
        //
        if (strtoupper($this->criterio) == 'ADMINISTRADOR') {
            $sql = $this->sql;
            $sql .= "(user_nivel = 'A') ";
            //$sql .=  "ORDER BY user_id DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
            $this->sql_count .= "(user_nivel = 'A') ";
            return $sql;
        } elseif (strtoupper($this->criterio) == 'OPERACIONAL') {
            $sql = $this->sql;
            $sql .= "(user_nivel = 'O') ";
            $this->sql_count .= "(user_nivel = 'O') ";
            //$sql .=  "ORDER BY user_id DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
            return $sql;
        } elseif (strtoupper($this->criterio) == 'COMUM') {
            $sql = $this->sql;
            $sql .= "(user_nivel = 'C') ";
            $this->sql_count .= "(user_nivel = 'C') ";
            //$sql .=  "ORDER BY user_id DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
            return $sql;
        } elseif (strtoupper($this->criterio) == 'ATIVO') {
            $sql = $this->sql;
            $sql .= "(user_status = 1) ";
            $this->sql_count .= "(user_status = 1) ";
            //$sql .=  "ORDER BY user_id DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
            return $sql;
        } elseif (strtoupper($this->criterio) == 'INATIVO') {
            $sql = $this->sql;
            $sql .= "(user_status = 0) ";
            $this->sql_count .= "(user_status = 0) ";
            //$sql .=  "ORDER BY user_id DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
            return $sql;
        }
        //
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //VERIFICA SE TEM DADOS, SE A PESQUISA RETORNOU ALGUM REGISTRO
        $cols = $query->columnCount();
        $sql  = $this->sql;
        //
        for ($i = 0; $i < $cols; $i++) {
            $fld = $query->getColumnMeta($i);
            //
            if (!$i) {
                $sql .= $fld['name'] . " like '%$this->criterio%' ";
                $this->sql_count .= $fld['name'] . " like '%$this->criterio%' ";
            } else {
                $sql .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
                $this->sql_count .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
            }
        }
        //$sql .= "ORDER BY id_customer DESC;";//A ORDENAÇÃO VEM DA API DATATABLE EM JS.
        $ret = str_ireplace('%%%', '%', $sql);
        $sql = $ret;
        //
        $ret             = str_ireplace('%%%', '%', $this->sql_count);
        $this->sql_count = $ret;
        //
        //
        $query = $pdo->prepare($this->sql_count);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($query->rowCount() > 0) {
            $num_rows = $result[0];
        } else {
            $num_rows = 1;
        }
        //
        if ($num_rows <= 0) {
            $num_rows = 1;
        }
        //
        $this->pages     = new App\Paginacao\Paginator($num_rows, INITIAL_PAGINATION_NUMBER, PAGINATION);
        $this->paginacao = $this->pages->display_pages() . ' ' . $this->pages->display_jump_menu() . $this->pages->display_items_per_page() . ' Total Reg.: ' . $num_rows;
        $sql .= ' ORDER BY ' . $this->field_sort . ' ' . $this->order_sort . ' LIMIT ' . $this->pages->limit_start . ',' . $this->pages->limit_end;
        //
        return $sql;
    }

    /**
     * [insertDataIntoTable description]
     * @param  string $criterio [description]
     * @return [type]           [description]
     */
    public function insertDataIntoTable($criterio = '')
    {
        $COR        = ' class="danger"';
        $cor        = '';
        $flag       = 0;
        $nivel['A'] = "Administrador";
        $nivel['O'] = "Operacional";
        $nivel['C'] = "Comum";
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
        /**
         * DEFINO A PESQUISA
         */
        $sql = $this->getCriteria($criterio);
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        if (!$query->rowCount()) {
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
                    $flag = strtoupper($rs['user_status']);
                    //
                    if (!$flag) {
                        $cor = $COR;
                    } else {
                        $cor = "";
                    }
                    //
                    $b .= '<tr ' . $cor . '>';
                }
                //
                if ($i == 0) {
                    $b .= '<td style="text-align: center;">';
                    $ret      = 0;
                    $disabled = '<button type="button" class="btn btn-xs btn-default disabled">Excluir</button>';
                    //
                    $b .= $this->generateButton($rs['user_id'], $rs['user_status']);
                    $b .= '</td>';
                    $b .= '<td>' . pintaTextoConsulta(ucwords(strtolower($rs[$fld['name']])), $this->criterio) . '</td>';
                } else {
                    if (strtoupper($fld['name']) == "USER_LOGIN") {
                        $b .= '<td>' . pintaTextoConsulta($rs[$fld['name']], $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "USER_EMAIL") {
                        $b .= '<td>' . pintaTextoConsulta(strtolower($rs[$fld['name']]), $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "USER_STATUS") {
                        $ret = $rs[$fld['name']] == "1" ? "ATIVO" : "INATIVO";
                        $b .= '<td>' . $ret . '</td>';
                    } elseif (strtoupper($fld['name']) == "USER_FOTO") {
                        $b .= $this->editPhoto($rs['user_id'], $rs[$fld['name']]);
                    } elseif (strtoupper($fld['name']) == "USER_NIVEL") {
                        @$ret = $nivel[$rs[$fld['name']]];
                        if (!$ret) {
                            $ret = "O";
                        }
                        $b .= '<td>' . $ret . '</td>';
                    } elseif (strtoupper($fld['name']) == "USER_PASSWORD" ||
                        strtoupper($fld['name']) == "USER_DATA_CADASTRO") {
                        //A SENHA NÃO SERA INCLUSA JÁ QUE A MESMA É IRREVERSÍVEL
                    } else {
                        $ucw = ucwords(strtolower($rs[$fld['name']]));
                        $b .= '<td style="text-align: right;">';
                        $b .= pintaTextoConsulta($ucw, $this->criterio);
                        $b .= '</td>';
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
        $b .= '<div class="div-paginacao">Paginação : ' . $this->paginacao . '</div>';
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
        $t .= '      <th style="text-align: center;">MENU</th>';
        //
        $t .= $this->createSort('USUÁRIO', 'user_login');
        $t .= $this->createSort('NÍVEL', 'user_nivel');
        $t .= $this->createSort('EMAIL', 'user_email');
        $t .= $this->createSort('STATUS', 'user_status');
        //$t .= $this->createSort('FOTO', 'user_foto');
        $t .= '<th nowrap>FOTO</th>';
        $t .= $this->createSort('ID', 'user_id');
        $t .= '  </tr>';
        $t .= '</thead>';
        return $t;
    }

    /**
     * [createSort description]
     * @param  [type] $caption     [description]
     * @param  [type] $campoTabela [description]
     * @return [type]              [description]
     */
    private function createSort($caption, $campoTabela)
    {
        $parameters = $this->security->parameterGenerator(5);
        //
        if (strtoupper($this->field_sort) != strtoupper($campoTabela)) {
            $icon = '';
            $ret  = 'ASC';
            $cor  = '';
        } else {
            if (strtoupper($this->order_sort) == 'ASC') {
                $ret  = "DESC";
                $icon = '<i class="fa fa-fw fa-sort-alpha-asc"></i>';
                $cor  = 'style="background:#5cb85c;color:#000;text-decoration:none;"';
            } else {
                $ret  = "ASC";
                $icon = '<i class="fa fa-fw fa-sort-alpha-desc"></i>';
                $cor  = 'style="background:#337ab7;color:#000;text-decoration:none;"';
            }
        }
        //
        $parameters['par5'] = $ret;
        $parameters['par6'] = $campoTabela;
        $parameter1         = $this->security->encodeTmpUrl($parameters);
        $tmp                = '?page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
        $tmp .= '&sort=' . $this->security->encondeGET($parameter1);
        //
        return '<th nowrap ' . $cor . '><a ' . $cor . ' href="usuarios/' . $tmp . '">' . $caption . ' ' . $icon . '</a></th>';
    }

    /**
     * [editPhoto description]
     * @param  [type] $id  [description]
     * @param  [type] $img [description]
     * @return [type]      [description]
     */
    private function editPhoto($id, $img)
    {
        $b = "";
        #########################
        #  GERO O BOTÃO EDITAR  #
        #########################
        $parameters         = $this->security->parameterGenerator(3);
        $parameters['par3'] = $id;
        $parameter1         = $this->security->encodeTmpUrl($parameters);
        $tmp                = 'application/views/user/perfil/?parameter1=' . $this->security->encondeGET($parameter1);
        //
        $t = '<a href="' . $tmp . '">';
        $t .= '<img src="application/views/user/perfil/foto/' . $img . '" class="foto-grid" />';
        $t .= '</a>';
        $b = '<td>' . $t . '</td>';
        //
        return $b;
    }

    /**
     * [generateButton description]
     * @param  [type] $id     [description]
     * @param  [type] $active [description]
     * @return [type]         [description]
     */
    private function generateButton($id, $active)
    {
        if (strtoupper($this->sid->getNode('id_customer')) == $id) {
            $ret = 1;
        } else {
            $ret = 0;
        }
        $b        = "";
        $disabled = '<a href="#" ';
        $disabled .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Excluir">';
        $disabled .= '<i class="fa fa-trash"></i>';
        $disabled .= '</a>';

        if ($this->permission['excluir'] == 1) {
            if (strtoupper($this->sid->getNode('id_customer')) == strtoupper($id)) {
                $b .= $disabled;
            } else {
                if ($ret == 0) {
                    $b .= '<a href="javascript:;" onclick="Usuarios.delReg(' . $id . ');void(0);" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-danger" data-toggle="tooltip" data-original-title="Excluir">';
                    $b .= '<i class="fa fa-trash"></i>';
                    $b .= '</a>';
                } else {
                    $b = $disabled;
                }
            }
        } else {
            $b .= $disabled;
        }
        #########################
        #  GERO O BOTÃO EDITAR  #
        #########################
        $parameters         = $this->security->parameterGenerator(3);
        $parameters['par3'] = $id;
        $parameter1         = $this->security->encodeTmpUrl($parameters);
        $tmp                = '?parameter1=' . $this->security->encondeGET($parameter1);
        //
        $disabled = '&nbsp;<a href="#" ';
        $disabled .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Editar">';
        $disabled .= '<i class="fa fa-pencil"></i>';
        $disabled .= '</a>';

        if ($this->permission['editar'] == 1) {
            if ($ret == 0) {
                $b .= '&nbsp;<a href="usuarios/addupdt/' . $tmp . '" ';
                $b .= ' class="btn btn-sm btn-icon btn-flat btn-primary" data-toggle="tooltip" data-original-title="Editar">';
                $b .= '<i class="fa fa-pencil"></i>';
                $b .= '</a>';
            } else {
                $b .= $disabled;
            }
        } else {
            $b .= $disabled;
        }
        #########################
        #  GERO O BOTÃO ON/OFF  #
        #########################
        $parameters = $this->security->parameterGenerator(5);

        $parameters['par5'] = ($active == 1) ? 0 : 1;
        $parameters['par6'] = $id;
        $parameter1         = $this->security->encodeTmpUrl($parameters);
        $tmp                = '?atvdtv=' . $this->security->encondeGET($parameter1);
        //
        if ($this->permission['editar'] == 1) {
            if ($ret != 0) {
                if ($parameters['par5'] == 0) {
                    $b .= '&nbsp;<a href="#" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Desativar">';
                    $b .= '<i class="fa fa-toggle-on"></i>';
                    $b .= '</a>';
                } else {
                    $b .= '&nbsp;<a href="#" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Ativado">';
                    $b .= '<i class="fa fa-toggle-off"></i>';
                    $b .= '</a>';
                }
            } else {
                if ($parameters['par5'] == 0) {
                    $b .= '&nbsp;<a href="usuarios/' . $tmp . '" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-success" data-toggle="tooltip" data-original-title="Desativar">';
                    $b .= '<i class="fa fa-toggle-on"></i>';
                    $b .= '</a>';
                } else {
                    $b .= '&nbsp;<a href="usuarios/' . $tmp . '" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-default" data-toggle="tooltip" data-original-title="Ativar">';
                    $b .= '<i class="fa fa-toggle-off"></i>';
                    $b .= '</a>';
                }
            }
        } else {
            if ($parameters['par5'] == 0) {
                $b = '&nbsp;<a href="#" ';
                $b .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Desativar">';
                $b .= '<i class="fa fa-toggle-on"></i>';
                $b .= '</a>';
            } else {
                $b = '&nbsp;<a href="#" ';
                $b .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Ativado">';
                $b .= '<i class="fa fa-toggle-off"></i>';
                $b .= '</a>';
            }
        }
        return $b;
    }
}
