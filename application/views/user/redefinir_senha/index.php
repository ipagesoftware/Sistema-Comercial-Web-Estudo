<?php
    /**
     * @version    1.0
     * @package    usuário
     * @subpackage redefinir a senha
     * @author     Diógenes Dias <diogenesdias@hotmail.com>
     * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
     * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
    */
    $nivel = "../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once "class/RedefinirSenha.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral = $layout->menuLateral('HOME');
    //////////////////////////////////////////////////////////
    $class = new RedefinirSenha($nivel);
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
          <!-- /.navbar-collapse -->
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
                  <div class="col-md-8 col-md-offset-1">
                      <form role="form" method="post" name="form1" id="form1">
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Senha Atual:</label>
                              <input type="password" name="user_senha_atual" id="user_senha_atual" class="form-control" autofocus="" maxlength="50" value="" required="">
                            </div>
                          </div>
                        </div>
                          <!-- //-->
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">                            
                              <label>* Nova Senha:</label>
                              <input type="password" name="user_nova_senha" id="user_nova_senha" class="form-control" autofocus="" maxlength="50" value="" required="">
                              <p class="help-block mostra">Informe a senha</p>
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Confirmar Nova Senha:</label>
                              <input type="password" name="user_confirmar_senha" id="user_confirmar_senha" class="form-control" autofocus="" maxlength="50" value="" required="">
                              <p class="help-block confirme">Confirme a senha</p>
                            </div>
                          </div>
                          <!-- //-->
                        </div>  
                        <!-- //-->
                        <div class="form-group">
                          <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo($class->sid->getNode('user_id')); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-check"></i> Confirmar</button>
                        <a href="application/views/user/perfil/">
                        <button type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Cancelar</button>
                        </a>
                        <p>&nbsp;</p>
                        <input type="hidden" class="form-control" id="token" name="token" value="">
                      </form>
                  </div>
              </div>
              <!-- /.row -->

          </div>
          <!-- /.container-fluid -->

      </div>
      <!-- /#page-wrapper -->
      <!-- / FOOTER -->
      <?= $layout->createFooter(); ?>
      <!-- END FOOTER -->
  </div>
  <!-- /#wrapper -->
  <!-- //-->
  <?php $layout->createCookie(); ?>
  <!-- //-->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/user/redefinir_senha/js/RedefinirSenhaIndex.js" type="text/javascript"></script>
</body>
</html>
