<?php  
  /**
   * @version    1.0
   * @package    Cadastros
   * @subpackage Empresa
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once("class/ProcedenciaView.php");
  //
  $layout       = new App\Layout\LayoutClass();
  $ProcedenciaView = new ProcedenciaView(); 
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
<body data-criterio = "" data-right-button="<?= NO_RIGHT_MOUSE_BUTTON ?>" data-url="<?= URL ?>" data-accesskey ="<?= ACCESS_KEY ?>" data-acentuacao ="<?= ACENTUACAO ?>" style="margin-top: 10px">
  <!-- Loader -->
  <?php $layout->wait(); ?>
  <!-- Loader -->
  <div class="col-sm-12">
      <div class="row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                    <label for="procedencia_empresa">* Empresa:</label>
                    <input disabled="" type="text" name="procedencia_empresa" id="procedencia_empresa" class="form-control" maxlength="100" value="<?php echo($ProcedenciaView->myfields['procedencia_empresa']); ?>">
                </div>
              </div>
              <!-- //-->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="procedencia_email">Email:</label>
                  <input disabled="" type="text" name="procedencia_email" id="procedencia_email" class="form-control" maxlength="100" value="<?php echo($ProcedenciaView->myfields['procedencia_email']); ?>">
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="form-group">
               <fieldset class="fieldset">
                  <legend>CEP:</legend>
                    <div class="form-group input-group" style="max-width: 310px;">                             
                      <input disabled="" style="text-align: center;" type="text"  placeholder="Informe o cep." name="procedencia_cep" id="procedencia_cep" class="form-control cep-numero" maxlength="9" value="<?php echo($ProcedenciaView->myfields['procedencia_cep']); ?>" >
                      <span class="input-group-btn"><button class="btn btn-default" type="button" id="btn_google_maps" data-toggle="tooltip" data-placement="top" title="Google Maps"><i class="fa fa-link"></i></button></span>
                  </div>                              
                </fieldset>
            </div>                        
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">                       
                <div class="form-group">
                  <label for="procedencia_endereco">* Endereço:</label>
                  <input disabled="" type="text" name="procedencia_endereco" id="procedencia_endereco" class="form-control cep-endereco" maxlength="100" value="<?php echo($ProcedenciaView->myfields['procedencia_endereco']); ?>" >
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">                        
                <div class="form-group">
                  <label for="procedencia_complemento">Complemento:</label>
                  <input disabled="" type="text" name="procedencia_complemento" id="procedencia_complemento" class="form-control" maxlength="100" value="<?php echo($ProcedenciaView->myfields['procedencia_complemento']); ?>">
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="procedencia_bairro">* Bairro:</label>                              
                  <input disabled="" type="text" name="procedencia_bairro" id="procedencia_bairro" class="form-control cep-bairro" maxlength="30" value="<?php echo($ProcedenciaView->myfields['procedencia_bairro']); ?>" >
                </div>
              </div>
            </div>
            <!-- //-->                          
            <div class="row">
              <div class="col-sm-10">
                <div class="form-group">
                  <label for="procedencia_cidade">* Cidade:</label>
                  <input disabled="" type="text" name="procedencia_cidade" id="procedencia_cidade" class="form-control cep-cidade" maxlength="50" value="<?php echo($ProcedenciaView->myfields['procedencia_cidade']); ?>" >
                </div>
              </div>
              <!-- //-->
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="procedencia_uf">* UF:</label>
                  <input disabled="" type="text" style="text-align: center;" name="procedencia_uf" id="procedencia_uf" class="form-control cep-uf" maxlength="2" value="<?php echo($ProcedenciaView->myfields['procedencia_uf']); ?>" >
                </div>
              </div>                          
            </div>
            <!-- //--> 
            <div class="tabbable tabbable-custom" id="tabs">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-phone"></i> Contato</a></li>
                <li><a href="#tab_1_2" data-toggle="tab"><i class="fa fa-university"></i> Pessoa Jurídica</a></li>
              </ul>                   
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="procedencia_fone1">Telefone Fixo:</label>        
                        <input disabled="" type="text"  placeholder="Telefone Fixo 1" name="procedencia_fone1" id="procedencia_fone1" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_fone1']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="procedencia_celular1">Telefone Celular:</label>
                        <input disabled="" type="text"  placeholder="Telefone Celular 1" name="procedencia_celular1" id="procedencia_celular1" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_celular1']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="procedencia_contato">Contato:</label>
                        <input disabled="" type="text"  placeholder="Contato 1" name="procedencia_contato" id="procedencia_contato" class="form-control" maxlength="30" value="<?php echo($ProcedenciaView->myfields['procedencia_contato']); ?>">
                      </div>
                    </div>                                                        
                  </div>
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">                                            
                        <input disabled="" type="text"  placeholder="Telefone Fixo 2" name="procedencia_fone2" id="procedencia_fone2" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_fone2']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Telefone Celular 2" name="procedencia_celular2" id="procedencia_celular2" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_celular2']); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- //-->
                <div class="tab-pane" id="tab_1_2">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="procedencia_empresa">Empresa:</label>        
                        <input disabled="" type="text" name="procedencia_empresa" id="procedencia_empresa" class="form-control" maxlength="100" value="<?php echo($ProcedenciaView->myfields['procedencia_empresa']); ?>">                                
                      </div>
                    </div>
                  </div>  
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="procedencia_cnpj">CNPJ:</label>
                        <input disabled="" type="text" name="procedencia_cnpj" id="procedencia_cnpj" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_cnpj']); ?>">
                      </div>
                    </div>
                    <!-- //-->     
                    <div class="col-sm-6">
                      <div class="form-group">                              
                        <label for="procedencia_insc_est">INSC. Estadual:</label>
                        <input disabled="" type="text" name="procedencia_insc_est" id="procedencia_insc_est" class="form-control" maxlength="20" value="<?php echo($ProcedenciaView->myfields['procedencia_insc_est']); ?>">
                      </div>
                    </div>                               
                  </div>
                </div>
                <!-- //-->
              </div>
            </div>
            <!-- //-->
            <div class="form-group">
               <fieldset class="fieldset">
                  <legend>Status:</legend>
                    <label class="radio-inline">
                        <input disabled="" type="radio" name="procedencia_status" id="procedencia_status1" value="1" checked>Ativo
                    </label>
                    <label class="radio-inline">
                        <input disabled="" type="radio" name="procedencia_status" id="procedencia_status2" value="0" >Inativo
                    </label>
                </fieldset>
            </div>
            <!-- //-->                                                 
            <div class="form-group">
              <input type="hidden" name="procedencia_id" id="procedencia_id" class="form-control" value="<?php echo((int)$ProcedenciaView->myfields['procedencia_id']); ?>">
            </div>                        
            <p>&nbsp;</p>
            <!-- //-->
            <button type="button" class="btn btn-success ipage-btn" onclick="javascript:window.location.href='application/views/financeiro/procedencia/view.php<?= $layout->getParameter() ?>'">
              <i class="fa fa-refresh"></i> Atualizar
            </button>
            <!-- //-->
            <button type="button" class="btn btn-primary ipage-btn" onclick="window.parent.location.href='procedencia/addupdt/?parameter1=<?= $_GET['parameter1'] ?>'">
              <i class="fa fa-pencil"></i> Editar
            </button>
            <button id="btn_cancel" type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Fechar</button>
            <p>&nbsp;</p>
          </div>
      </div>
      <!-- /.row -->
  </div>
  <!-- /#wrapper -->
  <!-- //--> 
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/financeiro/procedencia/js/ProcedenciaView.js" type="text/javascript"></script>
</body>
</html>
