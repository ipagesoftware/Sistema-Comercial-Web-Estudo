<?php
//  ___   _        _                        
// / __| (_)  ___ | |_   ___   _ __    __ _ 
// \__ \ | | (_-< |  _| / -_) | '  \  / _` |
// |___/ |_| /__/  \__| \___| |_|_|_| \__,_|
//                                          
header("Content-Type: text/html; charset=iso-8859-1", true);
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'portuguese');
ini_set('default_charset', 'ISO-8859-1');
//    _            _   _                     /\/|      
//   /_\    _ __  | | (_)  __   __ _   __   |/\/   ___ 
//  / _ \  | '_ \ | | | | / _| / _` | / _| / _` | / _ \
// /_/ \_\ | .__/ |_| |_| \__| \__,_| \__| \__,_| \___/
//         |_|                         )_)             
//
define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define("APP_NAME", "SCW");
define("VERSION", "2.0.3 Beta");
define("TITLE", APP_NAME . " - Sistema Comercial Web - versão. " . VERSION);
define("LAST_DATE", " " . date("d M Y H:i:s", filemtime(ROOT . "config.php")));
define("COPY", date('Y') . " &copy; <a href=\"http://www.ipage.com.br\" target=\"_blank\">Ipage Software</a> - Todos os direitos reservados");
// Não modificar
define('URL_WEBSERVICE_SETTINGS', "https://www.ipage.com.br/framework/lavorox/accesskey/");
// Não modificar
define('COOKIE_KEY', 'TSZsyrf6FfqbyHCIpfnpqD771XxwBbGpujt07LFLhVeMNSQyzMCUsONC'); 
// Chave responsável pela licença de uso
define("ACCESS_KEY", "ZW1haWw9ZGlvZ2VuZXNkaWFzQGhvdG1haWwuY29tJm5vbWU9RElPR0VORVMgRElBUyBERSBTT1VaQSBKUiZwbGFubz1MRUFSTklORyZhcHBfbmFtZT1TQ1cgLSBTaXN0ZW1hIENvbWVyY2lhbCBXZWIgKGVzdHVkbykmaWQ9MjA=");
#define("ACCESS_KEY", "COLOQUE AQUI O SUA CHAVE");
// Solicite a sua chave desta api no link abaixo:
// https://ipage.com.br/ipage/wskey_produto/
define("API_PRODUTOS", "1f1f510b7cf211ea8dca525400c9158a");

define('INITIAL_PAGINATION_NUMBER', 5);
define('NO_RIGHT_MOUSE_BUTTON', 0); //true/1 bloqueia o botão direito do mouse
define('URL_ATUAL', $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
// 1 Entra direto na página cadastro, 0 entra na página que exibe as planilhas
define('INITIAL_PAGE', 0);
// EXIBE A ANIMAÇÃO DA CARGA DA PÁGINA
define('WAIT', 1);
// 1 Aceita caracteres acentuados na inserção e edição
define('ACENTUACAO', 0);
// 1 Habilita o módulo financeiro
define('FINANCAS', 1);
// 1 Habilita o módulo vendas
define('VENDAS', 1);
// Exibe mensagem da LGPD
define('LGPD', 0);
// Exibe o rodapé no final da página
define('FOOTER', 1);
//
if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
} else {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
}

if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
    // Modificar para a sua pasta local
    define('URL', 'http://localhost/ipagesoftware.com.br/aulas_javascript/app/scw/github/www/');
} else {
    // Modificar para a pasta do seu servidor
    define('URL', 'https://www.seu_dominio.com.br');
}
//
define('SESSION_EXPIRED', URL . 'session_expired/');
// Define o tempo máximo do script o normal são de 30 segundos
ini_set("max_execution_time", 0);
//      ___              _                     
//     |   \   __ _   __| |  ___   ___         
//     | |) | / _` | / _` | / _ \ (_-<         
//     |___/  \__,_| \__,_| \___/ /__/         
                                         
//  ___                                        
// | __|  _ __    _ __   _ _   ___   ___  __ _ 
// | _|  | '  \  | '_ \ | '_| / -_) (_-< / _` |
// |___| |_|_|_| | .__/ |_|   \___| /__/ \__,_|
//               |_|   
//                        
define('EMPRESA', 'Ipage Software');
define("CIDADE", 'Jaboatão dos Guararapes');
define('BASE_URL_IPAGE', 'https://www.ipage.com.br');
define('FONE_ATENDIMENTO', '+55 (81) 9.8615-2352');
define('EMAIL_ATENDIMENTO', 'atendimento@ipage.com.br');
define('FONE_EMAIL_ATENDIMENTO', '<p style="text-align:justify;">Para maiores informações, entrar em contato através do nosso telefone ou email discriminado abaixo:<br /><br /><strong>' . FONE_ATENDIMENTO . ' / ' . EMAIL_ATENDIMENTO . '</strong></p>');
// Doações
define('DONATE', 'https://www.paypal.com/donate?hosted_button_id=KECM4WWLUNR5J');
//
//   ___                 __   _            
//  / __|  ___   _ _    / _| (_)  __ _     
// | (__  / _ \ | ' \  |  _| | | / _` |  _ 
//  \___| \___/ |_||_| |_|   |_| \__, | (_)
//                               |___/     
//      ___                  _   _         
//     | __|  _ __    __ _  (_) | |
//     | _|  | '  \  / _` | | | | |
//     |___| |_|_|_| \__,_| |_| |_|
//     
//Não coloque o e-mail do gmail porque emite uma mensagem de não certificado
define("SET_FROM", "[email_origem]@[nome_do_seu_dominio].com.br");
//Não coloque o e-mail do gmail porque emite uma mensagem de não certificado
define("HOST_EMAIL", "mail.[nome_do_seu_dominio].com.br");
define("ADD_REPLY_TO", "atendimento@ipagesoftware.com.br");
define("ADD_CC", "diogenesdias@hotmail.com");
define("ADD_BCC", "diogenesdias.dio@gmail.com");
define("EMAIL_PWD", "[senha_do_seu_email]");
// Envia email comunicando o login bem sucedido
define("SEND_EMAIL", 1);
//  ___            _                 
// | _ \  ___   __| |  ___   ___     
// |   / / -_) / _` | / -_) (_-<     
// |_|_\ \___| \__,_| \___| /__/     
//  ___              _          _      
// / __|  ___   __  (_)  __ _  (_)  ___
// \__ \ / _ \ / _| | | / _` | | | (_-<
// |___/ \___/ \__| |_| \__,_| |_| /__/
// 
define("TWITTER", 'https://twitter.com/ipage_software');
define("FACEBOOK", 'https://www.facebook.com/diogenes.dias.7');
define("LINKEDIN", 'https://br.linkedin.com/in/diógenes-dias-b1aa5335');
define("YOUTUBE", 'https://www.youtube.com/user/Ipagesoftware/videos');
define("BLOGGER", 'http://www.ipagesoftware.blogspot.com.br');
define("GITHUB", 'https://github.com/ipagesoftware/');
//
define('BASE_URL_APP', 'https://www.ipage.com.br/helpdesk/');
//  __  __                                                   
// |  \/  |  ___   _ _    ___  __ _   __ _   ___   _ _    ___
// | |\/| | / -_) | ' \  (_-< / _` | / _` | / -_) | ' \  (_-<
// |_|  |_| \___| |_||_| /__/ \__,_| \__, | \___| |_||_| /__/
//                                   |___/                   
define('UNEXPECTED_ERROR', 'Ocorreu um erro inesperado, tente mais tarde ou entre em contato com o usuário administrador.');
define('BEGINTRANS_ERROR', 'BeginTrans não foi iniciada, favor entrar em contato com o usuário administrador.');
define('ACCESS_DENIED', 'Sem permissão para executar esta tarefa, favor entrar em contato com o usuário administrador.');
define('RELATION_CHIP', 'Este registro está vinculado a um ou mais módulos, operação cancelada!');
define('USER_CONFLICT', 'Registro modificado por outro usuário, será necessário atualizar a página!');
define('ROBOT', 'Este cadastro pode ter sido preenchido automaticamente por um robô, impossível continuar');

//  ___                         /\/|           
// | __| __ __  __   ___   ___ |/\/   ___   ___
// | _|  \ \ / / _| / -_) (_-< / _ \ / -_) (_-<
// |___| /_\_\ \__| \___| /__/ \___/ \___| /__/
//                                              
if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
    define('MODE', 'DEVELOPMENT');
} else {
    define('MODE', 'PRODUCTION');
}
//
switch (MODE) {
    case 'DEVELOPMENT':
        ini_set('display_errors', 'On');
        error_reporting(E_ALL);
        break;
    case 'PRODUCTION':
        ini_set('display_errors', 'Off');
        error_reporting(0);
        break;
    default:
        ini_set('display_errors', 'Off');
        break;
}
//
ini_set('error_reporting', -1);
ini_set('log_errors', 'On');
ini_set('error_log', ROOT . 'log' . DIRECTORY_SEPARATOR . 'errors.log');
 //   ___   _                             
 //  / __| | |  __ _   ___  ___  ___   ___
 // | (__  | | / _` | (_-< (_-< / -_) (_-<
 //  \___| |_| \__,_| /__/ /__/ \___| /__/
                                       
 //  ___             _          /\/|      
 // | _ \  __ _   __| |  _ _   |/\/   ___ 
 // |  _/ / _` | / _` | | '_| / _` | / _ \
 // |_|   \__,_| \__,_| |_|   \__,_| \___/
                                       
// Carrega as classes padrão do projeto
if (!isset($nivel)) {
    $nivel = "";
}
//
require_once "{$nivel}vendor/autoload.php";
require_once "{$nivel}functions.php";