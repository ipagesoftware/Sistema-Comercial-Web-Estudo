<?php
/**
 * @version    1.0
 * @package    Recursos
 * @subpackage Layout
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
namespace App\Layout;

class LayoutMenuClass
{
    /**
     * [__construct description]
     */
    public function __construct()
    {
        (INITIAL_PAGE == 0) ? $this->page = null : $this->page = "addupdt/";
    }

    /**
     * [noScript description]
     * @return [type] [description]
     */
    public function noScript(){
        $t  = '<noscript>';
        $t .= '<div style="position: fixed;top: 200px;right: 30%;left: 30%;width:40%;z-index:99999">';
        $t .= '<div close="1" class="alert alert-danger" title="Atenção">';
        $t .= '<a style="text-decoration:none;">';
        $t .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">';
        $t .= '</button>';
        $t .= '</a>';
        $t .= '<h4 class="alert-heading">';
        $t .= '<strong>Erro!</strong>';
        $t .= '</h4>';
        $t .= '<p style="text-align:justify;text-align:justify;word-wrap: break-word;">';
        $t .= '<strong>Este aplicativo requer JavaScript para ser executado</strong>. Em um navegador sem suporte a JavaScript, como o seu, você ainda deve ver o conteúdo (dados HTML) e deve editá-lo normalmente, sem uma interface de editor rica.';
        $t .= '</p>';
        $t .= '</div>';
        $t .= '</div>';
        $t .= '</div>';
        $t .= '</noscript>';
        echo($t);
    }
    /**
     * [wait description]
     * @return [type] [description]
     */
    public function wait()
    {
        if(WAIT){
          $t  = '<div id="loader">';
          $t .= '<div class="loader-container">';
          $t .= '<div class="spinner">';
          $t .= '<div class="bounce1"></div>';
          $t .= '<div class="bounce2"></div>';
          $t .= '<div class="bounce3"></div>';
          $t .= '</div>';
          $t .= '</div>';
          $t .= '</div>';
          echo $t;
        }
        $this->noScript();
    }
    /**
     * [menuLateral description]
     * @param  string  $value  [description]
     * @param  integer $active [description]
     * @return string  - Retorna uma representação HTML
     * do menu lateral da APP
     */
    public function menuLateral($value = '', $active = 0)
    {
        if (!$this->sid->check()) {
            return '';
        }
        //
        $value = strtoupper(trim($value));
        //
        $t = '';
        $t .= '<div class="collapse navbar-collapse navbar-ex1-collapse">';
        $t .= '  <ul class="nav navbar-nav side-nav" style="margin-top:20px;">';
        $t .= $this->createMenuCadastros($value, $active);
        //
        if (VENDAS) {
            $t .= $this->createMenuProduto($value, $active);
            $t .= $this->createMenuEstoque($value, $active);
        }
        //
        if (FINANCAS) {
            $t .= $this->createMenuFinanceiro($value, $active);
        }
        //
        $t .= $this->createMenuAjuda($value, $active);
        $t .= $this->createMenuDownloads($value, $active);

        $t .= '  </ul>';
        $t .= '</div>';
        //
        return $t;
    }

    /**
     * [statusMenu description]
     * @param  [type] $value  [description]
     * @param  [type] $active [description]
     * @param  [type] $icon   [description]
     * @return [type]         [description]
     */
    private function statusMenu($value, $menu, &$active, &$icon, &$t)
    {
        $this->menuStatus = [
            'on'        => '<li style="background:#080808;color:#fff !important;">',
            'off'       => '<li>',
            'check_on'  => '<i class="fa fa-fw fa-check"></i> ',
            'check_off' => null,
        ];
        //
        $active = ($value == $menu) ? $this->menuStatus['on'] : $this->menuStatus['off'];
        $icon   = ($active != '<li>') ? $this->menuStatus['check_on'] : $this->menuStatus['check_off'];
        $t .= $active;
    }
    /**
     * Retorna uma string com representação HTML do menu Cadastros
     *
     * @param  string
     * @param  integer
     * @return Um string com a representação do cadastro em HTML
     */
    private function createMenuCadastros($value, $active = 0)
    {
        $activeCadastros            = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 1) {
            $activeCadastros[0] = ' aria-expanded="true"';
            $activeCadastros[1] = ' class="collapse in" aria-expanded="true"';
        }
        // CADASTROS
        $t = null;
        //
        $t .= '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#cadastros" ' . $activeCadastros[0] . '>';
        $t .= '    Cadastros ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="cadastros" ' . $activeCadastros[1] . '>';
        //
        $this->statusMenu($value, 'CLIENTE', $active, $icon, $t);
        $t .= '<a href="cliente/' . $this->page . '">' . $icon . ' Cliente</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'EMPRESA', $active, $icon, $t);
        $t .= '<a href="empresa/' . $this->page . '">' . $icon . ' Empresa</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'VENDEDOR', $active, $icon, $t);
        $t .= '<a href="vendedor/' . $this->page . '">' . $icon . ' Vendedor</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'VENDEDOR_CLIENTE', $active, $icon, $t);
        $t .= '<a href="vendedor_cliente/">' . $icon . ' Vendedor x Cliente</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'USERS_VENDEDOR', $active, $icon, $t);
        $t .= '<a href="users_vendedor/">' . $icon . ' Usuário x Vendedor</a>';
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }

    /**
     * Retorna uma string com representação HTML do menu Produto
     * @param  [type]  $value  [description]
     * @param  integer $active [description]
     * @return [type]          [description]
     */
    private function createMenuProduto($value, $active = 0)
    {
        $activeProdutos             = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 4) {
            $activeProdutos[0] = ' aria-expanded="true"';
            $activeProdutos[1] = ' class="collapse in" aria-expanded="true"';
        }
        //
        $t = '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#produto" ' . $activeProdutos[0] . '>';
        $t .= '    Produto ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="produto" ' . $activeProdutos[1] . '>';
        $this->statusMenu($value, 'PRODUTO', $active, $icon, $t);
        $t .= '<a href="produto/' . $this->page . '">' . $icon . ' Cadastro</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'FABRICANTE', $active, $icon, $t);
        $t .= '<a href="fabricante/' . $this->page . '">' . $icon . ' Fabricante</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'FORNECEDOR', $active, $icon, $t);
        $t .= '<a href="fornecedor/' . $this->page . '">' . $icon . ' Fornecedor</a>';
        //
        $this->statusMenu($value, 'GRUPO', $active, $icon, $t);
        $t .= '<a href="grupo/' . $this->page . '">' . $icon . ' Grupo</a>';
        $t .= '</li>';
        //
        $this->statusMenu($value, 'UM', $active, $icon, $t);
        $t .= '<a href="um/' . $this->page . '">' . $icon . ' Unidade Medida</a>';
        $t .= '</li>';
        //
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }

    /**
     * Retorna uma string com representação HTML do menu estoque
     * @param  [type]  $value  [description]
     * @param  integer $active [description]
     * @return [type]          [description]
     */
    private function createMenuEstoque($value, $active = 0)
    {
        $activeEstoque              = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 5) {
            $activeEstoque[0] = ' aria-expanded="true"';
            $activeEstoque[1] = ' class="collapse in" aria-expanded="true"';
        }
        //
        $t = '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#estoque" ' . $activeEstoque[0] . '>';
        $t .= '    Estoque ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="estoque" ' . $activeEstoque[1] . '>';
        //
        $active = ($value == 'ESTOQUE_MOV') ? $this->menuStatus['on'] : $this->menuStatus['off'];
        $icon   = ($active != '<li>') ? $this->menuStatus['check_on'] : $this->menuStatus['check_off'];
        $t .= $active;
        //
        $t .= '<a href="movimentacao/">' . $icon . ' Movimentação Estoque</a>';
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }

    /**
     * Retorna uma string com representação HTML do menu Financeiro
     * @param  [type]  $value  [description]
     * @param  integer $active [description]
     * @return [type]          [description]
     */
    private function createMenuFinanceiro($value, $active = 0)
    {
        $activeFinanceiro           = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 2) {
            $activeFinanceiro[0] = ' aria-expanded="true"';
            $activeFinanceiro[1] = ' class="collapse in" aria-expanded="true"';
        }
        // FINANCEIRO
        $t = '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#financeiro" ' . $activeFinanceiro[0] . '>';
        $t .= '    Financeiro ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="financeiro" ' . $activeFinanceiro[1] . '>';
        //
        $this->statusMenu($value, 'SEL_PROCEDENCIA', $active, $icon, $t);
        $t .= '<a href="sel_procedencia/">' . $icon . ' Selecionar Procedência</a>';
        //
        if ($this->sid->getNode('procedencia_id') != 0) {
            $this->statusMenu($value, 'BANCO', $active, $icon, $t);
            $t .= '<a href="banco/' . $this->page . '">' . $icon . ' Agência Bancária</a>';
            //
            $this->statusMenu($value, 'PROCEDENCIA', $active, $icon, $t);
            $t .= '<a href="procedencia/' . $this->page . '">' . $icon . ' Cadastro Procedência</a>';
            //
            $this->statusMenu($value, 'CARTAO_CREDITO', $active, $icon, $t);
            $t .= '<a href="cartao_credito/' . $this->page . '">' . $icon . ' Cartão de Crédito</a>';
            //
            $this->statusMenu($value, 'CONTAS_PAGAR', $active, $icon, $t);
            $t .= '<a href="contas_pagar/' . $this->page . '">' . $icon . ' Contas à Pagar</a>';
            //
            $this->statusMenu($value, 'CONTAS_RECEBER', $active, $icon, $t);
            $t .= '<a href="contas_receber/' . $this->page . '">' . $icon . ' Contas à Receber</a>';
            //
            $this->statusMenu($value, 'RECIBO', $active, $icon, $t);
            $t .= '<a href="recibo/' . $this->page . '">' . $icon . ' Emissão Recibo</a>';
            //
            $this->statusMenu($value, 'FORMAS_PAGAMENTO', $active, $icon, $t);
            $t .= '<a href="formas_pagamento/' . $this->page . '">' . $icon . ' Formas Pagamento</a>';
            //
            $this->statusMenu($value, 'PLANO_CONTAS', $active, $icon, $t);
            $t .= '<a href="plano_contas/' . $this->page . '">' . $icon . ' Plano Contas</a>';
            //
            $this->statusMenu($value, 'PROCEDENCIAXUSERS', $active, $icon, $t);
            $t .= '<a href="procedencia_users/">Procedência X Usuários</a>';
        }
        //
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }

    /**
     * [createMenuAjuda description]
     * @param  [type]  $value  [description]
     * @param  integer $active [description]
     * @return [type]          [description]
     */
    private function createMenuAjuda($value, $active = 0)
    {
        $activeAjuda                = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 3) {
            $activeAjuda[0] = ' aria-expanded="true"';
            $activeAjuda[1] = ' class="collapse in" aria-expanded="true"';
        }
        // FINANCEIRO
        $t = '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#ajuda" ' . $activeAjuda[0] . '>';
        $t .= '    Ajuda ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="ajuda" ' . $activeAjuda[1] . '>';
        //
        $this->statusMenu($value, 'POLITICA_PRIVACIDADE', $active, $icon, $t);
        $t .= '<a href="politica_privacidade/">' . $icon . ' Política de Privacidade</a>';
        //
        $this->statusMenu($value, 'TERMOS_USO', $active, $icon, $t);
        $t .= '<a href="termos_uso/">' . $icon . ' Termos de Uso</a>';
        //
        $t .= '<li>';
        $icon = '<i class="fa fa-fw fa-external-link"></i> ';
        $t .= '<a href="https://www.ipage.com.br/helpdesk/" target="_blank">' . $icon . ' Suporte Técnico...</a>';
        //
        $icon = '<i class="fa fa-fw fa-external-link"></i> ';
        $t .= '<li>';
        $t .= '<a href="https://www.ipage.com.br" target="_blank">' . $icon . ' Visite a IPAGE</a>';

        //
        $icon = '<i class="fa fa-fw fa-external-link"></i> ';
        $t .= '<li>';
        $t .= '<a href="https://github.com/ipagesoftware/" target="_blank">' . $icon . ' GitHub</a>';
        
        $t .= '<li>';
        $icon = '<i class="fa fa-fw fa-info-circle"></i> ';
        //
        $url = URL . 'about.php';
        $title = 'Sobre...';
        $height = '470px';
        $t .= '<a href="javascript:;" onclick="ipageViews.viewReg(\''. $url . '\', \'' . $title . '\', \'' . $height . '\');">' . $icon . ' Sobre...</a>';

        // url, title, height, large_small, showbtn, callback"
        $t .= '<li>';
        $icon = '<i class="fa fa-fw fa-cogs"></i> ';        
        $t .= '<a href="' . URL . 'info/" target="_blank">' . $icon . ' Informações...</a>';

        //
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }

    /**
     * [createMenuDownloads description]
     * @param  [type]  $value  [description]
     * @param  integer $active [description]
     * @return [type]          [description]
     */
    private function createMenuDownloads($value, $active = 0)
    {
        $activeDownloads                = array(0 => '', 1 => 'class="collapse"');
        //
        if ($active == 3) {
            $activeDownloads[0] = ' aria-expanded="true"';
            $activeDownloads[1] = ' class="collapse in" aria-expanded="true"';
        }
        // FINANCEIRO
        $t = '<li>';
        $t .= '    <a href="javascript:;" data-toggle="collapse" data-target="#downloads" ' . $activeDownloads[0] . '>';
        $t .= '    Downloads ';
        $t .= '       <i class="fa fa-fw fa-caret-down"></i>';
        $t .= '    </a>';
        $t .= '    <ul id="downloads" ' . $activeDownloads[1] . '>';
        //
        $this->statusMenu($value, 'FIREFOX', $active, $icon, $t);
        $t .= '<a href="https://www.mozilla.org/pt-BR/firefox/new/?from=getfirefox" target="_blank">' . $icon . ' Firefox</a>';
        //
        $this->statusMenu($value, 'GOOGLE_CHROME', $active, $icon, $t);
        $t .= '<a href="https://www.google.com/chrome/" target="_blank">' . $icon . ' Google Chrome</a>';
        //
        $this->statusMenu($value, 'HEIDI_SQL', $active, $icon, $t);
        $t .= '<a href="https://www.heidisql.com/download.php" target="_blank">' . $icon . ' HeidiSQL</a>';
        //
        $this->statusMenu($value, 'VSCODE', $active, $icon, $t);
        $t .= '<a href="https://code.visualstudio.com/download" target="_blank">' . $icon . ' VS Code</a>';
        //
        $this->statusMenu($value, 'SUBLIMETEXT', $active, $icon, $t);
        $t .= '<a href="https://www.sublimetext.com/download/" target="_blank">' . $icon . ' Sublime Text</a>';
        //
        $this->statusMenu($value, 'NOTEPAD++', $active, $icon, $t);
        $t .= '<a href="https://notepad-plus-plus.org/" target="_blank">' . $icon . ' Notepad ++</a>';        
        //
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        //
        return $t;
    }    
}
