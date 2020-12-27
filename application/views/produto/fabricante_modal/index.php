<?php  
  /**
   * @version    1.0
   * @package    produto cadastro
   * @subpackage fabricante
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../..//";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";  
  require_once("class/FabricanteModal.php");
  //
  $layout       = new App\Layout\LayoutClass();
  //
  $FabricanteModal = new FabricanteModal();
  $FabricanteModal->fabricante_descricao = '';
  $FabricanteModal->fabricante_status = 1;
  $FabricanteModal->fabricante_id = 0;  
  //
  $cbo_natureza_op = $FabricanteModal->loadregIntoComboBox();
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
  <div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;margin-top: -80px !important; padding-top: 0 !important;">
      <!-- Page Heading -->
      <div class="row">
          <div class="col-md-9 col-md-offset-1">
              <form role="form" method="post" name="form1" id="form1">
                <!-- //-->
                <div class="row">
                  <div class="col-sm-6">                        
                    <div class="form-group">
                      <label>* Descrição:</label>                      
                      <input type="text" autocomplete="off"  placeholder="Digite apenas letras" name="fabricante_descricao" id="fabricante_descricao" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do fabricante." class="form-control" maxlength="55" data-mask="letter" data-error="Campo inválido ou inexistente, digite apenas letras!" value="<?php echo($FabricanteModal->fabricante_descricao); ?>" autofocus="">
                    </div>
                  </div>                        
                </div>
                <!-- //-->                          
                <div class="form-group">
                  <input type="hidden" name="fabricante_id" id="fabricante_id" class="form-control" value="<?php echo($FabricanteModal->fabricante_id); ?>">
                </div>                        
                <!-- //-->                
                <a href="application/views/produto/fabricante_modal/"><button type="button" class="btn btn-default ipage-btn"><i class="fa fa-refresh"></i> Atualizar</button></a>
                <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                <button type="button" class="btn btn-danger ipage-btn" id="btn_fechar"><i class="fa fa-times"></i> Fechar</button>                
                <p>&nbsp;</p>
                <input type="hidden" class="form-control" id="token" name="token" value="">
              </form>
          </div>
      </div>
      <!-- /.row -->

  </div>
  <!-- /.container-fluid -->
  <!-- //-->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/produto/fabricante_modal/js/FabricanteModal.js" type="text/javascript"></script>
</body>
</html>
