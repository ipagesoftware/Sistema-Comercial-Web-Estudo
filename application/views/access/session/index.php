<?php  
  //
  $nivel = "../../../../";
  use App\Seguranca\Security;
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php"; 
  //
  $layout   = new App\Layout\LayoutClass();
  $security = Security::getInstance();
  //
  $navBarHeader = $layout->topHeader();
  $menuLateral = $layout->menuLateral('HOME');
  //
  if($layout->sid->check()){
    // Estamos logados
    header( 'Location: ' . URL);
    exit();      
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
                            Atenção
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
                    <h1 style="color: #ec8c8c;margin-top:-30px;">Sua sessão expirou!</h1>
                    <p style="text-align: justify;">Será necessário realizar o login no sistema.</p>
                    <p style="text-align: justify;color: #ec5151;">
                      Nota: todas as requisições ocorridas no momento em que a sessão do usuário expirou 
                      foram desconsideradas e será necessário refazê-la após o login no sistema.</p>
                    <p>Para maiores informações, contacte o usuário administrador.<br />
                    (81) 9.8615-2352 / atendimento@ipage.com.br</p>
                    <a href="login/"  >
                    <button type="button" class="btn btn-success ipage-btn"><i class="fa fa-user"></i> Login</button>
                    </a>
                </div>
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <?php include_once $nivel . 'inc_js.php'; ?>
    <script src="application/views/index/js/Index.js" type="text/javascript"></script>
    <script>
      $(document).ready(function(){
        Index.sessionExpired();
      });

    </script>
</body>
</html>