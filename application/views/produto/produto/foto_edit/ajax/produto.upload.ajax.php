<?php
  /**
   * @version    1.0
   * @package    produto produto
   * @subpackage Edição foto
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  ini_set('upload_max_filesize', '2048');
  //
  $nivel = "../../../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  use App\Recursos\Session;
  use App\Conexao\ConnClass;
  //
  if(!$_SERVER['REQUEST_METHOD']=='POST'){
    if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__)){
      header("Location: " . $nivel . "401.php");
    }
  }
  //  
  $sid = Session::getInstance();
  $sid->start();
  //
  if(!$sid->check()){
    // Usuário não logado
    header( 'Location: ' . URL);      
  }  
  //
  $pasta = $nivel . 'application/views/produto/produto/foto_edit/foto/';
  /* formatos de imagem permitidos */ 
  $permitidos = array(".jpg", ".jpeg", ".gif", ".png");
  //
  if($_SERVER['REQUEST_METHOD']=='POST'){
    //
    if(count($_FILES)<=0){
      echo "USER_CANCEL;"; 
    }
    //
    $produto_id = $_POST['produto_id'];
    //
    if((int)$produto_id<=0){
      $produto_id = $sid->getNode('produto_id');
    }
    //
    $nome_imagem = $_FILES['fileUpload']['name']; 
    $tamanho_imagem = $_FILES['fileUpload']['size']; 
    $max_file_size = 2048;
    /* pega a extensão do arquivo */ 
    $ext = strtolower(strrchr($nome_imagem,"."));
    /* verifica se a extensão está entre as extensões permitidas */ 
    if(in_array($ext,$permitidos)){ 
      /* converte o tamanho para KB */ 
      $tamanho = round($tamanho_imagem / $max_file_size); 
      //
      if($tamanho < $max_file_size){ 
        //se imagem for até 1MB envia 
        $nome_atual = md5(uniqid(time())).$ext; 
        //nome que dará a imagem 
        $tmp = $_FILES['fileUpload']['tmp_name']; 
        //caminho temporário da imagem 
        /* se enviar a foto, insere o nome da foto no banco de dados */ 
        if(move_uploaded_file($tmp,$pasta.$nome_atual)){ 
            $pdo = ConnClass::getInstance();
            $conn = $pdo->openDatabase();
            //
            if(!$conn){
                return 'Erro ao iniciar a conexão';
            }
            $sql = "UPDATE produto SET produto_foto = '". $nome_atual . "' WHERE produto_id=" . $produto_id;
            //
            try{    
              $result = $conn->query($sql);
            }catch (PDOException $e) { 
              return $e->getMessage(); 
            }        
            //
            if(!$result){
              return "ERROR";
            }
            //
            echo 'OK;' . $nome_atual;
          }else{ 
            echo 'ERROR;'; 
          } 
        }else{ 
          echo "OVERFLOW;"; 
        } 
    }else{ 
        echo "INVALID_FORMAT_FILE;"; 
    } 
  }else{ 
    echo "EMPTY;"; 
    exit; 
  }
