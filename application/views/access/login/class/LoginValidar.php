<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Login
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Conexao\ConnClass;
use App\Recursos\Session;

require_once $nivel . 'application/controles/email/PHPMailerAutoload.php';

class LoginValidar
{
    private $email;
    private $pwd;
    private $sid;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->sid = Session::getInstance();
        $this->sid->start();
        //
        if ($this->sid->check()) {
            // Usuário já logado
            $js = '<script>';
            $js .= 'window.parent.location.href="' . URL . '";';
            $js .= '</script>';
            die($js);
        }
    }
    /**
     * Realiza o tratamento nas variáveis global $_POST
     * @return [type] [description]
     */
    public function getValues()
    {
        // Captação dados
        $email   = $_POST['email'];
        $pwd     = $_POST['pwd'];        
        // Decodifica dados
        $email   = $this->decodeGET($email);
        $pwd     = $this->decodeGET($pwd);       

        // Inicia as validações
        // Verifica se o email é válido
        // Remove os caracteres ilegais do email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        //
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $json = array('id' => 'txtemail',
                'msg'=> utf8_encode('O email possui caracteres inválidos ou foi digitado incorretamente, verifique!'),
            );
            return (json_encode($json));
        }
        //
        $this->email = $email;
        $this->pwd   = $pwd;
        //
        return 'OK';
    }

    /**
     * [logar description]
     * @return [type] [description]
     */
    public function logar()
    {
        $conn = ConnClass::getInstance();
        $pdo  = $conn->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        //
        $sql = "SELECT";
        $sql .= " * ";
        $sql .= "FROM ";
        $sql .= "user ";
        $sql .= "WHERE ";
        $sql .= "user_email = '{$this->email}' ";
        $sql .= "AND ";
        $sql .= "user_password = '" . encrypt($this->pwd) . "';";
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);
        //
        if ($query->rowCount()) {
            if ($rs['user_status'] == 0) {
                $json = array('id' => 'txtemail',
                    'msg'=> utf8_encode('O usuário informado está desabilitado temporariamente. <br>Entre em contato com o usuário administrador para maiores informações!'),
                );
                return (json_encode($json));
            }
            // Verifica se o captcha é válido
            $captcha = $_POST['captcha'];
            $captcha = $this->decodeGET($captcha);
            $ret = $this->getStatusCaptcha($captcha);
            //
            if (is_null($ret)) {
                $json = array('id' => 'txtkey',
                    'msg'=> utf8_encode('Código acesso inválido, verifique!'),
                );
                return (json_encode($json));
            }
            // Define as variáveis da sessão para o login
            $this->sid->init(36000); // 60 * 60 * 10 = 36000 => 10 minutos
            $this->sid->addNode('start', date('d/m/Y - h:i'));
            $this->sid->addNode('user_id', $rs['user_id']);
            $this->sid->addNode('user_login', ucfirst($rs['user_login']));
            $this->sid->addNode('user_foto', $rs['user_foto']);
            $this->sid->addNode('user_email', strtolower($rs['user_email']));
            $this->sid->addNode('user_nivel', strtoupper($rs['user_nivel']));
            // Os valores serão definidos no login da procedencia
            // se o módulo financeiro estiver definido como 1 no config.php
            if(FINANCAS){
                $this->sid->addNode('procedencia_id', 0);
                $this->sid->addNode('procedencia_empresa', '');
                $this->sid->addNode('procedencia_count', 0);
            }
            // Se esta flag estiver definida como 1, envia um emial
            // comunicando o login bem sucedido.
            if(SEND_EMAIL){
                $ret = $this->sendEmail($rs['user_email'], $rs['user_login'], $rs['user_email']);
                //
                if ($ret != 'OK') {
                    $json = array('id' => 'txtemail',
                        'msg'=> utf8_encode('Ocorreu um erro ao enviar o email de confirmação do login, tente mais tarde!'),
                    );
                    return (json_encode($json));
                }
            }
            //
            return 'OK';
            //
        } else {
            $json = array('id' => 'txtemail',
                'msg'=> utf8_encode('Usuário ou senha inválidos, verifique!'),
            );
            return (json_encode($json));
        }

    }
    /**
     * Verifica o valor do captcha digitado
     * com o gerado pelo sistema
     * @param  [type] $_captcha [description]
     * @return [type]           [description]
     */
    private function getStatusCaptcha($_captcha)
    {
        if (!$_captcha)return null;
        //
        $ret = strcasecmp($_captcha, $this->getCaptcha());
        //
        if ($ret!=0) {
            return null;
        } else {
            return 1;
        }
    }

    /**
     * Retorna o captcha gerado pelo sistema
     *
     * @return string
     */
    private function getCaptcha()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION["ckey"])) {
            $_SESSION["ckey"] = 'undefined';
        }
        //
        return $_SESSION["ckey"];
    }

    /**
     * Decodifica uma string em hexadecimal
     * @param  string hexadecimal
     * @return string decodificada
     */
    private function decodeHex($hex)
    {
        $string = '';
        //
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        //
        return $string;
    }

    /**
     * Decodifica uma url get codificada
     * @param  string url codificada
     * @return String decodificada
     */
    private function decodeGET($value)
    {
        $ret   = $this->decodeHex($value);
        $value = fulltrim(base64_decode($ret));
        return $value;
    }

    /**
     * [sendEmail description]
     * @param  O email do destinatário
     * @param  O nome do remetente
     * @param  O email do remetente
     * @return booleano true se tudo certo ou false se algo saiu errado
     */
    private function sendEmail($email, $nome_do_remetente, $email_remetente)
    {
        if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
            return true;
        }
        // Envia um e-mail para o usuário com a confirmação da operação
        $nome_do_remetente = ucwords(strtolower($nome_do_remetente));
        $emaildestinatario = $email;
        $current_date      = date("d/m/Y H:i:s");
        $assunto           = EMPRESA . ' - Sistema ' . APP_NAME . ' / Login.';
        //
        // Corpo do documento html
        //
        $body = $this->getBody($assunto, $nome_do_remetente);
        //
        $mail          = new PHPMailer();
        $mail->CharSet = 'iso-8859-1';
        ini_set('default_charset', 'ISO-8859-1');
        //
        $mail->isSMTP(); //INFORMO QUE SERÁ VIA SMTP
        $mail->SMTPDebug  = 0; //0 - Desligado, 1 - Mensagem Cliente, 2 - Mensagem Servidor e cliente
        $mail->Host       = HOST_EMAIL;
        $mail->Port       = "25";
        $mail->SMTPSecure = "tls";
        $mail->SMTPAuth   = true;
        $mail->Username   = SET_FROM;
        $mail->Password   = EMAIL_PWD;
        //
        $mail->addReplyTo(SET_FROM, APP_NAME); //RESPONDER PARA
        $mail->setFrom(SET_FROM, APP_NAME); //DE ONDE ORIGINOU O EMAIL
        //
        $mail->addAddress($email_remetente, $nome_do_remetente);
        $mail->AddCC(ADD_CC, $nome_do_remetente);
        $mail->AddBCC(ADD_BCC, $nome_do_remetente);
        $mail->Subject  = $assunto;
        $mail->WordWrap = 78;
        $mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
        //
        @$mail->Send();

        if (!$mail) {
            return false;
        }
        //
        return true;
    }

    /**
     * Monta o corpo do email
     *
     * @param  O assunto do email
     * @param  O nome do remetente
     * @return string
     */
    private function getBody($assunto, $nome_do_remetente)
    {
        $current_date = date("d/m/Y H:i:s");
        //
        $b = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
        $b .= '<html>';
        $b .= '<head>';
        $b .= '<title>' . $assunto . '</title>';
        $b .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';
        $b .= '</head>';
        $b .= '<body>';
        $b .= '<a href="' . BASE_URL_IPAGE . '" target="_blank">';
        $b .= '<img src="' . BASE_URL_APP . 'images/logo_ipage.png" alt="' . EMPRESA . '"/>';
        $b .= '</a>';
        $b .= '<table width="100%" border="0" >';
        $b .= '<tr>';
        $b .= '<td align="left" valign="top">';
        $b .= '<font color="#3d3c3c" size="2" face="Verdana">' . CIDADE . ', ' . $current_date . '<br/><br/>';

        $b .= 'Oi ' . $nome_do_remetente . ',';
        $b .= '<br/><br/>';
        $b .= 'Alguém usou recentemente sua senha para fazer login na aplicação <b>' . APP_NAME . '</b>.';
        $b .= '<br/>';
        $b .= 'Essa pessoa estava usando um aplicativo como um navegador ou um dispositivo móvel do tipo:<br /> <b>' . $_SERVER['HTTP_USER_AGENT'] . '</b>.';
        $b .= '<br/>';
        $b .= 'Através do endereço de IP: <b>' . $_SERVER['REMOTE_ADDR'] . '</b>';
        $b .= '<br/>';
        $b .= '<br/>';
        //
        $b .= 'Se foi você, este email pode ser ignorado com segurança.';
        $b .= '<br/>';
        $b .= '<p>';
        $b .= 'Se não tiver certeza de que foi você, um usuário mal-intencionado pode ter sua senha.';
        $b .= '<br/>';
        $b .= 'Examine as atividades recentes e vamos ajudá-lo a realizar uma ação corretiva.';
        $b .= '<br/>';
        $b .= 'Faça login em: ' . URL . ', e redefina sua senha imediatamente.';
        $b .= '</p>';
        //
        $b .= '<br/><br/>';
        $b .= '<b>NOTA: NÃO É PRECISO RESPONDER ESTE EMAIL</b>';
        $b .= '<br/><br/><br/>';
        $b .= 'Sem mais para o momento, ';
        $b .= '<br/><br/>';
        $b .= 'Atenciosamente';
        $b .= '<br/>';
        $b .= 'Equipe da IPAGE - Sistema ' . APP_NAME . ' &reg;';
        $b .= '</font>';
        $b .= '<br/>';
        $b .= '<a href="' . BASE_URL_IPAGE . '" target="_blank">';
        $b .= '<img src="' . BASE_URL_APP . 'images/footer_411_x_271.png" alt="' . EMPRESA . '"/>';
        $b .= '</a>';
        $b .= '<br/>';
        $b .= '<div style="font-size: 10px;">';
        $b .= '<br/>';
        //
        $b .= 'Aplicação ';
        $b .= '<b>';
        $b .= TITLE;
        $b .= '</b>.';
        $b .= '<br/>';
        //
        $b .= 'Navegador do tipo ';
        $b .= '<b>' . $_SERVER['HTTP_USER_AGENT'] . '</b>.';
        $b .= '<br/>';
        $b .= 'Endereço de IP: <b>' . $_SERVER['REMOTE_ADDR'] . '</b>';
        $b .= '</div>';
        $b .= '</td>';
        $b .= '</tr>';
        $b .= '</table>';
        $b .= '</body>';
        $b .= '</html>';
        //
        return $b;
    }
}
