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
  require_once("class/EmpresaView.php");
  //
  $layout       = new App\Layout\LayoutClass();
  $EmpresaView = new EmpresaView();
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
                  <div class="col-sm-12">                        
                    <div class="form-group">
                        <label for="empresa_nome">* Nome:</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_nome']['valor']); ?>">
                    </div>
                  </div>
                  <!-- //-->                        
                </div>
                <!-- //-->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="empresa_email">Email:</label>
                      <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_email']['valor']); ?>">
                    </div>
                  </div>
                </div>
                <!-- //-->
                <div class="form-group">
                   <fieldset class="fieldset">
                      <legend>CEP:</legend>
                        <div class="form-group input-group" style="max-width: 310px;">                             
                          <input disabled="" style="text-align: center;" type="text"  placeholder="Informe o cep." class="form-control cep-numero" value="<?php echo($EmpresaView->myfields['empresa_cep']['valor']); ?>" >
                          <span class="input-group-btn"><button class="btn btn-default" type="button" id="btn_google_maps" data-toggle="tooltip" data-placement="top" title="Google Maps"><i class="fa fa-link"></i></button></span>
                      </div>                              
                    </fieldset>
                </div>                        
                <!-- //-->
                <div class="row">
                  <div class="col-sm-12">                       
                    <div class="form-group">
                      <label for="empresa_endereco">* Endereço:</label>
                      <input disabled="" type="text" class="form-control cep-endereco" value="<?php echo($EmpresaView->myfields['empresa_endereco']['valor']); ?>" >
                    </div>
                  </div>
                </div>
                <!-- //-->
                <div class="row">
                  <div class="col-sm-12">                        
                    <div class="form-group">
                      <label for="empresa_complemento">Complemento:</label>
                      <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_complemento']['valor']); ?>">
                    </div>
                  </div>
                </div>
                <!-- //-->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="empresa_bairro">* Bairro:</label>                              
                      <input disabled="" type="text" class="form-control cep-bairro" value="<?php echo($EmpresaView->myfields['empresa_bairro']['valor']); ?>" >
                    </div>
                  </div>
                </div>
                <!-- //-->                          
                <div class="row">
                  <div class="col-sm-10">
                    <div class="form-group">
                      <label for="empresa_cidade">* Cidade:</label>
                      <input disabled="" type="text" class="form-control cep-cidade" value="<?php echo($EmpresaView->myfields['empresa_cidade']['valor']); ?>" >
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-2">
                    <div class="form-group">
                      <label for="empresa_uf">* UF:</label>
                      <input disabled="" type="text" style="text-align: center;" class="form-control cep-uf" value="<?php echo($EmpresaView->myfields['empresa_uf']['valor']); ?>" >
                    </div>
                  </div>                          
                </div>
                <!-- //--> 
                <div class="tabbable tabbable-custom" id="tabs">
    							<ul class="nav nav-tabs">
    								<li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-phone"></i> Contato</a></li>
                    <li><a href="#tab_1_2" data-toggle="tab"><i class="fa fa-university"></i> Pessoa Jurídica</a></li>
                    <li><a href="#tab_1_3" data-toggle="tab"><i class="fa fa-info"></i> OBS</a></li>
    							</ul>                   
                	<div class="tab-content">
                		<div class="tab-pane active" id="tab_1_1">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="empresa_fone1">Telefone Fixo:</label>        
                            <input disabled="" type="text"  placeholder="Telefone Fixo 1" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_fone1']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="empresa_celular1">Telefone Celular:</label>
                            <input disabled="" type="text"  placeholder="Telefone Celular 1" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_celular1']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="empresa_contato1">Contato:</label>
                            <input disabled="" type="text"  placeholder="Contato 1" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_contato1']['valor']); ?>">
                          </div>
                        </div>                                                        
                      </div>
                      <!-- //-->
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">                                            
                            <input disabled="" type="text"  placeholder="Telefone Fixo 2" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_fone2']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Telefone Celular 2" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_celular2']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Contato 2" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_contato2']['valor']); ?>">
                          </div>
                        </div>
                      </div>
                      <!-- //-->
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">                                            
                            <input disabled="" type="text"  placeholder="Telefone Fixo 3" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_fone3']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Telefone Celular 3" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_celular3']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Contato 3" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_contato3']['valor']); ?>">
                          </div>
                        </div>
                      </div>
                      <!-- //-->
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">                                            
                            <input disabled="" type="text"  placeholder="Telefone Fixo 4" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_fone4']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Telefone Celular 4" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_celular4']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="col-sm-4">
                          <div class="form-group">                                    
                            <input disabled="" type="text"  placeholder="Contato 4" id="empresa_contato4" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_contato4']['valor']); ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- //-->
                		<div class="tab-pane" id="tab_1_2">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="empresa_razao_social">Razão Social:</label>        
                            <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_razao_social']['valor']); ?>">                                
                          </div>
                        </div>
                      </div>  
                      <!-- //-->
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="empresa_cnpj">CNPJ:</label>
                            <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_cnpj']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->     
                        <div class="col-sm-4">
                          <div class="form-group">                              
                            <label for="empresa_insc_est">INSC. Estadual:</label>
                            <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_insc_est']['valor']); ?>">
                          </div>
                        </div>
                        <!-- //-->     
                        <div class="col-sm-4">
                          <div class="form-group">                              
                            <label for="empresa_insc_mun">INSC. Municipal:</label>
                            <input disabled="" type="text" class="form-control" value="<?php echo($EmpresaView->myfields['empresa_insc_mun']['valor']); ?>">
                          </div>
                        </div>                                
                      </div>
                    </div>
                    <!-- //-->
                    <div class="tab-pane" id="tab_1_3">
                      <div class="form-group">
                        <label>Obs:</label>
                        <textarea disabled="" wrap="virtual" style="height:150px;width:100%;border-radius: 4px;"><?php echo($EmpresaView->myfields['empresa_obs']['valor']); ?></textarea>
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
                            <input disabled="" type="radio" value="1" checked>Ativo
                        </label>
                        <label class="radio-inline">
                            <input disabled="" type="radio" value="0" >Inativo
                        </label>
                    </fieldset>
                </div>
                <!-- //-->                                                 
                <div class="form-group">
                  <input type="hidden" class="form-control" value="<?php echo((int)$EmpresaView->myfields['empresa_id']['valor']); ?>">
                </div>
                <p>&nbsp;</p>                  
                <!-- //-->
                <button type="button" class="btn btn-success ipage-btn" onclick="javascript:window.location.href='application/views/cadastros/empresa/view.php<?= $layout->getParameter() ?>'">
                  <i class="fa fa-refresh"></i> Atualizar
                </button>
                <!-- //-->
                <button type="button" class="btn btn-primary ipage-btn" onclick="window.parent.location.href='empresa/addupdt/?parameter1=<?= $_GET['parameter1'] ?>'">
                  <i class="fa fa-pencil"></i> Editar
                </button>
                <button id="btn_cancel" type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Fechar</button>
                <p>&nbsp;</p>
          </div>
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  <!-- //--> 
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //--> 
  <script src="application/views/cadastros/empresa/js/EmpresaView.js" type="text/javascript"></script>
</body>
</html>
