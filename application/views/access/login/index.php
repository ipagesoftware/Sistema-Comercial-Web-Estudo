<?php  
  /**
   * @version    1.0
   * @package    Acesso
   * @subpackage Login
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  use App\Recursos\Session;
  $layout       = new App\Layout\LayoutClass();
  $sid = Session::getInstance();
  $sid->start();
  //
  if($sid->check()){
    // Usuário já logado direciona para a 
    // página princial da aplicação
   header( 'Location: ' . URL);      
  }

  $wall_paper = array("wp_javascript.jpg", 
                  "wp_code_javascript.jpg", 
                  "wp_desktop.jpg", 
                  "wp2466010.jpg",
                  "javascript-js-ss-1920.jpg",
                );

  $index = (int)rand(0, sizeof($wall_paper)-1);
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
  <link rel="stylesheet" type="text/css" href="assets/css/loader.css">
  <link rel="shortcut icon" href="favicon.ico" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    body {
        background-image: url("application/views/access/login/images/<?= $wall_paper[$index] ?>");
        background-size: 100%;
        background-repeat: repeat;
    }      
  </style>
</head>
<body style="background-color: #222 !important;" data-criterio = "" data-right-button="<?= NO_RIGHT_MOUSE_BUTTON ?>" data-url="<?= URL ?>" data-accesskey ="<?= ACCESS_KEY ?>" data-financas ="<?= FINANCAS ?>">
  <!-- Loader -->
  <?php $layout->wait(); ?>
  <!-- Loader -->
  <div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4" id="panel-login">
            <div class="login-panel panel panel-default">
                <div class="panel-heading" style="height: 40px;">
                    <h3 style="margin-top: -5px;"><?php echo(APP_NAME);?> - Login</h3>                    
                </div>
                <div class="panel-body">
                  <form method="post" name="form1" id="form1">
                      <!-- //-->
                      <div class="form-group">
                          <!-- <label>Informe o endereço de email<span class="required">*</span></label> //-->
                          <input type="text" class="form-control" placeholder="E-mail" name="txtemail" id="txtemail" value="" autofocus="" autocomplete="off" >
                      </div>
                      <!-- //-->
                      <div class="form-group input-group">
                          <input type="password" class="form-control" placeholder="Senha Acesso" name="txtpwd" id="txtpwd" required="" value="">
                          <span class="input-group-btn">
                            <button class="btn btn-warning" type="button" id="toggle-password" style="width: 40px;" title="Exibir/ocultar senha"><i class="fa fa-eye" ></i></button>
                          </span>                          
                      </div>
                      <!-- //-->
                      <div class="form-group input-group">
                          <input type="text" autocomplete="off" class="form-control" placeholder="Código Acesso" name="txtkey" id="txtkey" maxlength="5" required="" data-last-input="1" value="">
                          <span class="input-group-btn">
                            <button class="btn btn-success" type="button" id="btn_captcha" style="width: 40px;" title="Atualizar Código Acesso"><i class="fa fa-refresh"></i></button>
                          </span>
                      </div>
                      <!-- //-->
                      <div class="form-group">
                        <img src="application/controles/captcha/pngimg.php" id="img-key" class="img-rounded" style="width:100%;height:50px;"/>
                      </div>
                       <!-- Change this to a button or input when using this as a form -->
                      <button type="button" class="btn btn-default ipage-btn" id="btn_novo"><i class="fa fa-file-o"></i> Novo</button>
                      <button type="button" class="btn btn-success ipage-btn" id="btn_login"><i class="fa fa-unlock"></i> Login</button>
                      <a href="<?= URL ?>">
                      <button type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Cancelar</button></a>
                      <button style="visibility: hidden;" type="submit"></button><br /><br />
                      <div class="checkbox">
                          <p>Esqueceu a Senha? <a href="esqueci_senha/">Clique aqui</a></p>
                      </div>
                      <input type="hidden" class="form-control" id="token" name="token" value="">
                  </form>  
                  <!-- BEGIN FOOTER -->
                  <div class="row">
                    <div class="col-md-10 col-lg-offset-1">      
                        <div style="text-align: center;">          
                          <span><?php echo(COPY . ' ver. '. VERSION . '-' .LAST_DATE); ?></span><br />          
                        </div>
                    </div>                        	
                  </div>  
                  <!-- END FOOTER -->                                      
                </div>                  
            </div>
        </div>
    </div>
  </div>
  <!-- JANELA MODAL PARA BLOQUEAR USUÁRIO -->
  <div class="modal fade" id="modal_lock_screen" tabindex="-1" role="dialog" data-keyboard="false", data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">        
          <h4 class="modal-title"><?php echo(TITLE);?><br />Acesso Bloqueado.</h4>
        </div>
        <div class="modal-body">
          <p>Número excessivo de tentativas de logar-se ao sistema, será necessário aguardar pelo seu desbloqueio em 5:00 min.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- FIM JANELA MODAL PARA BLOQUEAR USUÁRIO //-->
  <?php $layout->createCookie(); ?> 
  <!-- //-->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/access/login/js/LoginIndex.js" type="text/javascript"></script>
</body>
</html>