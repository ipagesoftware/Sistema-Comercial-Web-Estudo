<?php
/**
 * @version    1.0
 * @package    Estoque
 * @subpackage Movimentação
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Seguranca\UserPermission;
use App\Utilities\Util;

class MovimentacaoIndex
{
    private $pdo;
    private $sql;
    private $sql_count;
    private $pages;
    private $tabela = 'estoque';
    private $sid;
    private $field_sort;
    private $order_sort;
    private $num_rows;
    //
    public $paginacao;
    public $criterio;
    public $security;
    public $permission;

    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct($nivel)
    {
        $this->criterio = "%";
        $sql            = "SELECT produto.produto_descricao, estoque.quant_entrada, estoque.quant_saida, estoque.estoque_atu, ";
        $sql .= "estoque.tipo_op, estoque.usuario, estoque.critico, estoque.origem, estoque.data_cadastro, produto.produto_codigo_interno, estoque.produto_id, estoque.id ";
        $sql .= "FROM produto INNER JOIN estoque ON produto.produto_id = estoque.produto_id ";
        $sql .= "WHERE ";
        $this->sql = $sql;
        //
        $sql = "SELECT COUNT(*) ";
        $sql .= "FROM produto INNER JOIN estoque ON produto.produto_id = estoque.produto_id ";
        $sql .= "WHERE ";
        $this->sql_count = $sql;
        //
        $this->field_sort = "estoque.data_cadastro";
        $this->order_sort = "DESC";
        //
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
        //
        if ($this->permission['negar'] != 1) {
            $module = $this->security->encondeGET("Estoque");
            $r      = $this->security->encondeGET(rand(1000, 5000));
            header("Location: " . URL . "3109.php?modulo=" . $module . "&parameter=" . $r);
            die();
        }
        //
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
     ***********************************************************************
     */
    private function getCriteria()
    {
        $sql = $this->sql . " produto.produto_id = -1;";

        if (strlen($this->criterio) == 0) {
            return $sql;
        }
        //
        $this->decodificaCriterio();
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
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
                #EVITA AMBIGUIDADE COM O CAMPO PRODUTO_ID E ID DAS TABELA PRODUTO E ESTOQUE
                if (strtoupper($fld['name']) == 'PRODUTO_ID') {
                    $sql .= "OR produto." . $fld['name'] . " like '%" . $this->criterio . "%' ";
                    $this->sql_count .= "OR produto." . $fld['name'] . " like '%" . $this->criterio . "%' ";
                } else {
                    $sql .= "OR " . $fld['name'] . " like '%" . $this->criterio . "%' ";
                    $this->sql_count .= "OR " . $fld['name'] . " like '%" . $this->criterio . "%' ";
                }
            }
        }
        //
        $ret = str_ireplace('%%%', '%', $sql);
        $sql = $ret;
        //
        $ret             = str_ireplace('%%%', '%', $this->sql_count);
        $this->sql_count = $ret;
        //
        $query = $pdo->prepare($this->sql_count);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_BOTH);
        //
        if (!$result) {
            return 'ERROR';
        }
        //
        if ($query->rowCount() > 0) {
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
     ***********************************************************************
     */
    public function insertDataIntoTable($criterio = '')
    {
        $op = array(
            "E"  => array("valor" => "ENTRADA", "cor" => "#98d482"),
            "S"  => array("valor" => "SAÍDA", "cor" => "#90b9d2"),
            "ES" => array("valor" => "ESTORNO SAÍDA", "cor" => "#ffeb9f"),
            "EE" => array("valor" => "ESTORNO ENTRADA", "cor" => "#ffeb9f"),
            "P"  => array("valor" => "PERDA", "cor" => "#f17272"),
            "C"  => array("valor" => "CONSUMO", "cor" => "#ff98e6"),
            "TE" => array("valor" => "TROCA ENTRADA", "cor" => "#68a3c2"),
            "TS" => array("valor" => "TROCA SAÍDA", "cor" => "#5cc790"),
        );
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

        $rows = $query->rowCount();
        $cols = $query->columnCount();
        //
        $parameters = array();
        //
        while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
            for ($i = 0; $i < $cols; $i++) {
                $fld = $query->getColumnMeta($i);
                if ($i == 0) {
                    $flag = strtoupper($rs['critico']);
                    //
                    if ($flag != 0) {
                        $cor = $COR;
                    } else {
                        $cor = "";
                    }
                    //
                    $b .= '<tr>';
                    $b .= '<td nowrap style="text-align: center;">';
                    //
                    if ($this->permission['inserir'] == 1) {
                        $b .= '<button type="button" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Movimenta o estoque do reg. atual" onclick="Movimentacao.viewReg(' . $rs['produto_id'] . ',\'' . $rs['produto_descricao'] . '\')">Movimentação</button>';
                    } else {
                        $b .= '<button type="button" class="btn btn-xs btn-primary disabled">Movimentação</button>';
                    }
                    $b .= '</td>';
                    $b .= '<td nowrap>' . pintaTextoConsulta($rs[$fld['name']], $this->criterio) . '</td>';
                } else {
                    if (strtoupper($fld['name']) == "CRITICO") {
                        $ret = $rs[$fld['name']] == "1" ? "SIM" : "NÃO";
                        $b .= '<td style="text-align:center;" ' . $cor . '>' . $ret . '</td>';
                    } elseif (strtoupper($fld['name']) == "ESTOQUE_INICIAL"
                        || strtoupper($fld['name']) == "QUANT_ENTRADA"
                        || strtoupper($fld['name']) == "QUANT_SAIDA"
                        || strtoupper($fld['name']) == "ESTOQUE_ATU") {
                        if ($rs[$fld['name']] < 0) {
                            $ret = 'color:red;';
                        } else {
                            $ret = '';
                        }
                        $b .= '<td nowrap style="text-align:right;' . $ret . '" >' . pintaTextoConsulta(number_format($rs[$fld['name']], 2, '.', ','), $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "NUMVENDA" || strtoupper($fld['name']) == "PRODUTO_ID") {
                        $b .= '<td nowrap style="text-align:center;">' . pintaTextoConsulta($rs[$fld['name']], $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "PRODUTO_CODIGO_INTERNO") {
                        $b .= '<td nowrap style="text-align:center;">' . pintaTextoConsulta($rs[$fld['name']], $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "TIPO_OP") {
                        $b .= '<td nowrap style="text-align:center;font-weight: bold;background:' . $op[$rs['tipo_op']]['cor'] . ';">' . pintaTextoConsulta($op[$rs[$fld['name']]]['valor'], $this->criterio) . '</td>';
                    } elseif (strtoupper($fld['name']) == "DATA_CADASTRO") {
                        $dt = explode(' ', $rs[$fld['name']]);
                        $d  = implode("/", array_reverse(explode("-", $dt[0])));
                        $b .= '<td nowrap style="text-align:center">' . pintaTextoConsulta($d . ' ' . $dt[1], $this->criterio) . '</td>';
                    } else {
                        $b .= '<td nowrap style="text-align: left;">' . pintaTextoConsulta(utf8_decode($rs[$fld['name']]), $this->criterio) . '</td>';
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
     ***********************************************************************
     */
    private function createTheader()
    {
        $t = '<thead>';
        $t .= '  <tr>';
        $t .= '      <th style="text-align: center;width:180px;">MENU</th>';

        $t .= $this->createSort('PRODUTO', 'produto_descricao');
        $t .= $this->createSort('QT. ENTRADA', 'quant_entrada');
        $t .= $this->createSort('QT. SAÍDA.', 'quant_saida');
        $t .= $this->createSort('EST. ATUAL', 'estoque_atu');
        $t .= $this->createSort('TIPO OP.', 'tipo_op');
        $t .= $this->createSort('USUÁRIO', 'usuario');
        $t .= $this->createSort('CRÍTICO?', 'critico');
        $t .= $this->createSort('ORIGEM', 'origem');
        $t .= $this->createSort('DT. OPERAÇÃO', 'data_cadastro');
        $t .= $this->createSort('CÓD. INTERNO', 'produto.produto_codigo_interno');
        $t .= $this->createSort('CÓD. PROD.', 'produto.produto_id');
        $t .= $this->createSort('ID', 'id');
        $t .= '  </tr>';
        $t .= '</thead>';
        return $t;
    }
    /**
     ***********************************************************************
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
        return '<th nowrap ' . $cor . '><a ' . $cor . ' href="movimentacao/' . $tmp . '">' . $caption . ' ' . $icon . '</a></th>';
    }
}
