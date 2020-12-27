<?php
$nivel = "";
require_once "{$nivel}config.php";    
require_once "{$nivel}vendor/autoload.php";
use App\About\About;
$sobre = About::getInstance();
$layout       = new App\Layout\LayoutClass();
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
    <style>
      .space60{
        height: 60px;
      }
      .title {
          position:fixed;
          top:0;
          background-color: #fff;
          width: 100%;
          height: 60px;
          padding: 10px;
          border-top: #e0e0e0 1px solid;
      }
      .footer {
          position:fixed;
          bottom:0;
          background-color: #fff;
          width: 100%;
          height: 60px;
          padding: 10px;
          border-top: #e0e0e0 1px solid;
      }   
    </style>
</head>
<body data-right-button="<?= NO_RIGHT_MOUSE_BUTTON ?>" data-url="<?= URL ?>" data-accesskey ="<?= ACCESS_KEY ?>" style="padding-right: 15px;padding-left: 15px;margin: 0 auto;padding-top: 0 !important;">
  <!-- Loader -->
  <?php $layout->wait(); ?>
  <!-- Loader -->
  <!-- Page Heading -->
  <div class="row geral">
      <div class="col-sm-9">
            <div class="row">
              <div class="col-sm-6">                        
                <div class="form-group">
           				<?= $sobre->getAddress(); ?>                             
                </div>
              </div>                        
            </div>                    
            <!-- //-->
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?= $sobre->getSystemInfo(); ?>
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?= $sobre->getSessionInfo(); ?>
                </div>
              </div>
            </div>            
            <!-- //-->
            <div class="row">
              <div class="col-sm-6">          
                  <?= $sobre->getDBInfo(); ?>
              </div>
              <!-- //-->
              <div class="col-sm-6">
                <div class="form-group">
                  <?= $sobre->getTableInfo(); ?>
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <?= $sobre->getUseLicense(); ?>
                </div>
              </div>
            </div>            
      </div>
  </div>
  <!-- /.container-fluid -->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //--> 
  <script>
    $(document).ready(function() {    
        $('#btn_fechar').click(function(e){
          e.preventDefault();
          window.parent.$("#myModal").modal('hide');
        });        
    });
  </script>
</body>
</html>
