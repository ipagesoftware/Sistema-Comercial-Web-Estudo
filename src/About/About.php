<?php
/**
 *
 * @version    2020-02-27 09:58
 * @package    class
 * @subpackage About
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 *
 * @copyright  Copyright (c) 2020 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipage.com.br/
 */
namespace App\About;
use App\Conexao\ConnClass;
use \PDO;
//
class About
{
    private static $instance;
    public $company;
    //
    public function __construct()
    {
        $this->pdoLink = ConnClass::getInstance();
        //$this->sid = Session::getInstance();
        $this->company = $this->getInformationLic();
    }

    private function addText($value)
    {
        if (trim($value)) {
            return utf8_decode($value);
        }
    }

    /**
     * [getAddress description]
     * @return [type] [description]
     */
    public function getAddress()
    {
        $ret  = '<div class="row">';
        $ret .= '<div class="col-md-12">';
        $ret .= '<h4>';
        $ret .= APP_NAME .' - ver. '  . VERSION;
        $ret .= '</h4>';
        $ret .= '<div class="space20"></div>';
        $ret .= '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= '<p></p>';
        $ret .= '<h4>';
        $ret .= '<strong>';
        $ret .= 'Este software está licenciado para:';
        $ret .= '</strong>';
        $ret .= '</h4>';
        $ret .= '<h4>';
        $ret .= $this->company['cliente_razao_social'];
        $ret .= '</h4>';
        //
        $str   = array();
        $str[] = $this->addText($this->company['cliente_endereco']);
        $str[] = $this->addText($this->company['cliente_bairro']);
        $str[] = $this->addText($this->company['cliente_cidade']);
        $str[] = $this->addText($this->company['cliente_uf']);
        $str[] = $this->addText($this->company['cliente_cep']);
        $str[] = $this->addText($this->company['cliente_telefone1']);
        $str[] = $this->addText($this->company['cliente_celular1']);
        // removes all NULL, FALSE and Empty Strings but leaves 0 (zero) values
        $result = array_filter($str, 'strlen');
        //
        if (sizeof($result)) {
            $ret .= implode(' - ', $result);
        }
        //
        if (substr_count($this->company['cliente_email'], '@')) {
          $ret .= '<br>';
          $ret .= '<a href="mailto:' . $this->company['cliente_email'] . '">';
          $ret .= 'Email: ' . $this->company['cliente_email'];
          $ret .= '</a>';
        }
        //
        $ret .= "</div>";
        $ret .= "</div>";
        $ret .= "</div>";
        return $ret;
    }

    /**
     * [getSystemInfo description]
     * @return [type] [description]
     */
    public function getSystemInfo()
    {

        $ret  = '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= '<h4>';
        $ret .= '<strong>';
        $ret .= 'Informações Básicas Sobre o Sistema';
        $ret .= '</strong>';
        $ret .= '</h4>';
        $ret .= '<p>';
        $ret .= 'Nome Dispositivo: ' . gethostname();
        $ret .= '<br>';
        $ret .= 'Sistema Operacional: ' . php_uname();
        $ret .= '<br>';
        $ret .= 'IP.: ' . $_SERVER['REMOTE_ADDR'];
        $ret .= '<br>';
        $ret .= 'Pasta Temporária: ' . sys_get_temp_dir();
        $ret .= '</p>';
        $ret .= '</address>';
        $ret .= '</div>';
        return $ret;
    }

    /**
     * [getDataSoftware description]
     * @return [type] [description]
     */
    public function getDataSoftware()
    {
        $license = new configLicense();
        $str     = array($license->config['appName'], $license->config['version'], $license->config['release']);
        return implode(' / ', $str);
    }

    /**
     * [getUseLicense description]
     * @return [type] [description]
     */
    public function getUseLicense()
    {
        $str = array();

        if (trim($this->company['cliente_plano'])) {
            $str[] = 'Plano: ' . $this->company['cliente_plano'];
        }

        if (trim($this->company['cliente_data_vencimento'])) {
            if (!is_null($this->company['cliente_access_key'])) {
                $str[] = 'Validade: '
                . date("d/m/Y", strtotime($this->company['cliente_data_vencimento']));
            }
            // Calcula o número de dias
            $dias = $this->daysRemaning();
            //
            if ((int) $dias > 1) {
                $tmp = "Faltam <strong>%s</strong> dias para a sua licença expirar.";
            } else if ((int) $dias == 1) {
                $tmp = "Sua licença de uso expira hoje às <strong>23:59</strong> horas!";
            } else if ((int) $dias == 0) {
                $tmp = "<strong>Sua licença de uso expirou!</strong>";
            } else {
                $dias = abs($dias);
                $tmp  = "Sua licença expirou a <strong>%s</strong> dia(s).";
            }
            //
            $str[] = sprintf($tmp, $dias);
        }
        //
        $ret  = '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= "<h4><strong>Informações Licença Uso</strong></h4>";
        $ret .= implode('<br />', $str);
        $ret .= '</address>';
        $ret .= '</div>';
        return $ret;
    }

    /**
     * [createContent description]
     * @param  boolean $echo [description]
     * @return [type]        [description]
     */
    public function createContent($echo = true)
    {
        $msg  = $this->getUseLicense();
        $info = "<h4>Informações Licença Uso</h4>";

        if (DAYS_REMANING > 10) {
            return null;
        }
        //
        switch (DAYS_REMANING) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                $class_alert = 'alert-danger';
                break;
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                $class_alert = 'alert-warning';
                break;
            case 11:
            case 12:
            case 13:
            case 14:
            case 15:
                $class_alert = 'alert-info';
                break;
            default:
                $lnk = "&msg=" . $msg;
                $lnk .= "&tp=error";
                $lnk .= "&lnk=logar/?logout";
                $lnk .= "&tmo=60"; //Tempo em segundos
                $ret = securityHelper::encodeGET($lnk);
                //
                header('Location: ' . URL . 'message.php?p=' . $ret);
                exit();
                break;
        }
        //
        $p           = array(new htmlElement("p"));
        $p[0]->style = "text-align:justify;word-wrap: break-word;";
        $p[0]->add($msg);
        //
        // EXIBE AVISO APLICAÇÃO FORA EXPEDIENTE
        //
        $alert = new htmlAlert();
        $item  = array('close' => true,
            'text'                 => $p[0]->render(),
            'class'                => 'alert ' . $class_alert,
            'title'                => 'Atenção',
        );
        //
        $alert->addItem($item);
        //
        if ($echo) {
            $alert->render($echo);
        } else {
            return $alert->render(null);
        }
    }
    /**
     * [daysRemaning description]
     * @return [type] [description]
     */
    public function daysRemaning()
    {
        // Calcula o número de dias
        $enddate      = strtotime($this->company['cliente_data_vencimento']);
        $dt1          = strtotime(date('Y-m-d'));
        $seconds_diff = $enddate - $dt1;
        return floor($seconds_diff / 3600 / 24);
    }
    /**
     * [getDBInfo description]
     * @return [type] [description]
     */
    public function getDBInfo()
    {
        $ret  = '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= '<h4>';
        $ret .= '<strong>';
        $ret .= 'Informações Sobre a Conexão ao Banco de dados';
        $ret .= '</strong>';
        $ret .= '</h4>';
        $ret .= '<p>';
        $ret .= 'Servidor: ' . $this->pdoLink->servidor;
        $ret .= '<br>';
        $ret .= 'Banco de dados: ' . $this->pdoLink->database;
        $ret .= '<br>';
        $ret .= 'Versão banco de dados: ' . $this->getVersionDataBase();
        $ret .= '</p>';
        $ret .= '</address>';
        $ret .= '</div>';
        return $ret;
    }

    /**
     * Retorna a versão do banco de dados
     * atualmente ativo
     *
     * @return [string]
     */
    private function getVersionDataBase()
    {
        $pdo = $this->pdoLink->openDatabase();
        $sql = "SELECT VERSION() AS version;";
        $query = $pdo->prepare($sql);
        $query->execute();
        $stmt = $query->fetch(PDO::FETCH_OBJ);        
        //
        if ($query->rowCount()) {
            return $stmt->version;
        }
        return 0;
    }

    /**
     * Método para retornar informações da licença de uso
     * registrada para o cliente com o token definido na
     * constante ACCESS_KEY
     * Nota: Se o registro não foi encontrado ou o
     * cliente estiver bloqueado, o método retorna null
     * @return [array]
     *
    'cliente_id' => string '1' (length=1)
    'cliente_pessoa' => string '1' (length=1)
    'cliente_razao_social' => string 'AFONSO MACHADO REPRESENTACOES LTDA' (length=34)
    'cliente_nome_fantasia' => string 'AFONSO MACHADO REPRESENTACOES LTDA' (length=34)
    'cliente_email' => string 'diogenesdias.dio@gmaiil.com' (length=27)
    'cliente_home_page' => string 'www.afonsomachadorep.com' (length=24)
    'cliente_cep' => string '50050-000' (length=9)
    'cliente_endereco' => string 'RUA DA AURORA' (length=13)
    'cliente_complemento' => string 'SALA: 502; CXPST: 668;' (length=22)
    'cliente_num' => string '295' (length=3)
    'cliente_apto' => string '' (length=0)
    'cliente_bloco' => string '' (length=0)
    'cliente_edf' => string '' (length=0)
    'cliente_bairro' => string 'BOA VISTA' (length=9)
    'cliente_cidade' => string 'RECIFE' (length=6)
    'cliente_uf' => string 'PE' (length=2)
    'cliente_cnpj' => string '10.559.052/0001-56' (length=18)
    'cliente_insc_est' => string '' (length=0)
    'cliente_cpf' => string '' (length=0)
    'cliente_rg' => string '' (length=0)
    'cliente_atividade_principal' => string 'REPRESENTANTES COMERCIAIS E AGENTES DO COMERCIO DE TEXTEIS, VESTUARIO, CALCADOS E ARTIGOS DE VIAGEM - 46.16-8-00' (length=112)
    'cliente_natureza_juridica' => string '206-2 - SOCIEDADE EMPRESARIA LIMITADA' (length=37)
    'cliente_tipo' => string 'MATRIZ' (length=6)
    'cliente_situacao' => string 'ATIVA' (length=5)
    'cliente_abertura' => string '0000-00-00' (length=10)
    'cliente_telefone1' => string '81 3082-9165' (length=12)
    'cliente_celular1' => string '81 9.9111-9010' (length=14)
    'cliente_contato1' => string '' (length=0)
    'cliente_telefone2' => string '81 3034-7593' (length=12)
    'cliente_celular2' => string '' (length=0)
    'cliente_contato2' => string '' (length=0)
    'cliente_telefone3' => string '00 8132-556938' (length=14)
    'cliente_celular3' => string '' (length=0)
    'cliente_contato3' => string '' (length=0)
    'cliente_telefone4' => string '' (length=0)
    'cliente_celular4' => string '' (length=0)
    'cliente_contato4' => string '' (length=0)
    'cliente_access_key' => string 'ZW1haWw9ZGlvZ2VuZXNkaWFzLmRpb0BnbWFpaWwuY29tJm5vbWU9QUZPTlNPIE1BQ0hBRE8gUkVQUkVTRU5UQUNPRVMgTFREQSZwbGFubz1FTlRFUlBSSVNFJmFwcF9uYW1lPVNpc3RlbXJlcCZpZD0x' (length=152)
    'cliente_data_vencimento' => string '2021-12-31' (length=10)
    'cliente_plano' => string 'ENTERPRISE' (length=10)
    'cliente_app_name' => string 'Sistemrep' (length=9)
    'cliente_plano_id' => string '4' (length=1)
    'cliente_secret_key' => string 'INpgHdTi' (length=8)
    'cliente_status' => string '1' (length=1)
    'cliente_last_date' => string '2020-08-05' (length=10)
    'cliente_last_time' => string '12:01:59' (length=8)
    'days_remaning' => int 513
     *
     *
     */
    private function getInformationLic()
    {
        $arr = [];
        $url = URL_WEBSERVICE_SETTINGS . "about.php";
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 0); //0 for a get request
        //
        $fields   = array('p' => ACCESS_KEY);
        $postvars = http_build_query($fields);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
        $ret = json_decode(curl_exec($ch));
        //
        if (is_null($ret)) {
            $arr['cliente_id']                  = 0;
            $arr['cliente_pessoa']              = 0;
            $arr['cliente_razao_social']        = 'Registro não encontrado';
            $arr['cliente_nome_fantasia']       = null;
            $arr['cliente_email']               = null;
            $arr['cliente_home_page']           = null;
            $arr['cliente_cep']                 = null;
            $arr['cliente_endereco']            = null;
            $arr['cliente_complemento']         = null;
            $arr['cliente_num']                 = null;
            $arr['cliente_apto']                = null;
            $arr['cliente_bloco']               = null;
            $arr['cliente_edf']                 = null;
            $arr['cliente_bairro']              = null;
            $arr['cliente_cidade']              = null;
            $arr['cliente_uf']                  = null;
            $arr['cliente_cnpj']                = null;
            $arr['cliente_insc_est']            = null;
            $arr['cliente_cpf']                 = null;
            $arr['cliente_rg']                  = null;
            $arr['cliente_atividade_principal'] = null;
            $arr['cliente_natureza_juridica']   = null;
            $arr['cliente_tipo']                = null;
            $arr['cliente_situacao']            = null;
            $arr['cliente_abertura']            = null;
            $arr['cliente_telefone1']           = null;
            $arr['cliente_celular1']            = null;
            $arr['cliente_contato1']            = null;
            $arr['cliente_telefone2']           = null;
            $arr['cliente_celular2']            = null;
            $arr['cliente_contato2']            = null;
            $arr['cliente_telefone3']           = null;
            $arr['cliente_celular3']            = null;
            $arr['cliente_contato3']            = null;
            $arr['cliente_telefone4']           = null;
            $arr['cliente_celular4']            = null;
            $arr['cliente_contato4']            = null;
            $arr['cliente_access_key']          = null;
            $arr['cliente_data_vencimento']     = date('Y-m-d');
            $arr['cliente_plano']               = null;
            $arr['cliente_app_name']            = null;
            $arr['cliente_plano_id']            = 0;
            $arr['cliente_secret_key']          = null;
            $arr['cliente_status']              = 0;
            $arr['cliente_last_date']           = date('Y-m-d');
            $arr['cliente_last_time']           = date('H:i:s');
            $arr['days_remaning']               = 0;
            return $arr;
        }
        //
        return (array) $ret;
    }

    /**
     * [getSessionInfo description]
     * @return [type] [description]
     */
    public function getSessionInfo()
    {

        $ret  = '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= '<h4>';
        $ret .= '<strong>';
        $ret .= 'Informações Básicas Sobre Variáveis Sessão';
        $ret .= '</strong>';
        $ret .= '</h4>';
        $ret .= '<p>';
        
        foreach ($_SESSION as $key=>$value){
            if(is_array($value)){
                foreach ($value as $key2=>$value2){
                    $ret .=  $key . ' ' . $key2 . ': '. $value2;
                    $ret .= "<br>";
                }
            }else{
                $ret .= $key . ': '. $value;
                $ret .= "<br>";                    
            }
        }

        $ret .= '</p>';
        $ret .= '</address>';
        $ret .= '</div>';

        return $ret;
    }

    public function getTableInfo()
    {

        $ret  = '<div class="well">';
        $ret .= '<address style="word-wrap: break-word !important">';
        $ret .= '<h4>';
        $ret .= '<strong>';
        $ret .= 'Informações Básicas Sobre Tabelas';
        $ret .= '</strong>';
        $ret .= '</h4>';
        $ret .= '<p>';
        $this->pdo = ConnClass::getInstance();
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }

        $query = $pdo->prepare("SHOW TABLES;");
        $query->execute();
        $rs = $query->fetch(PDO::FETCH_BOTH);

        while ($rs = $query->fetch(PDO::FETCH_BOTH)){
            $ret .= $rs[0];
            $ret .= "<br>";
        }

        $ret .= 'Total: ' . $query->rowCount();
        $ret .= "<br>";
        $ret .= '</p>';
        $ret .= '</address>';
        $ret .= '</div>';

        return $ret;
    }

    /**
     * [getInstance description]
     * @return [type] [description]
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
