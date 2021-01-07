<?php
//  ___   _        _                        
// / __| (_)  ___ | |_   ___   _ __    __ _ 
// \__ \ | | (_-< |  _| / -_) | '  \  / _` |
// |___/ |_| /__/  \__| \___| |_|_|_| \__,_|
//                                          
// Define o conjunto de caracteres a ser utilizado 
// Alterne entre UTF-8 e ISO-8859-1
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
//
// Define o caminho raiz da aplicação
define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
// Nome da aplicação que é exibido nas seguintes janelas:
// 1 - Título da janela de login
// 2 - Título da janela de Esqueci a Senha
// 3 - No header da aplicação no topo da página.
// 4 - No header da janela Sobre...
// 
define("APP_NAME", "SCW");
// Define a versão da aplição que é exibida no rodapé
define("VERSION", "2.0.3 Beta");
// Define o título da janela das páginas da aplicação
define("TITLE", APP_NAME . " - Sistema Comercial Web - versão. " . VERSION);
// Define a data da última atualização realizada no config da aplicação
define("LAST_DATE", " " . date("d M Y H:i:s", filemtime(ROOT . "config.php")));
// Definei a mensagem de Copyright que será exibida no rodapé da aplicação
define("COPY", date('Y') . " &copy; <a href=\"http://www.ipage.com.br\" target=\"_blank\">Ipage Software</a> - Todos os direitos reservados");
// Define o link para a cahamda ao webservice que irá validar a licença de uso desta aplicação
// Nota: NÃO MODIFICAR
define('URL_WEBSERVICE_SETTINGS', "https://www.ipage.com.br/framework/lavorox/accesskey/");
// Chave utilizada pelo método encrypt no arquivo function
define('COOKIE_KEY', 'TSZsyrf6FfqbyHCIpfnpqD771XxwBbGpujt07LFLhVeMNSQyzMCUsONC'); 
// Chave responsável pela licença de uso da aplicação
// para solicitar sua licença de uso, favor realizar um pré-cadastro no seguinte endereço:
// https://www.ipagesoftware.com.br/license_key/www/lic_pre_cadastro/
define("ACCESS_KEY", "COLOQUE AQUI O SUA CHAVE");
// Solicite a sua chave desta api no link abaixo:
// https://ipage.com.br/ipage/wskey_produto/
define("API_PRODUTOS", "1f1f510b7cf211ea8dca525400c9158a");
// Define o número da página inicial ao listar os registro na tabela
define('INITIAL_PAGINATION_NUMBER', 9);
// Define a seleção da paginação
define('PAGINATION', [INITIAL_PAGINATION_NUMBER, 3, 6, 9, 12, 25, 50, 100, 250, 'Todos os Reg.']);
 // 0 - Permite o menu de contexto ao se pressionar o botão direito do mouse
 // 1 - Bloqueio o menu de contexto ao se pressionar o botão direito do mouse
define('NO_RIGHT_MOUSE_BUTTON', 0);
// Retorna a url atual
define('URL_ATUAL', $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
// 0 - Entra na página que exibe as planilhas
// 1 - Entra direto na página cadastro
define('INITIAL_PAGE', 0);
// Exibe a animação da carga da página
define('WAIT', 1);
// 0 - Remove automaticamente a acentuação ao digitar algo nas caixas de texto
// 1 - Aceita caracteres acentuados na inserção e edição dos dados
define('ACENTUACAO', 0);
// 1 Habilita o módulo financeiro
define('FINANCAS', 1);
// 1 Habilita o módulo vendas
define('VENDAS', 1);
// Exibe mensagem da LGPD
define('LGPD', 0);
// Exibe o rodapé no final da página
define('FOOTER', 1);
// Define se estamos no modo desenvolvimento ou produção
if (strtolower($_SERVER['HTTP_HOST']) == 'localhost') {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
    // Modificar para a sua pasta local
    define('URL', 'http://localhost/scw-main/');
} else {
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'production');
    // Modificar para a pasta do seu servidor
    define('URL', 'https://www.seu_dominio.com.br');
}

// Define o caminho da página de aviso caso a sessão tenha expirado
define('SESSION_EXPIRED', URL . 'session_expired/');
// Define o tempo máximo de execução de um script, 
// o normal são de 30 segundos
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
//
switch (strtolower(ENVIRONMENT)) {
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
                                       
// Carrega as classes que são utilizadas em todas as páginas
if (!isset($nivel)) {
    $nivel = "";
}
//
require_once "{$nivel}vendor/autoload.php";
require_once "{$nivel}functions.php";
