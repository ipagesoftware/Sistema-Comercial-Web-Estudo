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
require_once "class/EmpresaAddUpdt.php";  
//
$layout       = new App\Layout\LayoutClass();
$navBarHeader = $layout->topHeader();
$menuLateral  = $layout->menuLateral('EMPRESA', 1); 
//////////////////////////////////////////////////////////
$EmpresaAddUpdt = new EmpresaAddUpdt();
$ret = $EmpresaAddUpdt->getValues();
//
if($ret=='OK'){
  $EmpresaAddUpdt->getReg();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta>
    <base href="<?= URL ?>" />

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
                            if((int)$EmpresaAddUpdt->myfields['empresa_id']!=0){
                              echo('Editar Cadastro Empresa(' . $EmpresaAddUpdt->myfields['empresa_id'] . ')');    
                            }else{
                              echo('Cadastro Empresa');
                            }
                          ?>
                          <small> - <?php echo($EmpresaAddUpdt->sid->getNode('procedencia_empresa')); ?></small>                          
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($EmpresaAddUpdt->myfields['empresa_id'],10)!=0 && 
                                    $EmpresaAddUpdt->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="empresa/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i>
                            <a href="empresa/addupdt/<?= $layout->getParameter() ?>">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="empresa/">Planilha</a>
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
                          <div class="col-sm-12">                        
                            <div class="form-group">
                                <label for="empresa_nome">* Nome:</label>
                                <input type="text" required="" autofocus="" autocomplete="off" maxlength="100" name="empresa_nome" id="empresa_nome" data-error="O campo Nome é inválido ou inexistente!" class="form-control" value="<?php echo($EmpresaAddUpdt->myfields['empresa_nome']); ?>">
                            </div>
                          </div>                        
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="empresa_email">* Email:</label>
                              <input type="text" required="" autocomplete="off" maxlength="100" name="empresa_email" id="empresa_email" data-mask="email" data-error="O campo Email é inválido, verifique!" class="form-control" value="<?php echo($EmpresaAddUpdt->myfields['empresa_email']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>CEP:</legend>
                                <div class="form-group input-group" style="max-width: 310px;">
                                  <input type="text" required="" autocomplete="off" maxlength="9" name="empresa_cep" id="empresa_cep" class="form-control text-center cep-numero" placeholder="Informe o cep." data-error="O campo CEP é inválido, verifique!" data-mask="cep" value="<?php echo($EmpresaAddUpdt->myfields['empresa_cep']); ?>" >
                                  <span class="input-group-btn"><button class="btn btn-info" type="button" id="btn_cep" data-toggle="tooltip" data-placement="top" title="Ativa pesquisa por CEP"><i class="fa fa-search"></i></button></span>
                                  <span class="input-group-btn"><button class="btn btn-default" type="button" id="btn_google_maps" data-toggle="tooltip" data-placement="top" title="Google Maps"><i class="fa fa-link"></i></button></span>
                                  <span class="input-group-btn"><button class="btn btn-warning" type="button" id="btn_ect" data-toggle="tooltip" data-placement="top" title="Consulte no site dos correios">
                                  <i class="fa fa-question-circle"></i></button></span>
                              </div>                              
                            </fieldset>
                        </div>                        
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">                       
                            <div class="form-group">
                              <label for="empresa_endereco">* Endereço:</label>
                              <input type="text" required="" autocomplete="off" name="empresa_endereco" id="empresa_endereco" class="form-control cep-endereco" maxlength="100" data-error="O campo Endereço é inválido ou inexistente, verifique!" value="<?php echo($EmpresaAddUpdt->myfields['empresa_endereco']); ?>" >
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">                        
                            <div class="form-group">
                              <label for="empresa_complemento">Complemento:</label>
                              <input type="text" autocomplete="off" name="empresa_complemento" id="empresa_complemento" class="form-control cep-complemento" maxlength="100" value="<?php echo($EmpresaAddUpdt->myfields['empresa_complemento']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="empresa_bairro">* Bairro:</label>                              
                              <input type="text" required="" autocomplete="off" name="empresa_bairro" id="empresa_bairro" class="form-control cep-bairro" maxlength="30" data-error="O campo Bairro é inválido ou inexistente, verifique!" value="<?php echo($EmpresaAddUpdt->myfields['empresa_bairro']); ?>" >
                            </div>
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="row">
                          <div class="col-sm-10">
                            <div class="form-group">
                              <label for="empresa_cidade">* Cidade:</label>
                              <input type="text" required="" autocomplete="off" name="empresa_cidade" id="empresa_cidade" class="form-control cep-cidade" maxlength="50" data-error="O campo Cidade é inválido ou inexistente, verifique!" value="<?php echo($EmpresaAddUpdt->myfields['empresa_cidade']); ?>" >
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label for="empresa_uf">* UF:</label>
                              <input type="text" required="" autocomplete="off" style="text-align: center;" name="empresa_uf" id="empresa_uf" class="form-control cep-uf" maxlength="2" data-error="O Campo UF é inválido ou inexistente, verifique!" data-mask="uf" value="<?php echo($EmpresaAddUpdt->myfields['empresa_uf']); ?>" >
                            </div>
                          </div>                          
                        </div>
                        <!-- //--> 
                        <div class="tabbable tabbable-custom" id="tabs">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-phone"></i> Contato</a></li>
                            <li><a href="#tab_1_3" data-toggle="tab"><i class="fa fa-university"></i> Pessoa Jurídica</a></li>
                            <li><a href="#tab_1_4" data-toggle="tab"><i class="fa fa-info"></i> OBS</a></li>
                          </ul>                   
                          <div class="tab-content">
                            <div class="tab-pane active" id="tab_1_1">
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="empresa_fone1">Telefone Fixo:</label>        
                                    <input type="text" data-mask="phone" autocomplete="off" placeholder="Telefone Fixo 1" name="empresa_fone1" id="empresa_fone1" class="form-control" maxlength="20" value="<?php echo($EmpresaAddUpdt->myfields['empresa_fone1']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="empresa_celular1">Telefone Celular:</label>
                                    <input type="text" data-mask="cel" autocomplete="off" placeholder="Telefone Celular 1" name="empresa_celular1" id="empresa_celular1" class="form-control" maxlength="20" value="<?php echo($EmpresaAddUpdt->myfields['empresa_celular1']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="empresa_contato1">Contato:</label>
                                    <input type="text" autocomplete="off" placeholder="Contato 1" name="empresa_contato1" id="empresa_contato1" class="form-control" maxlength="30" value="<?php echo($EmpresaAddUpdt->myfields['empresa_contato1']); ?>">
                                  </div>
                                </div>                                                        
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" data-mask="phone" autocomplete="off" placeholder="Telefone Fixo 2" name="empresa_fone2" id="empresa_fone2" class="form-control" maxlength="20" value="<?php echo($EmpresaAddUpdt->myfields['empresa_fone2']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 2" name="empresa_celular2" id="empresa_celular2" class="form-control" maxlength="20" data-mask="cel" value="<?php echo($EmpresaAddUpdt->myfields['empresa_celular2']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 2" name="empresa_contato2" id="empresa_contato2" class="form-control" maxlength="30" value="<?php echo($EmpresaAddUpdt->myfields['empresa_contato2']); ?>">
                                  </div>
                                </div>
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" autocomplete="off" placeholder="Telefone Fixo 3" name="empresa_fone3" id="empresa_fone3" class="form-control" maxlength="20" data-mask="phone" value="<?php echo($EmpresaAddUpdt->myfields['empresa_fone3']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 3" name="empresa_celular3" id="empresa_celular3" class="form-control" maxlength="20" data-mask="cel" value="<?php echo($EmpresaAddUpdt->myfields['empresa_celular3']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 3" name="empresa_contato3" id="empresa_contato3" class="form-control" maxlength="30" value="<?php echo($EmpresaAddUpdt->myfields['empresa_contato3']); ?>">
                                  </div>
                                </div>
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" autocomplete="off" placeholder="Telefone Fixo 4" name="empresa_fone4" id="empresa_fone4" class="form-control" maxlength="20" data-mask="phone" value="<?php echo($EmpresaAddUpdt->myfields['empresa_fone4']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 4" name="empresa_celular4" id="empresa_celular4" class="form-control" maxlength="20"data-mask="cel" value="<?php echo($EmpresaAddUpdt->myfields['empresa_celular4']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 4" name="empresa_contato4" id="empresa_contato4" class="form-control" maxlength="30" data-last-input="1" value="<?php echo($EmpresaAddUpdt->myfields['empresa_contato4']); ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- //-->
                            <div class="tab-pane" id="tab_1_3">
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label for="empresa_razao_social">Razão Social:</label>        
                                    <input type="text" autocomplete="off" name="empresa_razao_social" id="empresa_razao_social" class="form-control" maxlength="100" value="<?php echo($EmpresaAddUpdt->myfields['empresa_razao_social']); ?>">                                
                                  </div>
                                </div>
                              </div>  
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="empresa_cnpj">CNPJ:</label>
                                    <input type="text" autocomplete="off" name="empresa_cnpj" id="empresa_cnpj" class="form-control" maxlength="20" data-mask="cnpj" data-error="O campo CNPJ é inválido, verifique!" value="<?php echo($EmpresaAddUpdt->myfields['empresa_cnpj']); ?>">
                                  </div>
                                </div>
                                <!-- //-->     
                                <div class="col-sm-4">
                                  <div class="form-group">                              
                                    <label for="empresa_insc_est">INSC. Estadual:</label>
                                    <input type="text" autocomplete="off" name="empresa_insc_est" id="empresa_insc_est" class="form-control" maxlength="20" value="<?php echo($EmpresaAddUpdt->myfields['empresa_insc_est']); ?>">
                                  </div>
                                </div>
                                <!-- //-->     
                                <div class="col-sm-4">
                                  <div class="form-group">                              
                                    <label for="empresa_insc_mun">INSC. Municipal:</label>
                                    <input type="text" autocomplete="off" name="empresa_insc_mun" id="empresa_insc_mun" class="form-control" maxlength="20" value="<?php echo($EmpresaAddUpdt->myfields['empresa_insc_mun']); ?>">
                                  </div>
                                </div>                                
                              </div>
                            </div>
                            <!-- //-->
                            <div class="tab-pane" id="tab_1_4">
                              <div class="form-group">
                                <label>Obs:</label>
                                <textarea wrap="virtual" name="empresa_obs" id="empresa_obs" style="height:150px;width:100%;border-radius: 4px;"><?php echo($EmpresaAddUpdt->myfields['empresa_obs']); ?></textarea>
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
                                    <input type="radio" name="empresa_status" id="empresa_status1" value="1" checked>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="empresa_status" id="empresa_status2" value="0" >Inativo
                                </label>
                            </fieldset>
                        </div>
                        <!-- //-->                                                 
                        <div class="form-group">
                          <input type="hidden" name="empresa_id" id="empresa_id" class="form-control" value="<?php echo((int)$EmpresaAddUpdt->myfields['empresa_id']); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="empresa/">
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
  <script src="application/views/cadastros/empresa/js/EmpresaAddUpdt.js" type="text/javascript"></script>
</body>
</html>
