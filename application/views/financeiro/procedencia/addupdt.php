<?php
    /**
     * @version    1.0
     * @package    Financeiro
     * @subpackage Procedência
     * @author     Diógenes Dias <diogenesdias@hotmail.com>
     * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
     * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
    */    
    $nivel = "../../../../";
    require_once "{$nivel}config.php";
    require_once "{$nivel}vendor/autoload.php";
    require_once("class/ProcedenciaAddUpdt.php");
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral = $layout->menuLateral('PROCEDENCIA',2);
    //
    $class = new ProcedenciaAddUpdt();
    $ret = $class->getValues();
    //
    if($ret=='OK'){
      $class->getReg();
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
                            if($class->myfields['procedencia_id']['valor']!=0){
                              echo('Editar Cadastro Procedência(' . $class->myfields['procedencia_id']['valor'] . ')');    
                            }else{
                              echo('Cadastro Procedência <small> - ' . $layout->sid->getNode('procedencia_empresa')).'</small>';
                            }
                          ?>
                          
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($class->myfields['procedencia_id']['valor'],10)!=0 && 
                                    $class->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="procedencia/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i> <a href="procedencia/addupdt/<?= $layout->getParameter() ?>">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="procedencia/">Planilha</a>
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
                              <label>* Procedência:</label>
                              <input type="text" autocomplete="off" name="procedencia_empresa" id="procedencia_empresa" class="form-control" required="" maxlength="100" data-mask="letter" data-error="O campo Procedência é inválido ou inexistente, digite apenas letras!" value="<?php echo($class->myfields['procedencia_empresa']['valor']); ?>" autofocus="" >
                            </div>
                          </div>
                        </div>    
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <label>* Email:</label>
                            <div class="form-group">
                              <input type="text" autocomplete="off" name="procedencia_email" id="procedencia_email" class="form-control" required="" maxlength="100" data-mask="email" data-error="O campo Email é inválido, verifique!" value="<?php echo($class->myfields['procedencia_email']['valor']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-6">
                            <label>* CEP:</label>
                            <div class="form-group input-group" style="min-width: 310px;">
                              <input autocomplete="off" required="" style="text-align: center;" type="text"  placeholder="Informe o cep." name="procedencia_cep" id="procedencia_cep" class="form-control cep-numero" maxlength="9" data-mask="cep" value="<?php echo($class->myfields['procedencia_cep']['valor']); ?>" >
                              <span class="input-group-btn"><button class="btn btn-info" type="button" id="btn_cep" data-toggle="tooltip" data-placement="top" title="Ativa pesquisa por CEP"><i class="fa fa-search"></i></button></span>
                              <span class="input-group-btn"><button class="btn btn-default" type="button" id="btn_google_maps" data-toggle="tooltip" data-placement="top" title="Google Maps"><i class="fa fa-link"></i></button></span>
                              <span class="input-group-btn"><button class="btn btn-warning" type="button" id="btn_ect" data-toggle="tooltip" data-placement="top" title="Consulte no site dos correios">
                              <i class="fa fa-question-circle"></i> Esqueci o CEP</button></span>
                            </div>
                          </div>
                        </div>
                        <!-- //--> 
                        <div class="row">
                          <div class="col-sm-12">                       
                            <div class="form-group">
                              <label>* Endereço:</label>
                              <input type="text" autocomplete="off" required="" name="procedencia_endereco" id="procedencia_endereco" class="form-control cep-endereco" maxlength="100" value="<?php echo($class->myfields['procedencia_endereco']['valor']); ?>" >
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Complemento:</label>
                              <input type="text" autocomplete="off" name="procedencia_complemento" id="procedencia_complemento" class="form-control cep-complemento" maxlength="100" value="<?php echo($class->myfields['procedencia_complemento']['valor']); ?>">
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Bairro:</label>               
                              <input type="text" autocomplete="off" required="" name="procedencia_bairro" id="procedencia_bairro" class="form-control cep-bairro" maxlength="30" value="<?php echo($class->myfields['procedencia_bairro']['valor']); ?>" >
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>* Cidade:</label>
                              <input type="text" autocomplete="off" required="" name="procedencia_cidade" id="procedencia_cidade" class="form-control cep-cidade" maxlength="50" value="<?php echo($class->myfields['procedencia_cidade']['valor']); ?>" >
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-2">
                            <div class="form-group"  style="max-width: 80px;">
                              <label>* UF:</label>
                              <input type="text" autocomplete="off" required="" style="text-align: center;" name="procedencia_uf" id="procedencia_uf" class="form-control cep-uf" maxlength="2" data-mask="uf" value="<?php echo($class->myfields['procedencia_uf']['valor']); ?>" >
                            </div>
                          </div>                          
                        </div>
                        <!-- //-->                        
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>CPF:</label>
                              <input type="text" autocomplete="off" name="procedencia_cpf" id="procedencia_cpf" class="form-control" maxlength="20" data-mask="cpf" data-error="O campo CPF é inválido, verifique!" value="<?php echo($class->myfields['procedencia_cpf']['valor']); ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>RG:</label>
                              <input type="text" autocomplete="off" name="procedencia_rg" id="procedencia_rg" class="form-control" maxlength="100" value="<?php echo($class->myfields['procedencia_rg']['valor']); ?>">
                            </div>
                          </div>                        
                        </div>                         
                        <!-- //-->                        
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>CNPJ:</label>
                              <input type="text" autocomplete="off" name="procedencia_cnpj" id="procedencia_cnpj" class="form-control" maxlength="20" data-mask="cnpj" data-error="O campo CNPJ é inválido, verifique!" value="<?php echo($class->myfields['procedencia_cnpj']['valor']); ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Insc. Estadual:</label>              
                              <input type="text" autocomplete="off" name="procedencia_insc_est" id="procedencia_insc_est" class="form-control" maxlength="20" value="<?php echo($class->myfields['procedencia_insc_est']['valor']); ?>">
                            </div>
                          </div>                        
                        </div>  
                        <!-- //-->                        
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">                              
                              <label>Telefone Fixo 1:</label>
                              <input type="text" autocomplete="off" name="procedencia_fone1" id="procedencia_fone1" class="form-control" maxlength="20" data-mask="phone" value="<?php echo($class->myfields['procedencia_fone1']['valor']); ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Telefone Celular 1</label>
                              <input type="text" autocomplete="off" name="procedencia_celular1" id="procedencia_celular1" class="form-control" maxlength="20" data-mask="cel" value="<?php echo($class->myfields['procedencia_celular1']['valor']); ?>">
                            </div>
                          </div>                        
                        </div>
                        <!-- //-->                        
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Telefone Fixo 2:</label>           
                              <input type="text" autocomplete="off" name="procedencia_fone2" id="procedencia_fone2" class="form-control" maxlength="20" value="<?php echo($class->myfields['procedencia_fone2']['valor']); ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Telefone Celular 2</label>
                              <input type="text" autocomplete="off" name="procedencia_celular2" id="procedencia_celular2" class="form-control" maxlength="20" value="<?php echo($class->myfields['procedencia_celular2']['valor']); ?>">
                            </div>
                          </div>                        
                        </div>                          
                        <!-- //-->                                                
                        <div class="row">                        
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Contato:</label>
                              <input type="text" autocomplete="off" name="procedencia_contato" id="procedencia_contato" class="form-control" maxlength="100" data-last-input="1" value="<?php echo($class->myfields['procedencia_contato']['valor']); ?>">
                            </div>
                          </div>                        
                        </div>
                        <!-- //-->                        
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>Status:</legend>
                                <label class="radio-inline">
                                    <input type="radio" name="procedencia_status" id="user_status1" value="1" <?php echo(intval(($class->myfields['procedencia_status']['valor']))==1? 'checked':''); ?>>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="procedencia_status" id="user_status2" value="0" <?php echo(intval(($class->myfields['procedencia_status']['valor']))==0? 'checked':''); ?>>Inativo
                                </label>
                            </fieldset>
                        </div>                        
                        <!-- //-->                        
                        <div class="form-group">
                          <input type="hidden" name="procedencia_id" id="procedencia_id" class="form-control" value="<?php echo($class->myfields['procedencia_id']['valor']); ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="procedencia/">
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

  </div>
  <!-- /#wrapper -->
  <!-- //-->
  <?php $layout->createCookie(); ?>
  <!-- //--> 
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //--> 
  <script src="application/views/financeiro/procedencia/js/ProcedenciaAddUpdt.js" type="text/javascript"></script>
</body>
</html>
