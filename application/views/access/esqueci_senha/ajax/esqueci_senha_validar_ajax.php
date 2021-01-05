<?php
/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Esqueci a Senha
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
$nivel = '../../../../../';
require_once "{$nivel}config.php";
//
use App\Conexao\ConnClass;
use App\Recursos\Session;
require_once $nivel . 'application/controles/email/PHPMailerAutoload.php';
require_once '../class/EsqueciSenhaValidar.php';
//
$sid     = Session::getInstance();
$conn    = ConnClass::getInstance();
$validar = new EsqueciSenhaValidar();
//
$module = "Cliente";
$r      = rand(1000, 5000);
//
$js = '<script>';
$js .= 'window.parent.location.href="' . URL . '";';
$js .= '</script>';
//
$sid->start();
//
if ($sid->check()) {
    // Já estamos logados
    exit($js);
}
//
$ret = $validar->getValues();
//
if ($ret != 'OK') {
    die($ret);
}
//
$pdo = $conn->openDatabase();
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
$sql .= "user_email='{$validar->email}'";
//
$query = $pdo->prepare($sql);
$query->execute();
$rs = $query->fetch(PDO::FETCH_BOTH);
//
if ($query->rowCount() > 0) {
    if ($rs['user_status'] == 0) {
        $json = array('id' => 'txtemail',
            'msg'=> utf8_encode('O usuário informado está desabilitado temporariamente. <br>Entre em contato com o usuário administrador para maiores informações!'),
        );
        die(json_encode($json));
    }
    // DEFINO AS VARIÁVEIS DA SESSÃO PARA O LOGIN
    sendEmail($rs['user_email'], $rs['user_login'], $rs['user_email'], $validar->newpwd);
    /** ATUALIZO A BASE DE DADOS */
    $sql = "UPDATE ";
    $sql .= "user ";
    $sql .= "SET ";
    $sql .= "user_password='" . encrypt($validar->newpwd) . "' ";
    $sql .= "WHERE ";
    $sql .= "user_email='" . strtolower(strip_tags($rs['user_email'])) . "'";
    //
    try {
        $result = $pdo->query($sql);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    //
    die('OK');
} else {
    $json = array('id' => 'txtemail',
        'msg'=> utf8_encode('Usuário ou senha inválidos, verifique!'),
    );
    die (json_encode($json));
}

/**
 * Envia um e-mail com os dados da nova senha
 * @param  [type] $email             [description]
 * @param  [type] $nome_do_remetente [description]
 * @param  [type] $email_remetente   [description]
 * @param  [type] $newpwd            [description]
 * @return um inteiro se for -4 ocorreu um erro no envio do email
 */
function sendEmail($email, $nome_do_remetente, $email_remetente, $newpwd)
{
    if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
        return;
        $json = array('id' => 'txtemail',
            'msg'=> utf8_encode('O envio do e-mail só é possível em um servidor web.'),
        );
        die(json_encode($json));
    }
    //
    // Envia um e-mail para o usuário com a confirmação da operação
    //
    $nome_do_remetente = ucwords(strtolower($nome_do_remetente));
    $emaildestinatario = $email;
    $assunto           = EMPRESA . ' - Sistema ' . APP_NAME . '/ Redefinir a Senha.';
    // Corpo do documento html
    $body = getBody($assunto, $nome_do_remetente, $email_remetente, $newpwd);
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
    $mail->Username   = "no-reply@ipagesoftware.com.br";
    $mail->Password   = EMAIL_PWD;
    //
    $mail->addReplyTo("no-reply@ipagesoftware.com.br", APP_NAME); //RESPONDER PARA
    $mail->setFrom("no-reply@ipagesoftware.com.br", APP_NAME); //DE ONDE ORIGINOU O EMAIL
    //
    $mail->addAddress($email_remetente, $nome_do_remetente);
    $mail->AddCC(ADD_CC, $nome_do_remetente);
    $mail->AddBCC(ADD_BCC, $nome_do_remetente);
    $mail->Subject  = $assunto;
    $mail->WordWrap = 78;
    $mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
    //
    $mail->Send();

    if (!$mail) {
        $json = array('id' => 'txtemail',
            'msg'=> utf8_encode('Ocorreu um erro ao enviar o email de confirmação do login, tente mais tarde!'),
        );
        die(json_encode($json));        
    }
}

/**
 * Retorna o corpo do email
 * @param  [type] $assunto           [description]
 * @param  [type] $nome_do_remetente [description]
 * @param  [type] $email_remetente   [description]
 * @param  [type] $newpwd            [description]
 * @return string
 */
function getBody($assunto, $nome_do_remetente, $email_remetente, $newpwd)
{
    //
    $current_date = date("d/m/Y H:i:s");
    $mensagem     = "Esqueci a Senha.";
    //
    $b = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">';
    $b .= '<html>';
    $b .= '<head>';
    $b .= '<title>' . $assunto . '</title>';
    $b .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';
    $b .= '</head>';
    $b .= '<body>';
    $b .= '<a href="' . BASE_URL_IPAGE . '" target="_blank">';
    $b .= '<img src="' . BASE_URL_APP . 'images/logo_ipage.png" alt="Ipage Software"/>';
    $b .= '</a>';
    $b .= '<table width="100%" border="0" >';
    $b .= '<tr>';
    $b .= '<td align="left" valign="top">';
    $b .= '<font color="#3d3c3c" size="2" face="Verdana">' . CIDADE . ', ' . $current_date . '<br/><br/>';

    $b .= 'AT.: Sr(a) ' . $nome_do_remetente;
    $b .= '<br/><br/>';
    $b .= 'Prezados Senhores,';
    $b .= '<br/>';
    $b .= '<br/>';
    $b .= 'Abaixo estamos lhe informando a sua nova senha de acesso.';
    $b .= '<br/>';
    $b .= '<br/>';
    $b .= 'Assunto: ' . $mensagem;
    $b .= '<br/>';
    $b .= 'Remetente: ' . $nome_do_remetente;
    $b .= '<br/>';
    $b .= 'Email remetente: ' . $email_remetente;
    $b .= '<br/>';
    $b .= 'Nova Senha: ' . $newpwd;
    $b .= '<br/>';
    $b .= '<a href="' . BASE_URL_APP . '?logout=true" target="_blank">Clique aqui</a>';
    $b .= ' para realizar o login.';
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
