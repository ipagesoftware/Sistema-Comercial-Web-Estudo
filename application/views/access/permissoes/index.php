<?php  
    /**
     * @version    1.0
     * @package    Usuário
     * @subpackage Permissões
     * @author     Diógenes Dias <diogenesdias@hotmail.com>
     * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
     * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
    */
    $nivel = "../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once "class/PermissoesIndex.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral = $layout->menuLateral('HOME');  
    //
    $Permissoes = new PermissoesIndex($nivel);
    $ret = $Permissoes->getValues();
    //
    if($ret=='OK'){
      $Permissoes->getReg();
    }else{
      $Permissoes->user_login = "";
      $Permissoes->user_password = "";
      $Permissoes->user_nivel = "A";
      $Permissoes->user_email = "";
      $Permissoes->user_status = 1;
      $Permissoes->user_id = 0;   
    }
    //
    $required  = (intval($Permissoes->user_id)== 0)? ' required=""':"";  
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
                        Permissões Usuário
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Principal</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-refresh"></i> <a href="permissoes/">Atualizar</a>
                        </li>
                      </ol>
                  </div>
              </div>
              <!-- /.row -->
              <div class="row">
                  <div class="col-md-9 col-md-offset-1">
                      <form role="form" method="post" name="form1" id="form1">
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>* Usuário:</label>
                          			<select class="form-control" name="cbo_usuario" id="cbo_usuario">
                                <!--- CONTEÚDO CARREGADO POR AJAX //-->                          
                          			</select>
                                <p class="help-block" id="nivel_usuario">Nível Usuário</p>                              
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>* Tabela:</label>
                          			<select class="form-control" name="list_tabela" id="list_tabela">
                                <!--- CONTEÚDO CARREGADO POR AJAX //-->                          
                          			</select>
                                <p class="help-block" id="tot_reg">Total de Registro(s): <strong>0</strong></p>                              
                            </div>
                          </div>
                        </div>  
                        <!-- //-->
                        <div class="form-group">
                            <label>Permissões</label>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" name = "todos" id = "todos">TODOS
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" class="marcar" id="chk_inserir" name="chk_inserir">INSERIR
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" class="marcar" id="chk_editar" name="chk_editar">EDITAR
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" class="marcar" id="chk_excluir" name="chk_excluir">EXCLUIR
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" class="marcar" id="chk_imprimir" name="chk_imprimir">IMPRIMIR
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                  <input type="checkbox"  value="" class="marcar" id="chk_negar" name="chk_negar">NEGAR ACESSO
                              </label>
                            </div>

                        </div>                        
                        <!-- //-->                        
                        <div class="form-group">
                          <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo($Permissoes->user_id); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="button" class="btn btn-default disabled ipage-btn" id="btn_padrao"><i class="fa fa-check"></i> Padrão</button>
                        <button type="submit" class="btn btn-success disabled ipage-btn" id="btn_salvar"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="<?= URL ?>">
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
  <script src="application/views/access/permissoes/js/PermissoesIndex.js" type="text/javascript"></script>
</body>
</html>
