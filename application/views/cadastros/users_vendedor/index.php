<?php
  /**
   * @version    1.0
   * @package    Cadastros
   * @subpackage usuários x Vendedor
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once "class/UsersVendedorIndex.php";
  //
  $layout       = new App\Layout\LayoutClass();
  $navBarHeader = $layout->topHeader();
  $menuLateral  = $layout->menuLateral('USERS_VENDEDOR', 1); 
  //////////////////////////////////////////////////////////
  $UsersVendedorIndex = new UsersVendedorIndex($nivel);
  $cbo_user = $UsersVendedorIndex->loadUsersIntoComboBox();
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
                          Usuário x Vendedor
                          <small> - <?php echo($layout->sid->getNode('procedencia_empresa'));?> </small>
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <li>
                            <i class="fa fa-refresh"></i> <a href="users_vendedor/">Atualizar</a>
                        </li>                                              
                        <li>
                            <i class="fa fa-plus"></i> <a href="javascript:void(0);" id="mnu_adicionar">Adicionar</a>
                        </li>
                        <li>
                            <i class="fa fa-trash"></i> <a href="javascript:void(0);" id="mnu_retirar">Retirar</a>
                        </li>
                        <!--
                        <li>
                            <i class="fa fa-plus"></i> <a href="javascript:void(0);" id="mnu_adicionar_todos">Adicionar Todos</a>
                        </li>                        
                        <li>
                            <i class="fa fa-trash"></i> <a href="javascript:void(0);" id="mnu_retirar_todos">Retirar Todos</a>
                        </li>
                        //-->
                      </ol>
                  </div>
              </div>
              <!-- /.row -->
              <div class="row">
                  <div class="col-md-9 col-md-offset-1">
                    <form class="form-horizontal" method="post" name="form1" id="form1">
                        <!-- Select -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="cbo_user">* Vendedor:</label>
                          <div class="col-md-6">                          
                            <select id="cbo_user" name="cbo_user" class="form-control">
                            <?php echo($cbo_user); ?> 
                            </select>
                          </div>
                        </div>                    
                        <!-- List1 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="list1">* Vendedor à Associar:</label>
                          <div class="col-md-6">
                      			<select class="form-control" size="5" name="list1" id="list1"  multiple="multiple"></select>
                            <p class="help-block" id="tot_reg1">Total de registro(s): 0</p>                        
                          </div>
                        </div>                    
                        <!-- List2 -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="list2">* Vendedor(s) Associado(s):</label>
                          <div class="col-md-6">
                      			<select class="form-control" size="5" id="list2" name="list2[]" multiple="multiple"></select>
                            <p class="help-block" id="tot_reg2">Total de registro(s): 0</p>  
                          </div>
                        </div>                    
                        <!-- Button (Double) -->
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="button1id">&nbsp;</label>
                          <div class="col-md-8">
                            <button type="submit" class="btn btn-success disabled ipage-btn" id="btn_salvar"><i class="fa fa-floppy-o"></i> Salvar</button>
                            <a href="users_vendedor/">
                            <button type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Cancelar</button>
                            </a>
                            <p>&nbsp;</p>
                          </div>
                        </div>
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
  <!-- //--> 
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //--> 
  <script src="application/views/cadastros/users_vendedor/js/UsersVendedor.js" type="text/javascript"></script>
</body>
</html>
