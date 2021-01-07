<?php
/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Procedência
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Utilities\Util;

class ProcedenciaIndex
{
    private $nivel;
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    private $tabela = 'procedencia';
    private $field_sort;
    private $order_sort;
    private $num_rows;
    //
    public $paginacao;
    public $criterio;
    public $security;
    public $permission;
    public $sid;

    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct($nivel)
    {
        $this->criterio   = "%";
        $this->sql        = "SELECT * FROM procedencia WHERE ";
        $this->sql_count  = "SELECT COUNT(*) FROM procedencia WHERE ";
        $this->nivel      = $nivel;
        $this->field_sort = "procedencia_data_cadastro";
        $this->order_sort = "DESC";
        $this->pdo        = ConnClass::getInstance();
        $this->security   = Security::getInstance();
        $this->sid        = Session::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            // Usuário não logado
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
            $module = $this->security->encondeGET("Procedência");
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
        $sql  = $this->sql . " procedencia_id = -1;";
        $flag = 0;

        if (strlen($this->criterio) == 0) {
            return $sql;
        }
        //
        $this->decodificaCriterio();
        //
        if (strtoupper($this->criterio) == 'ATIVO') {
            $sql = $this->sql;
            $sql .= "(procedencia_status = 1) ";
            $this->sql_count .= "(procedencia_status = 1) ";
            $flag = 1;
        } elseif (strtoupper($this->criterio) == 'INATIVO') {
            $sql = $this->sql;
            $sql .= "(procedencia_status = 0) ";
            $this->sql_count .= "(procedencia_status = 0) ";
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
            #$rs = $query->fetch(PDO::FETCH_BOTH);
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
                    $g = substr($fld['name'], -4);
                    if (strtoupper($g) != 'GUID') {
                        $sql .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
                        $this->sql_count .= "OR " . $fld['name'] . " like '%$this->criterio%' ";
                    }
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
        $this->pages     = new App\Paginacao\Paginator($this->num_rows, INITIAL_PAGINATION_NUMBER, PAGINATION);
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
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            for ($i = 0; $i < $cols; $i++) {
                $fld = $query->getColumnMeta($i);
                // Adiciona apenas os campos necessários a planilha
                switch ($fld['name']) {
                    case 'procedencia_empresa':
                        $flag = strtoupper($rs['procedencia_status']);
                        //
                        if (!$flag) {
                            $cor = $COR;
                        } else {
                            $cor = "";
                        }
                        //
                        $b .= '<tr ' . $cor . '>';

                        $flag = strtoupper($rs['procedencia_status']);
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
                        $b .= $this->generateButton($rs['procedencia_id'], $rs['procedencia_status']);
                        $b .= '</td>';
                        $b .= '<td nowrap style="text-align: left;">'
                        . stringFormat($rs[$fld['name']], $this->criterio, true)
                            . '</td>';
                        break;
                    case 'procedencia_id':
                        $b .= '<td nowrap style="text-align: right;">' . pintaTextoConsulta(utf8_decode($rs[$fld['name']]), $this->criterio) . '</td>';
                        break; 
                    case 'procedencia_email':
                    case 'procedencia_cnpj':
                    case 'procedencia_cidade':
                        $b .= '<td nowrap style="text-align: left;">'
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
        $b .= '<div class="div-paginacao">Paginação : ' . $this->paginacao . '</div>';
        //
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
        $t .= '      <th style="text-align: center;">MENU</th>';
        $t .= $this->createSort('EMPRESA', 'procedencia_empresa');
        $t .= $this->createSort('EMAIL', 'procedencia_email');
        $t .= $this->createSort('CIDADE', 'procedencia_cidade');
        $t .= $this->createSort('CNPJ', 'procedencia_cnpj');
        $t .= $this->createSort('ID', 'procedencia_id');
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
        //VERIFICA SE TEMOS O PARÂMETRO FINDREG(PARAMETER1))
        $ret = explode('parameter1=', $_SERVER["REQUEST_URI"]);
        if (count($ret) == 2) {
            $tmp = '?parameter1=' . $ret[1] . '&page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
        } else {
            $tmp = '?page=' . $this->pages->current_page . '&ipp=' . $this->pages->limit_end;
        }
        //
        $tmp .= '&sort=' . $this->security->encondeGET($parameter1);
        //
        return '<th nowrap ' . $cor . '><a ' . $cor . ' href="procedencia/' . $tmp . '">' . $caption . ' ' . $icon . '</a></th>';
    }

    /**
     * [generateButton description]
     * @param  [type] $id     [description]
     * @param  [type] $active [description]
     * @return [type]         [description]
     */
    private function generateButton($id, $active)
    {
        if ($this->sid->getNode('procedencia_id') != $id) {
            $ret = 0;
        } else {
            $ret = 1;
        }
        //
        $b   = "";
        $url = 'javascript:Procedencia.showModal(' . $id . ');';
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
        //
        if ($this->permission['excluir'] == 1) {
            if ($this->sid->getNode('procedencia_id') == $id) {
                $b .= $disabled;
            } else {
                if ($ret == 0) {
                    $b .= '<a href="javascript:;" onclick="Procedencia.delReg(' . $id . ');void(0);" ';
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
            if ($this->sid->getNode('procedencia_id') == $id) {
                $b .= $disabled;
            } elseif ($ret == 0) {
                $b .= '&nbsp;<a href="procedencia/addupdt/' . $tmp . '" ';
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
        $parameters         = $this->security->parameterGenerator(5);
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
                    $b .= '&nbsp;<a href="procedencia/' . $tmp . '" ';
                    $b .= ' class="btn btn-sm btn-icon btn-flat btn-success" data-toggle="tooltip" data-original-title="Desativar">';
                    $b .= '<i class="fa fa-toggle-on"></i>';
                    $b .= '</a>';
                } else {
                    $b .= '&nbsp;<a href="procedencia/' . $tmp . '" ';
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
