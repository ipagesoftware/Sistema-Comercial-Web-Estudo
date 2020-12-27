<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
use App\Recursos\Session;
use App\Seguranca\Security;
use App\Conexao\ConnClass;
class PermissoesUsuario
{
    private $pdo;
    private $nivel;
    private $criterio;
    /**
     * [__construct description]
     * @param [type] $nivel [description]
     */
    public function __construct($nivel)
    {
        $this->nivel    = $nivel;
        $this->pdo      = ConnClass::getInstance();
        $this->security = Security::getInstance();
        $this->sid      = Session::getInstance();
        $this->sid->start();
        //
        if (!$this->sid->check()) {
            // Usuário não logado
            die('Sua sessão expirou, será necessário logar-se no sistema novamente!');
        }
    }
    /**
     * [getValues description]
     * @return [type] [description]
     */
    public function getValues()
    {        
        // Realiza a segunda decomposição dos dados
        foreach ($_POST as $key => $value) {
            $_POST[$key] = htmlspecialchars($value);
        }
        
        if(!isset($_POST['criterio'])){
              $json = array('id'=>'cbo_usuario',
                            'msg'=>utf8_encode('Critério inválido, verifique!')
                            );
              return(json_encode($json));            
        }
        //        
        $this->criterio = $_POST['criterio'];
        return 'OK';
    }
    /**
     * [showUser description]
     * @param  string $criterio [description]
     * @return [type]           [description]
     */
    public function showUser($criterio = '')
    {
        if (strlen($criterio) == 0) {
            $criterio = $this->criterio;
        }
        //
        $pdo = $this->pdo->openDatabase();
        //
        if (!$pdo) {
            return 'Erro ao iniciar a conexão';
        }
        /**
         * DEFINE A CONSULTA
         */
        if ($criterio == '') {
            $sql = "SELECT `user_login`, `user_nivel`, `user_id` FROM user WHERE `user_status`=1 ORDER BY user_login;";
        } else {
            $sql = "SELECT `user_login`, `user_nivel`, `user_id` FROM user WHERE `user_login` LIKE '%$criterio%' AND `user_status` = 1 ORDER BY `user_login`;";
        }
        //
        $query = $pdo->prepare($sql);
        $query->execute();
        //VERIFICA SE TEM DADOS, SE A CONSULTA RETORNOU ALGUM REGISTRO
        if ($query->rowCount() > 0) {
            $json        = '[';
            $i           = 0;
            $recordcount = $query->rowCount();
            //
            while ($rs = $query->fetch(PDO::FETCH_BOTH)) {
                $i = $i + 1;
                $json .= '[{"descricao": "' . ucfirst($rs['user_login']) . '"},';
                $json .= '{"nivel": "' . strtoupper($rs['user_nivel']) . '"},';
                // 
                if ($i == $recordcount) {
                    $json .= '{"id": "' . $rs['user_id'] . '"}]';
                } else {
                    $json .= '{"id": "' . $rs['user_id'] . '"}],';
                }
            }
            //
            if (strlen($json) > 0) {
                $json .= ']';
                return $json;
            } else {
                return '[{"retorno": "Nenhum registro foi encontrado com o(s) dado(s) informado(s)!"}]';
            }
        } else {
            $sql  = '';
            $json = '[{"retorno": "Nenhum registro foi encontrado com o(s) dado(s) informado(s)!' . $sql . ' - ' . $criterio . '"}]';
            return $json;
        }
        //
        return 'ERROR';
    }
}