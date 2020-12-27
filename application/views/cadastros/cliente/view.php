<?php  
  /**
   * @version    1.0
   * @package    Cadastros
   * @subpackage Cliente
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once("class/ClienteView.php");
  //
  $layout       = new App\Layout\LayoutClass();
  $ClienteView = new ClienteView();
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
            <!-- //-->
            <div class="row">
              <div class="col-sm-9">                        
                <div class="form-group">
                    <label for="cliente_nome">* Nome:</label>
                    <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_nome']); ?>">
                </div>
              </div>
              <!-- //-->
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="cliente_pessoa">* Pessoa:</label>  
                  <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_pessoa']); ?>">    
                </div>
              </div>
              <!-- //-->                         
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="cliente_email">Email:</label>
                  <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_email']); ?>">
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="form-group">
               <fieldset class="fieldset">
                  <legend>CEP:</legend>
                    <div class="form-group input-group" style="max-width: 310px;">                              
                      <input disabled="" style="text-align: center;" type="text"  placeholder="Informe o cep." class="form-control cep-numero" value="<?php echo($ClienteView->myfields['cliente_cep']); ?>" >
                      <span class="input-group-btn"><button class="btn btn-default" type="button" id="btn_google_maps" data-toggle="tooltip" data-placement="top" title="Google Maps"><i class="fa fa-link"></i></button></span>
                  </div>                              
                </fieldset>
            </div>                        
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">                       
                <div class="form-group">
                  <label for="cliente_endereco">* Endereço:</label>
                  <input disabled="" type="text" class="form-control cep-endereco" value="<?php echo($ClienteView->myfields['cliente_endereco']); ?>" >
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">                        
                <div class="form-group">
                  <label for="cliente_complemento">Complemento:</label>
                  <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_complemento']); ?>">
                </div>
              </div>
            </div>
            <!-- //-->
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="cliente_bairro">* Bairro:</label>                              
                  <input disabled="" type="text" class="form-control cep-bairro" value="<?php echo($ClienteView->myfields['cliente_bairro']); ?>" >
                </div>
              </div>
            </div>
            <!-- //-->                          
            <div class="row">
              <div class="col-sm-10">
                <div class="form-group">
                  <label for="cliente_cidade">* Cidade:</label>
                  <input disabled="" type="text" class="form-control cep-cidade" value="<?php echo($ClienteView->myfields['cliente_cidade']); ?>" >
                </div>
              </div>
              <!-- //-->
              <div class="col-sm-2">
                <div class="form-group">
                  <label for="cliente_uf">* UF:</label>
                  <input disabled="" type="text" style="text-align: center;" class="form-control cep-uf"  value="<?php echo($ClienteView->myfields['cliente_uf']); ?>" >
                </div>
              </div>                          
            </div>
            <!-- //--> 
            <div class="tabbable tabbable-custom" id="tabs">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-phone"></i> Contato</a></li>
								<li><a href="#tab_1_2" data-toggle="tab"><i class="fa fa-group"></i> Pessoa Física</a></li>
                <li><a href="#tab_1_3" data-toggle="tab"><i class="fa fa-university"></i> Pessoa Jurídica</a></li>
                <li><a href="#tab_1_4" data-toggle="tab"><i class="fa fa-info"></i> OBS</a></li>
							</ul>                   
            	<div class="tab-content">
            		<div class="tab-pane active" id="tab_1_1">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cliente_fone1">Telefone Fixo:</label>        
                        <input disabled="" type="text"  placeholder="Telefone Fixo 1" class="form-control" value="<?php echo($ClienteView->myfields['cliente_fone1']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cliente_celular1">Telefone Celular:</label>
                        <input disabled="" type="text"  placeholder="Telefone Celular 1" class="form-control" value="<?php echo($ClienteView->myfields['cliente_celular1']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cliente_contato1">Contato:</label>
                        <input disabled="" type="text"  placeholder="Contato 1" class="form-control" value="<?php echo($ClienteView->myfields['cliente_contato1']); ?>">
                      </div>
                    </div>                                                        
                  </div>
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">                                            
                        <input disabled="" type="text"  placeholder="Telefone Fixo 2" class="form-control" value="<?php echo($ClienteView->myfields['cliente_fone2']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Telefone Celular 2" class="form-control" value="<?php echo($ClienteView->myfields['cliente_celular2']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Contato 2" class="form-control" value="<?php echo($ClienteView->myfields['cliente_contato2']); ?>">
                      </div>
                    </div>
                  </div>
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">                                            
                        <input disabled="" type="text"  placeholder="Telefone Fixo 3" class="form-control" value="<?php echo($ClienteView->myfields['cliente_fone3']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Telefone Celular 3" class="form-control" value="<?php echo($ClienteView->myfields['cliente_celular3']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Contato 3" class="form-control" value="<?php echo($ClienteView->myfields['cliente_contato3']); ?>">
                      </div>
                    </div>
                  </div>
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">                                            
                        <input disabled="" type="text"  placeholder="Telefone Fixo 4" class="form-control" value="<?php echo($ClienteView->myfields['cliente_fone4']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Telefone Celular 4" class="form-control" value="<?php echo($ClienteView->myfields['cliente_celular4']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-4">
                      <div class="form-group">                                    
                        <input disabled="" type="text"  placeholder="Contato 4" class="form-control" value="<?php echo($ClienteView->myfields['cliente_contato4']); ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- //-->
            		<div class="tab-pane" id="tab_1_2">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="cliente_cpf">CPF:</label>
                        <input disabled="" type="text"  placeholder="CPF" class="form-control" value="<?php echo($ClienteView->myfields['cliente_cpf']); ?>">
                      </div>
                    </div>
                    <!-- //-->                          
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="cliente_rg">RG:</label>                        
                        <input disabled="" type="text"  placeholder="RG" class="form-control" value="<?php echo($ClienteView->myfields['cliente_rg']); ?>">
                      </div>
                    </div>                        
                  </div>                              
                </div>
                <!-- //-->
            		<div class="tab-pane" id="tab_1_3">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="cliente_razao_social">Razão Social:</label>        
                        <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_razao_social']); ?>">                                
                      </div>
                    </div>
                  </div>  
                  <!-- //-->
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cliente_cnpj">CNPJ:</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_cnpj']); ?>">
                      </div>
                    </div>
                    <!-- //-->     
                    <div class="col-sm-4">
                      <div class="form-group">                              
                        <label for="cliente_insc_est">INSC. Estadual:</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_insc_est']); ?>">
                      </div>
                    </div>
                    <!-- //-->     
                    <div class="col-sm-4">
                      <div class="form-group">                              
                        <label for="cliente_insc_mun">INSC. Municipal:</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo($ClienteView->myfields['cliente_insc_mun']); ?>">
                      </div>
                    </div>                                
                  </div>
                </div>
                <!-- //-->
                <div class="tab-pane" id="tab_1_4">
                  <div class="form-group">
                    <label>Obs:</label>
                    <textarea disabled="" wrap="virtual" style="height:150px;width:100%;border-radius: 4px;"><?php echo($ClienteView->myfields['cliente_obs']); ?></textarea>
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
              <input type="hidden" class="form-control" value="<?php echo((int)$ClienteView->myfields['cliente_id']); ?>">
            </div>                        
            <p>&nbsp;</p>
            <!-- //-->
            <button type="button" class="btn btn-success ipage-btn" onclick="javascript:window.location.href='application/views/cadastros/cliente/view.php<?= $layout->getParameter() ?>'">
              <i class="fa fa-refresh"></i> Atualizar
            </button>
            <!-- //-->
            <button type="button" class="btn btn-primary ipage-btn" onclick="window.parent.location.href='cliente/addupdt/?parameter1=<?= $_GET['parameter1'] ?>'">
              <i class="fa fa-pencil"></i> Editar
            </button>
            <button id="btn_cancel" type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Fechar</button>
            <p>&nbsp;</p>
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  <!-- /#wrapper -->
  <?php include_once $nivel . 'inc_js.php'; ?>
  <script src="application/views/cadastros/cliente/js/ClienteView.js" type="text/javascript"></script>
</body>
</html>
