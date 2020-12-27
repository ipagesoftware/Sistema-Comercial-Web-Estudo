<?php
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Página inicial
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/  
require_once "config.php";
require_once "vendor/autoload.php";
//
$nivel = null;
$layout       = new App\Layout\LayoutClass();
$navBarHeader = $layout->topHeader();
$menuLateral  = $layout->menuLateral('HOME',1); 
$boasVindas   = $layout->boasVindas();
$panel        = $layout->createPanel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta>
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
          <?php echo($navBarHeader);
                echo($menuLateral); 
          ?>
      </nav>
      <div style="height: 50px;" class="ipage-line-feed"></div>
      <div id="page-wrapper">
          <div class="container-fluid">
              <!-- Page Heading -->
              <div class="row">
                  <div class="col-sm-12">
                      <h1 class="page-header">
                          Painel
                          <?php 
                            if($layout->sid->check()){
                              if (!$layout->sid->getNode('procedencia_id') OR !FINANCAS){
                                $t  = '<small> - ';
                                $t .= '<a href="sel_procedencia/">';
                                $t .= 'Selecionar Procedência';
                                $t .= '</a>';
                                $t .= '</small>';
                              }else{
                                $t  = '<small> - ';
                                $t .= '<a href="sel_procedencia/">';
                                $t .= $layout->sid->getNode('procedencia_empresa');
                                $t .= '</a>';
                                $t .= '</small>';
                              }
                              echo($t);
                            }
                          ?>
                      <div id="mydate"></div>
                      </h1>
                  </div>
                  <!-- //-->
              </div>
              <!-- /.row -->
              <?php
                echo($boasVindas);
                echo($panel);              
              ?>
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- / FOOTER -->
      <?= $layout->createFooter(); ?>
      <!-- END FOOTER -->  
      <!-- /#page-wrapper -->
  </div>
  <!-- //-->
  <?php $layout->createCookie(); ?>
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <!-- SEMPRE POR ÚLTIMO //-->
  <script src="application/views/index/js/Index.js" type="text/javascript"></script>    
</body>
</html>
