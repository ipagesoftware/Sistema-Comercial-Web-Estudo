<?php
  /**
   * @version    1.0
   * @package    produto
   * @subpackage fabricante
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
    $nivel = "../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once "class/FabricanteAddUpdt.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral  = $layout->menuLateral('FABRICANTE', 4); 
    //////////////////////////////////////////////////////////
    $FabricanteAddUpdt = new FabricanteAddUpdt($nivel);
    $ret = $FabricanteAddUpdt->getValues();
    //
    if($ret=='OK'){
      $FabricanteAddUpdt->getReg();
    }else{
      $FabricanteAddUpdt->fabricante_descricao = '';
      $FabricanteAddUpdt->fabricante_status = 1;
      $FabricanteAddUpdt->fabricante_id = 0;    
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
                          <?php
                            if($FabricanteAddUpdt->fabricante_id!=0){
                              echo('Editar Cadastro Fabricante(' . $FabricanteAddUpdt->fabricante_id . ')');    
                            }else{
                              echo('Fabricante');
                            }
                          ?>
                          <small> - <?php echo($layout->sid->getNode('procedencia_empresa'));?> </small>
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($FabricanteAddUpdt->fabricante_id,10)!=0 && 
                                    $FabricanteAddUpdt->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="fabricante/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i> <a href="fabricante/addupdt/<?= $layout->getParameter() ?>">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="fabricante/">Planilha</a>
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
                              <label>* Descrição:</label>
                              <input type="text" autocomplete="off"  placeholder="Digite apenas letras" name="fabricante_descricao" id="fabricante_descricao" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do fabricante." class="form-control" maxlength="55" data-mask="letter" data-error="Campo inválido ou inexistente, digite apenas letras!" value="<?php echo($FabricanteAddUpdt->fabricante_descricao); ?>" autofocus="">
                            </div>
                          </div>                        
                        </div>
                        <!-- //-->
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>Status:</legend>
                                <label class="radio-inline">
                                    <input type="radio" name="fabricante_status" id="user_status1" value="1" <?php echo(intval(($FabricanteAddUpdt->fabricante_status))==1? 'checked':''); ?>>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="fabricante_status" id="user_status2" value="0" <?php echo(intval(($FabricanteAddUpdt->fabricante_status))==0? 'checked':''); ?>>Inativo
                                </label>
                            </fieldset>
                        </div>
                        <!-- //-->                          
                        <div class="form-group">
                          <input type="hidden" name="fabricante_id" id="fabricante_id" class="form-control" value="<?php echo($FabricanteAddUpdt->fabricante_id); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="fabricante/">
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
  <script src="application/views/produto/fabricante/js/FabricanteAddUpdt.js" type="text/javascript"></script>
</body>
</html>
