<?php
/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Perfil
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
ini_set('upload_max_filesize', '2048');
//
$nivel = "../../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";
require_once "../class/Perfil.php";
use App\Conexao\ConnClass;
use App\Recursos\Session;

if (!$_SERVER['REQUEST_METHOD'] == 'POST') {
    if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)) {
        header("Location: " . URL . "401.php");
    }
}
//
$Perfil = new Perfil();
$Perfil->garbageFiles($nivel . 'application/views/user/perfil/foto');
$sid = Session::getInstance();
$sid->start();
//
if (!$sid->check()) {
    // Usuário não logado
    header('Location: ' . SESSION_EXPIRED);
}
//
$pasta = $nivel . 'application/views/user/perfil/foto/';
/* formatos de imagem permitidos */
$permitidos = array(".jpg", ".jpeg", ".gif", ".png");
//
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //
    if (count($_FILES) <= 0) {
        echo "USER_CANCEL;";
    }
    $user_id = $_POST['user_id'];
    if ((int) $user_id <= 0) {
        $user_id = $sid->getNode('user_id');
    }
    //
    $nome_imagem    = $_FILES['fileUpload']['name'];
    $tamanho_imagem = $_FILES['fileUpload']['size'];
    $max_file_size  = 2048;
    /* pega a extensão do arquivo */
    $ext = strtolower(strrchr($nome_imagem, "."));
    /* verifica se a extensão está entre as extensões permitidas */
    if (in_array($ext, $permitidos)) {
        /* converte o tamanho para KB */
        $tamanho = round($tamanho_imagem / $max_file_size);
        if ($tamanho < $max_file_size) {
            //se imagem for até 1MB envia
            $nome_atual = md5(uniqid(time())) . $ext;
            //nome que dará a imagem
            $tmp = $_FILES['fileUpload']['tmp_name'];
            //caminho temporário da imagem
            /* se enviar a foto, insere o nome da foto no banco de dados */
            if (move_uploaded_file($tmp, $pasta . $nome_atual)) {
                $pdo  = ConnClass::getInstance();
                $conn = $pdo->openDatabase();
                //
                if (!$conn) {
                    return 'Erro ao iniciar a conexão';
                }
                $sql = "UPDATE user SET user_foto = '" . $nome_atual . "' WHERE user_id=" . $user_id;
                //
                try {
                    $result = $conn->query($sql);
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
                //
                if (!$result) {
                    return "ERROR";
                }
                //
                echo 'OK;' . $nome_atual;
            } else {
                echo 'ERROR;';
            }
        } else {
            echo "OVERFLOW;";
        }
    } else {
        echo "INVALID_FORMAT_FILE;";
    }
} else {
    echo "EMPTY;";
    exit;
}
