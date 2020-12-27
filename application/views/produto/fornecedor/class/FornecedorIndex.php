<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Fornecedor
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */

use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Utilities\Util;

class FornecedorIndex
{
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    private $field_sort;
    private $order_sort;
    private $tabela = 'fornecedor';
    //
    public $paginacao;
    public $criterio;
    public $security;
    public $permission;
    public $sid;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->criterio   = "%";
        $this->sql        = "SELECT * FROM fornecedor WHERE ";
        $this->sql_count  = "SELECT COUNT(fornecedor_id) FROM fornecedor WHERE ";
        $this->field_sort = "fornecedor_data_cadastro";
        $this->order_sort = "DESC";
        $this->pdo        = ConnClass::getInstance();
        $this->security   = Security::getInstance();
        $this->sid        = Session::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            header('Location: ' . SESSION_EXPIRED);
            exit();
        }
        //
        $cPermission      = new UserPermission();
        $this->permission = json_decode($cPermission->showPermission($this->sid->getNode('user_id'), $this->tabela), true);
        //
        if ($this->permission['negar'] != 1) {
            $module = $this->security->encondeGET("Fornecedor");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
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

        $util = Util::getInstance();
        //
        if ($this->permission['editar'] != 1) {
            $module = $this->security->encondeGET("Fornecedor");
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
    private function getCriteria()
    {
        $sql  = $this->sql . " fornecedor_id = -1;";
        $flag = 0;

        if (strlen($this->criterio) == 0) {
            return $sql;
        }
        //
        $this->decodificaCriterio();
        //
        if (strtoupper($this->criterio) == 'ATIVO') {
            $sql = $this->sql;
            $sql .= "(fornecedor_status = 1) ";
            $this->sql_count .= "(fornecedor_status = 1) ";
            $flag = 1;
        } elseif (strtoupper($this->criterio) == 'FISICA' || strtoupper($this->criterio) == 'FÍSICA') {
            $this->criterio = 'FÍSICA';
            $sql            = $this->sql;
            $sql .= "(fornecedor_pessoa = 'F') ";
            $this->sql_count .= "(fornecedor_pessoa = 'F') ";
            $flag = 1;
        } elseif (strtoupper($this->criterio) == 'JURIDICA' || strtoupper($this->criterio) == 'JURÍDICA') {
            $this->criterio = 'JURÍDICA';
            $sql            = $this->sql;
            $sql .= "(fornecedor_pessoa = 'J') ";
            $this->sql_count .= "(fornecedor_pessoa = 'J') ";
            $flag = 1;
        } elseif (strtoupper($this->criterio) == 'INATIVO') {
            $sql = $this->sql;
            $sql .= "(fornecedor_status = 0) ";
            $this->sql_count .= "(fornecedor_status = 0) ";
            $flag = 1;
        }
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        if (!$flag) {
            $query = $pdo->prepare($sql);
            $query->execute();
            //VERIFICA SE TEM DADOS, SE A PESQUISA RETORNOU ALGUM REGISTRO
            $cols = $query->columnCount();
            $sql  = $this->sql;
            //
            for ($i = 0; $i < $cols; $i++) {
                $fld = $query->getColumnMeta($i);
                if (!$i) {
                    $sql .= $fld['name'] . " like '%$this->criterio%' ";
                    $this->sql_count .= $fld['name'] . " like '%$this->criterio%' ";
                } else {
                    $sql .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
                    $this->sql_count .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
                }
            }
            $ret = str_ireplace('%%%', '%', $sql);
            $sql = $ret;
            //
            $ret             = str_ireplace('%%%', '%', $this->sql_count);
            $this->sql_count = $ret;
        }
        //
        $query = $pdo->prepare($this->sql_count);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$result) {
            return 'ERROR';
        }
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
        $this->pages     = new App\Paginacao\Paginator($this->num_rows, 9, array(9, 3, 6, 9, 12, 25, 50, 100, 250, 'Tudo'));
        $this->paginacao = $this->pages->display_pages() . ' ' . $this->pages->display_jump_menu() . $this->pages->display_items_per_page() . ' Total Reg.: ' . $this->num_rows;
        $sql .= ' ORDER BY ' . $this->field_sort . ' ' . $this->order_sort . ' LIMIT ' . $this->pages->limit_start . ',' . $this->pages->limit_end;
        //
        return $sql;
    }

    /**
     * [decodificaCriterio description]
     * @return [type] [description]
     */
    public function decodificaCriterio()
    {
        $util           = Util::getInstance();
        $this->criterio = $util->decodificaCriterio();
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
        $sql   = $this->getCriteria($criterio);
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
        //
        $rows = $query->rowCount();
        $cols = $query->columnCount();
        //
        $parameters = array();
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            for ($i = 0; $i < $cols; $i++) {
                $fld = $query->getColumnMeta($i);
                // Adiciona apenas os campos necessários a planilha
                switch ($fld['name']) {
                    case 'fornecedor_nome':
                        // Verifica os botões da coluna MENU
                        $flag = strtoupper($rs['fornecedor_status']);
                        //
                        if (!$flag) {
                            $cor = $COR;
                        } else {
                            $cor = "";
                        }
                        //
                        $b .= '<tr ' . $cor . '>';
                        $b .= '<td nowrap style="text-align: center;">';
                        //
                        $b .= $this->generateButton($rs['fornecedor_id'], $rs['fornecedor_status']);
                        $b .= '</td>';
                        $b .= '<td nowrap style="text-align: left;">'
                        . stringFormat($rs[$fld['name']], $this->criterio, true)
                            . '</td>';
                        break;
                    case 'fornecedor_email':
                        $b .= '<td nowrap style="text-align: left;">'
                        . pintaTextoConsulta(strtolower($rs[$fld['name']]), $this->criterio)
                            . '</td>';
                        break;
                    case 'fornecedor_pessoa':
                        $ret = $rs[$fld['name']] == "F" ? "FÍSICA" : "JURÍDICA";
                        $b .= '<td>' . stringFormat($ret, $this->criterio, null) . '</td>';
                        break;
                    case 'fornecedor_nome':
                    case 'fornecedor_fone1':
                        $b .= '<td nowrap style="text-align: left;">'
                        . stringFormat($rs[$fld['name']], $this->criterio, true)
                            . '</td>';
                        break;
                    case 'fornecedor_id':
                        $b .= '<td nowrap style="text-align: right;">'
                        . stringFormat($rs[$fld['name']], $this->criterio, true)
                            . '</td>';
                        break;
                    default:
                        # code...
                        break;
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
        //
        if ((int) $rows >= 9) {
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
        $t .= '<tr>';
        $t .= '<th style="text-align: center;">MENU</th>';
        $t .= $this->createSort('NOME', 'fornecedor_nome');
        $t .= $this->createSort('PESSOA', 'fornecedor_pessoa');
        $t .= $this->createSort('EMAIL', 'fornecedor_email');
        $t .= '<th nowrap>FONE 1</th>';
        $t .= $this->createSort('ID', 'fornecedor_id');
        $t .= '</tr>';
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
        //
        $ret = explode('parameter1=', $_SERVER["REQUEST_URI"]);
        if (count($ret) == 2) {
            $tmp = '?parameter1=' . $ret[1] . '&page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
        } else {
            $tmp = '?page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
        }
        //
        $tmp .= '&sort=' . $this->security->encondeGET($parameter1);
        //
        return '<th nowrap ' . $cor . '><a ' . $cor . ' href="fornecedor/' . $tmp . '">' . $caption . ' ' . $icon . '</a></th>';
    }

    /**
     * [generateButton description]
     * @param  [type] $id     [description]
     * @param  [type] $active [description]
     * @return [type]         [description]
     */
    private function generateButton($id, $active)
    {
        $ret = 0;
        $b   = "";
        $url = 'javascript:Fornecedor.showModal(' . $id . ');';
        //
        $b .= '<a href="javascript:void(0);" onclick="' . $url . '"';
        $b .= ' class="btn btn-sm btn-icon btn-flat btn-warning" data-toggle="tooltip" data-original-title="Visualizar Dados">';
        $b .= '<i class="fa fa-eye"></i>';
        $b .= '</a>&nbsp;';
        //
        $disabled = '<a href="#" ';
        $disabled .= ' class="btn btn-sm btn-icon btn-flat btn-default disabled" data-toggle="tooltip" data-original-title="Excluir">';
        $disabled .= '<i class="fa fa-trash"></i>';
        $disabled .= '</a>';

        if ($this->permission['excluir'] == 1) {
            if (strtoupper($this->sid->getNode('fornecedor_id')) == strtoupper($id)) {
                $b .= $disabled;
            } else {
                if ($ret == 0) {
                    $b .= '<a href="javascript:;" onclick="Fornecedor.delReg(' . $id . ');void(0);" ';
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
                $b .= '&nbsp;<a href="fornecedor/addupdt/' . $tmp . '" ';
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
                    $b .= '&nbsp;<a href="fornecedor/' . $tmp . '" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-success" data-toggle="tooltip" data-original-title="Desativar">';
                    $b .= '<i class="fa fa-toggle-on"></i>';
                    $b .= '</a>';
                } else {
                    $b .= '&nbsp;<a href="fornecedor/' . $tmp . '" ';
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
