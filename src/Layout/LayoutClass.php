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

use App\Conexao\ConnClass;
use App\Recursos\Session;
use \PDO;

class LayoutClass extends LayoutMenuClass
{
    // Variáveis provadas da classe
    private $pdo;
    // Variáveis pública da classe
    public $sid;
    public $paddingLeft = '';

    /**
     * [__construct description]
     */
    public function __construct()
    {
        parent::__construct();
        //
        $this->pdo = new ConnClass();
        $this->sid = new Session;
        $this->sid->start();
        //
        // Verifica se o usuário foi deslogado
        if (isset($_GET['logout']) && !empty($_GET['logout'])) {
            $this->sid->destroy();
            header('Location: ' . URL . 'login/');
            exit();
        }
        //
        if ($this->sid->check()) {
            // Ok, usuário logado
            $this->paddingLeft = '';
            //
            $this->procedenciaExist();
            if ($this->pdo->isLoged(null, $this->sid) != 'OK') {
                $this->sid->destroy();
                header('Location: ' . URL . 'login/');
                exit();
            };

        } else {
            $this->paddingLeft = ' style="padding-left: 0;"';
        }
    }

    /**
     * Verifica se a procedência existe
     *
     * @return String, valores retornados: OK, ERROR, OK_INSERT
     */
    private function procedenciaExist()
    {
        $flag = 0; // Inicializa a flag como valor padrão
        $pdo  = $this->pdo->openDatabase();
        //
        // Se ocorreu algum erro na abertura do banco de dados
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $negar          = 0;
        $procedencia_id = 0;
        //
        $sql = "SELECT ";
        $sql .= "procedencia_id, ";
        $sql .= "negar ";
        $sql .= "FROM ";
        $sql .= "procedencia_users ";
        $sql .= "WHERE ";
        $sql .= "user_id = '{$this->sid->getNode("user_id")}' ";
        $sql .= "ORDER BY ";
        $sql .= "procedencia_id;";
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        //
        while ($rs_procedencia = $query->fetch(PDO::FETCH_BOTH)) {
            if (intval($rs_procedencia[1], 10) == 1) {
                $procedencia_id = $rs_procedencia[0];
            }
            //
            $negar += intval($rs_procedencia[1], 10);
            $flag = 1;
        }
        //
        // Guarda o número de procedência para este usuário
        // Na variável de sessão procedencia_count
        $this->sid->setNode('procedencia_count', $negar);
        //
        if ($flag == 1 && $negar == 0) {
            // Verifica se todas as procedências estão bloqueadas
            // para o usuário atual.
            return 'USER_DENIED';
        } elseif ($flag == 1 && $negar > 1) {
            return 'OK';
        } elseif ($flag == 1 && $negar == 1) {
            // Se existir apenas uma procedência, efetuar o login
            // nesta procedencia automaticamente
            $sql = "SELECT ";
            $sql .= "procedencia_empresa, ";
            $sql .= "procedencia_id ";
            $sql .= "FROM ";
            $sql .= "procedencia ";
            $sql .= "WHERE ";
            $sql .= "procedencia_id = " . $procedencia_id . ";";
            //
            $query = $pdo->prepare($sql);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            //
            if (!$result) {
                return 'ERROR';
            }
            //
            if ($query->rowCount() > 0) {
                $this->sid->setNode('procedencia_id', $result[1]);
                $this->sid->setNode('procedencia_empresa', $result[0]);
                return 'OK';
            }
            //
            return 'ERROR';
        }

        // Se todas as alternativas falharem insere um novo registro
        // com permissão apenas para o usuário atualmente logado.
        $sql = "INSERT INTO ";
        $sql .= "procedencia(";
        $sql .= "procedencia_empresa,";
        $sql .= "procedencia_status,";
        $sql .= "procedencia_data_cadastro) ";
        $sql .= "VALUES(";
        $sql .= "'EMPRESA', ";
        $sql .= "'1', ";
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
            return 'ERROR';
        } else {
            // Se a procedência foi criada automaticamente já
            // define o valor nas variáveis de sesão
            $this->sid->setNode('procedencia_id', 1);
            $this->sid->setNode('procedencia_empresa', 'EMPRESA');
        }
        return 'OK_INSERT';
    }

    /**
     * Retorna uma representação HTML do layout da APP
     * representado o topo
     * nota: dimensões da imagem logo.png é de 140 x 49 pixels
     *
     * @return string
     */
    public function topHeader()
    {
        $m = '';
        $t = '<div class="navbar-header">';
        $t .= '<img class="media-object" src="assets/images/logo.png" alt="" style="float: left;">';
        //
        if ($this->sid->check()) {
            $t .= ' <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">';
            $t .= '   <span class="sr-only">Toggle navigation</span>';
            $t .= '   <span class="icon-bar"></span>';
            $t .= '   <span class="icon-bar"></span>';
            $t .= '   <span class="icon-bar"></span>';
            $t .= ' </button>';
            $m .= $this->dropDownUser();
        }
        //
        $t .= ' <a class="navbar-brand" href="' . URL . '">';
        $t .= APP_NAME . ' - ver. ' . VERSION;
        $t .= '</a>';
        $t .= '</div>';
        $t .= '<!-- Top Menu Items -->';
        $t .= '<ul class="nav navbar-right top-nav">';
        //
        $t .= $m;
        $t .= '</ul>';
        return $t;
    }

    /**
     * Retorna uma string com representação HTML do menu usuário
     * @return string
     */
    private function dropDownUser()
    {
        $foto = URL . "application/views/user/perfil/foto/";
        $foto .= $this->sid->getNode('user_foto');
        //
        $t = '<li class="dropdown">';
        $t .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
        //$t .= '<i class="fa fa-user"></i> ';
        $t .= '<img alt="" style="border-radius: 50% !important;height:40px;" src="' . $foto . '">';

        $t .= ' Usuário: ' . $this->sid->getNode('user_login') . ' <b class="caret"></b></a>';
        $t .= '<ul class="dropdown-menu" style="width: 200px;">';
        //
        $t .= '<li>';
        $t .= '<a href="application/views/user/perfil/"><i class="fa fa-fw fa-user-md"></i> Perfil</a>';
        $t .= '</li>';
        //
        $t .= '<li>';
        $t .= '<a href="application/views/user/redefinir_senha/"><i class="fa fa-fw fa-user-md"></i> Redefinir Senha</a>';
        $t .= '</li>';

        if ($this->sid->getNode('user_nivel') == 'A') {
            $t .= '<li>';
            $t .= '<a href="usuarios/"><i class="fa fa-fw fa-user-plus"></i> Cadastro Usuário</a>';
            $t .= '</li>';
            //
            $t .= '<li>';
            $t .= '<a href="permissoes/"><i class="fa fa-fw fa-cogs"></i> Permissões</a>';
            $t .= '</li>';
        }
        $t .= '<li class="divider"></li>';
        $t .= '<li>';
        $t .= '<a href="?logout=true"><i class="fa fa-fw fa-power-off"></i> Sair</a>';
        $t .= '</li>';
        $t .= '</ul>';
        $t .= '</li>';
        return $t;
    }

    /**
     * Retorna uma string com representação HTML da mensagem de boas vindas
     * @return strng
     */
    public function boasVindas()
    {
        $t = '<div class="row">';
        $t .= '<div class="col-lg-12">';
        $t .= '<div class="alert alert-info alert-dismissable">';
        $t .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

        if (!$this->sid->check()) {
            $t .= '<i class="fa fa-smile-o"></i> Seja bem-vindo ao ' . TITLE . '!';
        } else {
            $t .= '<i class="fa fa-smile-o"></i> Seja bem-vindo <strong>' . $this->sid->getNode('user_login') . '</strong>, ao ' . TITLE . '!';
        }
        $t .= '</div>';
        $t .= '</div>';
        $t .= '</div>';
        return $t;
    }

    /**
     * Retorna uma string com representação HTML dos cards da aplicação
     * @return string
     */
    public function createPanel()
    {
        $dados = [];
        //
        (INITIAL_PAGE == 0) ? $page = "" : $page = "addupdt.php";
        $t                          = '<div class="row">';
        if ($this->sid->check()) {
            $dados[] = [
                "color"       => "primary",
                "icon"        => "file",
                "link"        => "recibo/{$page}",
                "description" => 'Emissão Recibo',
                "caption"     => "Recibo",
                "sub_caption" => "&nbsp;",
                "disabled"    => !FINANCAS,
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "red",
                "icon"        => "money",
                "link"        => "contas_pagar/{$page}",
                "description" => 'Contas à Pagar',
                "caption"     => "Pagar",
                "sub_caption" => "&nbsp;",
                "disabled"    => !FINANCAS,
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "green",
                "icon"        => "money",
                "link"        => "contas_receber/{$page}",
                "description" => 'Contas à Receber',
                "caption"     => "Receber",
                "sub_caption" => "&nbsp;",
                "disabled"    => !FINANCAS,
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "purple",
                "icon"        => "file-powerpoint-o",
                "link"        => "plano_contas/{$page}",
                "description" => 'Plano Contas',
                "caption"     => "Plano",
                "sub_caption" => "&nbsp;",
                "disabled"    => !FINANCAS,
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "yellow",
                "icon"        => "line-chart",
                "link"        => "formas_pagamento/{$page}",
                "description" => 'Formas Pagamento',
                "caption"     => "Formas",
                "sub_caption" => "&nbsp;",
                "disabled"    => !FINANCAS,
                "target"      => 0,
            ];

            //
            $dados[] = [
                "color"       => "primary",
                "icon"        => "power-off",
                "link"        => "?logout=true",
                "description" => 'Sair desta aplicação',
                "caption"     => "Sair",
                "sub_caption" => "&nbsp;",
                "target"      => 0,
            ];
        } else {
            // Usuário não logado
            $dados[] = [
                "color"       => "primary",
                "icon"        => "plug",
                "link"        => "login/",
                "description" => "Acesso ao " . APP_NAME,
                "caption"     => "Login",
                "sub_caption" => "&nbsp;",
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "red",
                "icon"        => "lock",
                "link"        => "esqueci_senha/",
                "description" => "Recupere sua senha",
                "caption"     => "Esqueci",
                "sub_caption" => "a Senha",
                "target"      => 0,
            ];
            //
            $dados[] = [
                "color"       => "green",
                "icon"        => "comments",
                "link"        => "http://www.ipage.com.br/helpdesk/application/views/access/login/",
                "description" => "Conte com a nossa equipe de atendimento.",
                "caption"     => "Suporte",
                "sub_caption" => " Técnico",
                "target"      => 1,
            ];
        }
        //
        $t .= $this->privateCreatePanel($dados);

        $t .= '</div>';
        return $t;
    }

    /**
     * Retorna uma string com a representação HTML dos
     * Cards da aplicação que são exibidos na página inicial.
     *
     * @param  array  $dados [description]
     * @return string
     */
    private function privateCreatePanel(array $dados)
    {
        $t = null;
        foreach ($dados as $key) {
            if (array_key_exists("disabled", $key)) {
                if ($key["disabled"]) {
                    $key["link"]  = "javascript:;";
                    $key["color"] = "default";
                }
            }
            $t .= '<div class="col-lg-4 col-md-6">';
            $t .= '<a href="' . $key["link"] . '"';
            if ($key["target"]) {
                $t .= ' target="_blank" ';
            }
            $t .= '>';
            $t .= '<div class="panel panel-' . $key["color"] . '">';
            $t .= '<div class="panel-heading">';
            $t .= '<div class="row">';
            $t .= '<div class="col-xs-3">';
            $t .= '    <i class="fa fa-' . $key["icon"] . ' fa-5x"></i>';
            $t .= '</div>';
            $t .= '<div class="col-xs-9 text-right">';
            $t .= '    <div class="huge">' . $key["caption"] . '</div>';
            $t .= '    <div>' . $key["sub_caption"] . '</div>';
            $t .= '</div>';
            $t .= '</div>';
            $t .= '</div>';
            $t .= '<div class="panel-footer">';
            $t .= '<span class="pull-left">' . $key["description"] . '</span>';
            $t .= '<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>';
            $t .= '<div class="clearfix"></div>';
            $t .= '</div>';
            $t .= '</div>';
            $t .= '</div>';
            $t .= '</a>';
        }
        return $t;
    }

    /**
     * Retorna uma string com a representação HTML
     * do rodapé da aplicação.
     *
     * @return string
     */
    public function createFooter()
    {
        if (FOOTER) {
            $t = '<div style="height: 60px;margin-bottom:50px;"></div>';
            $t .= '  <div class="ipage-well">';
            $t .= '<!-- BEGIN FOOTER -->';
            $t .= '<div class="row">';
            $t .= '  <div class="col-sm-9">';
            $t .= '  <div style="text-align: left;">';
            $t .= '<span>' . COPY . ' ver. ' . VERSION . '-' . LAST_DATE . '</span>';
            $t .= '  </div>';
            $t .= '  </div>';
            $t .= '  <div class="col-sm-3">';
            $t .= '   <!-- Social Icons -->';
            $t .= '   <ul class="social-icons">';
            //
            if (defined('TWITTER')) {
                $t .= '     <li class="twitter"><a href="' . TWITTER . '" target="_blank">Twitter</a></li>';
            }
            //
            if (defined('FACEBOOK')) {
                $t .= '     <li class="facebook"><a href="' . FACEBOOK . '" target="_blank">Facebook</a></li>';
            }
            //
            if (defined('LINKEDIN')) {
                $t .= '     <li class="linkedin"><a href="' . LINKEDIN . '" target="_blank">LinkedIn</a></li>';
            }
            //
            if (defined('YOUTUBE')) {
                $t .= '     <li class="youtube"><a href="' . YOUTUBE . '" target="_blank">Youtube</a></li>';
            }
            //
            if (defined('BLOGGER')) {
                $t .= '     <li class="blogger"><a href="' . BLOGGER . '" target="_blank">Blogger</a></li>';
            }
            //
            if (defined('GITHUB')) {
                $t .= '     <li class="github"><a href="' . GITHUB . '" target="_blank">Blogger</a></li>';
            }
            //
            $t .= '   </ul>';
            $t .= '  </div>';
            $t .= '</div>';
            $t .= '<div class="row">';
            $t .= '  <div class="col-sm-12">';
            $t .= '  <div style="text-align: center;font-size: smaller;">';
            $t .= '<p>';
            $t .= '  * O uso deste aplicativo web está sujeito aos termos de uso. Ao continuar utilizando esta aplicação, você concorda em cumprir com estes termos.';
            $t .= '</p>';
            $t .= '<p>';
            $t .= '  # Acesso ao banco de dados em PDO.';
            $t .= '</p>';

            $t .= '  </div>';
            $t .= '  </div>';
            $t .= '</div><br /><br />';
            $t .= '  </div>';
        } else {
            $t = '<div style="height:60px;"></div>';
        }
        //
        return $t;
    }

    /**
     * [createCookie description]
     * @return [type] [description]
     */
    public function createCookie()
    {
        if (!LGPD) {
            return null;
        }

        $t = '<div class="popup popup-ipage">';
        $t .= '<div class="cont">';
        $t .= '<div class="btnFechar">';
        $t .= '<a id="closePopupCookies">x</a>';
        $t .= '</div>';
        $t .= '<p style="font-size: 14px;">';
        $t .= 'Este site utiliza cookies para melhorar sua experiência. Ao decidir continuar a navegar neste site, você concorda em aceitar o uso de cookies pela Ipage, consulte nossa ';
        $t .= '<a href="' . URL . 'politica_privacidade.php" ';
        $t .= 'onclick="javascript:$(\'.popup\').fadeOut(\'slow\');" ';
        $t .= 'class="ajuda_privacidade">Política de Privacidade</a>';
        $t .= ' para obter mais informações e os ';
        $t .= '<a href="' . URL . 'termos_uso.php" ';
        $t .= 'onclick="javascript:$(\'.popup\').fadeOut(\'slow\');" ';
        $t .= 'class="ajuda_termos_uso">Termos e Condições</a> da Página.';
        $t .= '</p>';
        $t .= '<div class="btnAceite">';
        $t .= '<a class="btnAceiteHref" id="cookie-ipage">Sim, concordo</a>';
        $t .= '<a id="cookie-ipage-no" href="javascript:;" style="background-color: #b70e2a;">Não concordo</a>';
        $t .= '</div>';
        $t .= '</div>';
        $t .= '</div>';
        echo $t;
    }

    /**
     * [getParameter description]
     * @return [type] [description]
     */
    public function getParameter()
    {
        $querystring = null;
        //
        if ($_GET) {
            $args = explode("&", $_SERVER["QUERY_STRING"]);
            foreach ($args as $arg) {
                if ($arg != "=/") {
                    $querystring .= $arg;
                }
            }
            //
            if ($querystring) {
                $querystring = "?" . $querystring;
            }
        }
        //
        return $querystring;
    }
}
