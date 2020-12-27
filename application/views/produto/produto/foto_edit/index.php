<?php
    /**
     * @version    1.0
     * @package    produto
     * @subpackage Edição foto
     * @author     Diógenes Dias <diogenesdias@hotmail.com>
     * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
     * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
    */
    $nivel = "../../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once "class/FotoEdit.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral  = $layout->menuLateral('PRODUTO', 4); 
    //////////////////////////////////////////////////////////
    $class = new FotoEdit($nivel);
    $class->getReg();
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
    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
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
              <?php
                echo($class->createLinkMenu());
              ?>              
              <!-- /.row -->
              <div class="row">
                    <div class="col-sm-12">
                      <form action="application/views/produto/produto/foto_edit/ajax/produto.upload.ajax.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-3">
                            <?php
                              echo('<p><strong>Código Interno:</strong> ' . $class->produto_codigo_interno . '</p>');
                              echo('<p><strong>Descrição:</strong> ' . $class->produto_descricao . '</p>');
                              echo('<p><strong>Grupo:</strong> ' . $class->produto_grupo . '</p>');
                              echo('<p><strong>Unidade Medida:</strong> ' . $class->produto_um . '</p>');
                              echo('<p><strong>ID:</strong> ' . $class->produto_id . '</p>');                  
                            ?>
                           <div class="row">
                              <div  class="fileUpload btn btn-primary">
                                <span>Selecionar imagem</span>
                                <input type="file"  class="upload" name="fileUpload" id="fileUpload" width="10"><br />
                                <input type="hidden"  name="produto_id" id="produto_id" value="<?php echo($class->criterio); ?>">                            
                              </div>
                            </div>                          
                          </div>
                          <div class="col-sm-6">                          
                            <div class="form-group">
                              <img src="application/views/produto/produto/foto_edit/foto/<?php echo($class->produto_foto); ?>" class="foto-perfil" id="produto_foto"/><br />
                              <div class="progress" style="visibility: hidden;">
                                  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="60" 
                                    aria-valuemin="0" aria-valuemax="100" style="width: 0;">  
                                    <span id="prg_result"></span>                                  
                                  </div>
                              </div>                              
                            </div>                                                        
                          </div>                            
                        </div> 
                        <!-- //-->
                        <input type="hidden" class="form-control" id="token" name="token" value="">
                      </form>
                  </div>
              </div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->
  <!-- //-->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/produto/produto/foto_edit/js/FotoEdit.js" type="text/javascript"></script>
</body>
</html>
