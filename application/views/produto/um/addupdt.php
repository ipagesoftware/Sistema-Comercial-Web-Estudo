<?php
    /**
     * @version    1.0
     * @package    produto
     * @subpackage unidade de mededia
     * @author     Diógenes Dias <diogenesdias@hotmail.com>
     * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
     * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
    */
    $nivel = "../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once "class/UmAddUpdt.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral  = $layout->menuLateral('UM', 4); 
    //////////////////////////////////////////////////////////
    $UmAddUpdt = new UmAddUpdt($nivel);
    $ret = $UmAddUpdt->getValues();
    //
    if($ret=='OK'){
      $UmAddUpdt->getReg();
    }else{
      $UmAddUpdt->um_sigla = "";
      $UmAddUpdt->um_descricao = "";
      $UmAddUpdt->um_status=1;
      $UmAddUpdt->um_id=0;      
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
                            if($UmAddUpdt->um_id!=0){
                              echo('Editar Unidade Medida(' . $UmAddUpdt->um_id . ')');    
                            }else{
                              echo('Unidade Medida');
                            }
                          ?>
                          <small> - <?php echo($layout->sid->getNode('procedencia_empresa'));?> </small>
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($UmAddUpdt->um_id,10)!=0 && 
                                    $UmAddUpdt->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="um/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i> <a href="application/views/produto/um/addupdt.php">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="application/views/produto/um/">Planilha</a>
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
                         <div class="col-sm-3">                        
                            <div class="form-group">
                              <label>* Sigla:</label>
                              <input type="text" autocomplete="off"  placeholder="Digite apenas letras" name="um_sigla" id="um_sigla" data-toggle="tooltip" data-placement="bottom" title="Informe a sigla da unidade de medida." class="form-control" maxlength="3" value="<?php echo($UmAddUpdt->um_sigla); ?>" required="" autofocus="">
                            </div>
                          </div>                         
                          <div class="col-sm-6">                        
                            <div class="form-group">
                              <label>* Descrição:</label>
                              <input type="text" autocomplete="off"  placeholder="Digite apenas letras" name="um_descricao" id="um_descricao" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição da unidade de medida." class="form-control" maxlength="55" value="<?php echo($UmAddUpdt->um_descricao); ?>" required="" autofocus="">
                            </div>
                          </div>                        
                        </div>
                        <!-- //-->
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>Status:</legend>
                                <label class="radio-inline">
                                    <input type="radio" name="um_status" id="user_status1" value="1" <?php echo(intval(($UmAddUpdt->um_status))==1? 'checked':''); ?>>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="um_status" id="user_status2" value="0" <?php echo(intval(($UmAddUpdt->um_status))==0? 'checked':''); ?>>Inativo
                                </label>
                            </fieldset>
                        </div>
                        <!-- //-->                          
                        <div class="form-group">
                          <input type="hidden" name="um_id" id="um_id" class="form-control" value="<?php echo($UmAddUpdt->um_id); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="application/views/produto/um/">
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
  <!-- //-->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/produto/um/js/UmAddUpdt.js" type="text/javascript"></script>
</body>
</html>
