<?php  
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Mensagens de erro
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
  $nivel = "";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  use App\Seguranca\Security;
  //
  $layout       = new App\Layout\LayoutClass();
  $security     = Security::getInstance();
  //
  $navBarHeader = $layout->topHeader();
  $menuLateral = $layout->menuLateral('HOME');
  $parameter = "";
  $modulo = "Indefinido";
  //
  if(!isset($_GET['modulo'])){
    header("Location: " . URL);
  }else{
    $modulo = $security->decodeGET($_GET['modulo']);
  }
  //
  if(!isset($_GET['parameter'])){
    header("Location: " . URL);
  }else{
    $parameter = $security->decodeGET($_GET['parameter']);
  }

  if(intval($parameter)!=0){
    $parameter = '';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta>
  <base href="<?= URL; ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?= TITLE; ?></title>
  <!-- Bootstrap Core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/custom.css" rel="stylesheet">
  <!-- Morris Charts CSS -->
  <link href="assets/css/plugins/morris.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
  <link rel="shortcut icon" href="favicon.ico" />
</head>
<body data-criterio = "" data-right-button="<?= NO_RIGHT_MOUSE_BUTTON ?>" data-url="<?= URL ?>" data-accesskey ="<?= ACCESS_KEY ?>" data-acentuacao ="<?= ACENTUACAO ?>">
  <!-- Loader -->
  <?php $layout->wait(); ?>
  <!-- Loader -->

    <div id="wrapper" <?php echo($layout->paddingLeft); ?>>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php 
              echo($navBarHeader);
              echo($menuLateral);        
            ?>
        </nav>
        <div style="height: 50px;" class="ipage-line-feed"></div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Erro
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i><a href="<?= URL ?>"> Home</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main jumbotron for a primary marketing message or call to action -->
                <div class="jumbotron">                                        
                    <?php
                      echo('<h1 style="color: #ec8c8c;">Atenção, ocorreu um erro inesperado no módulo: <strong>' . $modulo . '</strong>.</p></h1>');
                      echo('<p style="text-align: justify;">' . $parameter .'.</p>');    
                    ?>
                    
                    <p>Para maiores informações, contacte o usuário administrador.<br />
                    (81) 9.8615-2352 / atendimento@ipage.com.br</p>
                </div>                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- //-->
    <?php $layout->createCookie(); ?>
    <?php include_once $nivel . 'inc_js.php'; ?>

    <script src="application/views/index/js/Index.js" type="text/javascript"></script>
</body>

</html>
