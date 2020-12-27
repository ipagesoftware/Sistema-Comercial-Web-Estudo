<?php
/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Vendedor
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
$nivel = "../../../../";
require_once "{$nivel}config.php";
require_once "{$nivel}vendor/autoload.php";
require_once "class/VendedorAddUpdt.php";  
//
$layout       = new App\Layout\LayoutClass();
$navBarHeader = $layout->topHeader();
$menuLateral  = $layout->menuLateral('VENDEDOR', 1); 
//////////////////////////////////////////////////////////
$VendedorAddUpdt = new VendedorAddUpdt();
$ret = $VendedorAddUpdt->getValues();
//
if($ret=='OK'){
  $VendedorAddUpdt->getReg();
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
                            if((int)$VendedorAddUpdt->myfields['vendedor_id']!=0){
                              echo('Editar Cadastro Vendedor(' . $VendedorAddUpdt->myfields['vendedor_id'] . ')');    
                            }else{
                              echo('Cadastro Vendedor');
                            }
                          ?>
                          <small> - <?php echo($VendedorAddUpdt->sid->getNode('procedencia_empresa')); ?></small>                          
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($VendedorAddUpdt->myfields['vendedor_id'],10)!=0 && 
                                    $VendedorAddUpdt->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="vendedor/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i>
                            <a href="vendedor/addupdt/<?= $layout->getParameter() ?>">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="vendedor/">Planilha</a>
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
                          <div class="col-sm-9">                        
                            <div class="form-group">
                                <label for="vendedor_nome">* Nome:</label>
                                <input type="text" required="" autofocus="" autocomplete="off" maxlength="100" name="vendedor_nome" id="vendedor_nome" data-mask="name" data-error="O campo Nome é inválido ou inexistente, digite apenas letras!" class="form-control" value="<?php echo($VendedorAddUpdt->myfields['vendedor_nome']); ?>">
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label for="vendedor_pessoa">* Pessoa:</label>
                        			<select class="form-control" name="vendedor_pessoa" id="vendedor_pessoa" style="max-width: 180px;">
                                <?php                                  
                                  $ret = ($VendedorAddUpdt->myfields['vendedor_pessoa']=='F')?'selected=""':'';
                                  echo('<option value="F" ' . $ret .'>FÍSICA</option>');
                                  $ret = ($VendedorAddUpdt->myfields['vendedor_pessoa']=='J')?'selected=""':'';
                                  echo('<option value="J" ' . $ret .'>JURÍDICA</option>');
                                ?>                                                                
                        			</select>                         
                            </div>
                          </div>
                          <!-- //-->                         
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="vendedor_email">* Email:</label>
                              <input type="text" required="" autocomplete="off" maxlength="100" name="vendedor_email" id="vendedor_email" data-mask="email" data-error="O campo Email é inválido, verifique!" class="form-control" value="<?php echo($VendedorAddUpdt->myfields['vendedor_email']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>CEP:</legend>
                                <div class="form-group input-group" style="max-width: 310px;">
                                  <input type="text" required="" autocomplete="off" maxlength="9" name="vendedor_cep" id="vendedor_cep" class="form-control text-center cep-numero" placeholder="Informe o cep." data-error="O campo CEP é inválido, verifique!" data-mask="cep" value="<?php echo($VendedorAddUpdt->myfields['vendedor_cep']); ?>" >
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
                              <label for="vendedor_endereco">* Endereço:</label>
                              <input type="text" required="" autocomplete="off" name="vendedor_endereco" id="vendedor_endereco" class="form-control cep-endereco" maxlength="100" data-error="O campo Endereço é inválido ou inexistente, verifique!" value="<?php echo($VendedorAddUpdt->myfields['vendedor_endereco']); ?>" >
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">                        
                            <div class="form-group">
                              <label for="vendedor_complemento">Complemento:</label>
                              <input type="text" autocomplete="off" name="vendedor_complemento" id="vendedor_complemento" class="form-control cep-complemento" maxlength="100" value="<?php echo($VendedorAddUpdt->myfields['vendedor_complemento']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label for="vendedor_bairro">* Bairro:</label>                              
                              <input type="text" required="" autocomplete="off" name="vendedor_bairro" id="vendedor_bairro" class="form-control cep-bairro" maxlength="30" data-error="O campo Bairro é inválido ou inexistente, verifique!" value="<?php echo($VendedorAddUpdt->myfields['vendedor_bairro']); ?>" >
                            </div>
                          </div>
                        </div>
                        <!-- //-->                          
                        <div class="row">
                          <div class="col-sm-10">
                            <div class="form-group">
                              <label for="vendedor_cidade">* Cidade:</label>
                              <input type="text" required="" autocomplete="off" name="vendedor_cidade" id="vendedor_cidade" class="form-control cep-cidade" maxlength="50" data-error="O campo Cidade é inválido ou inexistente, verifique!" value="<?php echo($VendedorAddUpdt->myfields['vendedor_cidade']); ?>" >
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label for="vendedor_uf">* UF:</label>
                              <input type="text" required="" autocomplete="off" style="text-align: center;" name="vendedor_uf" id="vendedor_uf" class="form-control cep-uf" maxlength="2" data-error="O Campo UF é inválido ou inexistente, verifique!" data-mask="uf" value="<?php echo($VendedorAddUpdt->myfields['vendedor_uf']); ?>" >
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
                                    <label for="vendedor_fone1">Telefone Fixo:</label>        
                                    <input type="text" data-mask="phone" autocomplete="off" placeholder="Telefone Fixo 1" name="vendedor_fone1" id="vendedor_fone1" class="form-control" maxlength="20" value="<?php echo($VendedorAddUpdt->myfields['vendedor_fone1']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="vendedor_celular1">Telefone Celular:</label>
                                    <input type="text" data-mask="cel" autocomplete="off" placeholder="Telefone Celular 1" name="vendedor_celular1" id="vendedor_celular1" class="form-control" maxlength="20" value="<?php echo($VendedorAddUpdt->myfields['vendedor_celular1']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="vendedor_contato1">Contato:</label>
                                    <input type="text" autocomplete="off" placeholder="Contato 1" name="vendedor_contato1" id="vendedor_contato1" class="form-control" maxlength="30" value="<?php echo($VendedorAddUpdt->myfields['vendedor_contato1']); ?>">
                                  </div>
                                </div>                                                        
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" data-mask="phone" autocomplete="off" placeholder="Telefone Fixo 2" name="vendedor_fone2" id="vendedor_fone2" class="form-control" maxlength="20" value="<?php echo($VendedorAddUpdt->myfields['vendedor_fone2']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 2" name="vendedor_celular2" id="vendedor_celular2" class="form-control" maxlength="20" data-mask="cel" value="<?php echo($VendedorAddUpdt->myfields['vendedor_celular2']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 2" name="vendedor_contato2" id="vendedor_contato2" class="form-control" maxlength="30" value="<?php echo($VendedorAddUpdt->myfields['vendedor_contato2']); ?>">
                                  </div>
                                </div>
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" autocomplete="off" placeholder="Telefone Fixo 3" name="vendedor_fone3" id="vendedor_fone3" class="form-control" maxlength="20" data-mask="phone" value="<?php echo($VendedorAddUpdt->myfields['vendedor_fone3']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 3" name="vendedor_celular3" id="vendedor_celular3" class="form-control" maxlength="20" data-mask="cel" value="<?php echo($VendedorAddUpdt->myfields['vendedor_celular3']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 3" name="vendedor_contato3" id="vendedor_contato3" class="form-control" maxlength="30" value="<?php echo($VendedorAddUpdt->myfields['vendedor_contato3']); ?>">
                                  </div>
                                </div>
                              </div>
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">                                            
                                    <input type="text" autocomplete="off" placeholder="Telefone Fixo 4" name="vendedor_fone4" id="vendedor_fone4" class="form-control" maxlength="20" data-mask="phone" value="<?php echo($VendedorAddUpdt->myfields['vendedor_fone4']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Telefone Celular 4" name="vendedor_celular4" id="vendedor_celular4" class="form-control" maxlength="20"data-mask="cel" value="<?php echo($VendedorAddUpdt->myfields['vendedor_celular4']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-4">
                                  <div class="form-group">                                    
                                    <input type="text" autocomplete="off" placeholder="Contato 4" name="vendedor_contato4" id="vendedor_contato4" class="form-control" maxlength="30" data-last-input="1" value="<?php echo($VendedorAddUpdt->myfields['vendedor_contato4']); ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- //-->
                        		<div class="tab-pane" id="tab_1_2">
                              <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="vendedor_cpf">CPF:</label>
                                    <input type="text" autocomplete="off" placeholder="CPF" name="vendedor_cpf" id="vendedor_cpf" class="form-control" maxlength="14" data-mask="cpf" data-error="O campo CPF é inválido, verifique!" value="<?php echo($VendedorAddUpdt->myfields['vendedor_cpf']); ?>">
                                  </div>
                                </div>
                                <!-- //-->                          
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="vendedor_rg">RG:</label>                        
                                    <input type="text" autocomplete="off" placeholder="RG" name="vendedor_rg" id="vendedor_rg" class="form-control" maxlength="100" value="<?php echo($VendedorAddUpdt->myfields['vendedor_rg']); ?>">
                                  </div>
                                </div>                        
                              </div>                              
                            </div>
                            <!-- //-->
                        		<div class="tab-pane" id="tab_1_3">
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label for="vendedor_razao_social">Razão Social:</label>        
                                    <input type="text" autocomplete="off" name="vendedor_razao_social" id="vendedor_razao_social" class="form-control" maxlength="100" value="<?php echo($VendedorAddUpdt->myfields['vendedor_razao_social']); ?>">                                
                                  </div>
                                </div>
                              </div>  
                              <!-- //-->
                              <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label for="vendedor_cnpj">CNPJ:</label>
                                    <input type="text" autocomplete="off" name="vendedor_cnpj" id="vendedor_cnpj" class="form-control" maxlength="20" data-mask="cnpj" data-error="O campo CNPJ é inválido, verifique!" value="<?php echo($VendedorAddUpdt->myfields['vendedor_cnpj']); ?>">
                                  </div>
                                </div>
                                <!-- //-->     
                                <div class="col-sm-4">
                                  <div class="form-group">                              
                                    <label for="vendedor_insc_est">INSC. Estadual:</label>
                                    <input type="text" autocomplete="off" name="vendedor_insc_est" id="vendedor_insc_est" class="form-control" maxlength="20" value="<?php echo($VendedorAddUpdt->myfields['vendedor_insc_est']); ?>">
                                  </div>
                                </div>
                                <!-- //-->     
                                <div class="col-sm-4">
                                  <div class="form-group">                              
                                    <label for="vendedor_insc_mun">INSC. Municipal:</label>
                                    <input type="text" autocomplete="off" name="vendedor_insc_mun" id="vendedor_insc_mun" class="form-control" maxlength="20" value="<?php echo($VendedorAddUpdt->myfields['vendedor_insc_mun']); ?>">
                                  </div>
                                </div>                                
                              </div>
                            </div>
                            <!-- //-->
                            <div class="tab-pane" id="tab_1_4">
                              <div class="form-group">
                                <label>Obs:</label>
                                <textarea wrap="virtual" name="vendedor_obs" id="vendedor_obs" style="height:150px;width:100%;border-radius: 4px;"><?php echo($VendedorAddUpdt->myfields['vendedor_obs']); ?></textarea>
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
                                    <input type="radio" name="vendedor_status" id="vendedor_status1" value="1" checked>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="vendedor_status" id="vendedor_status2" value="0" >Inativo
                                </label>
                            </fieldset>
                        </div>
                        <!-- //-->                                                 
                        <div class="form-group">
                          <input type="hidden" name="vendedor_id" id="vendedor_id" class="form-control" value="<?php echo((int)$VendedorAddUpdt->myfields['vendedor_id']); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="vendedor/">
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
  <script src="application/views/cadastros/vendedor/js/VendedorAddUpdt.js" type="text/javascript"></script>
</body>
</html>
