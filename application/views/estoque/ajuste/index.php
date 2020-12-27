<?php
  /**
   * @version    1.0
   * @package    Estoque
   * @subpackage Ajuste
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */
  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once("class/AjusteIndex.php");  
  //
  $layout       = new App\Layout\LayoutClass();
  $navBarHeader = $layout->topHeader();
  //
  $Ajuste = new AjusteIndex();
  //
  $Ajuste->decodificaCriterio(); 
  // Verifica solicitações de ativação/desativação    
  $Ajuste->getSort(); 
  
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
  <div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;margin-top: -45px !important; padding-top: 0 !important;">
      <div style="height: 50px;" class="ipage-line-feed"></div>
      <div id="page-wrapper">
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-refresh"></i> <a href="<?php echo($_SERVER['PHP_SELF']. '?' . $_SERVER['QUERY_STRING']);?>">Atualizar</a>
                        </li>
                        <li>
                          <i class="fa fa-times"></i> <a href="javascript:void(0);" id="mnu_fechar"> Cancelar</a>
                        </li>                        
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="tabbable tabbable-custom" id="tabs">
  							<ul class="nav nav-tabs">
  								<li class="active"><a href="#tab_1_1" data-toggle="tab"><i class="fa fa-bars"></i> Planilha</a></li>
  								<li><a href="#tab_1_2" data-toggle="tab"><i class="fa fa-edit"></i> Lançamentos</a></li>
  							</ul>                   
              	<div class="tab-content">
              		<div class="tab-pane active" id="tab_1_1">
                    <div class="row">           
                      <div class="col-lg-12">                                         
                        <?php 
                          echo($Ajuste->insertDataIntoTable()); 
                        ?>
                      </div>
                    </div>
                  </div>
                  <!-- /.row -->
                  <div class="tab-pane" id="tab_1_2">
                    <div class="row">  
                      <div class="col-md-9 col-md-offset-1">
                          <form role="form" method="post" name="form1" id="form1">
                            <!-- //-->
                            <div class="row">
                              <!-- //-->
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="valor">* Estoque Atual:</label>
                                  <input type="text" autocomplete="off"  name="estoque_atu" id="estoque_atu" style="text-align: right;<?php if((float)$Ajuste->estoque_atual<=0)echo('color: red;'); ?>;" class="form-control" value="<?php echo($Ajuste->estoque_atual); ?>" disabled="">
                                </div>
                              </div>
                              <!-- //-->
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label for="cbo_operacao">* Operação:</label>
                            			<select class="form-control" name="cbo_operacao" id="cbo_operacao">
                                    <option selected="" value="E">ENTRADA</option>
                                    <option value="S">SAÍDA</option>
                                    <option value="ES">ESTORNO SAÍDA</option>
                                    <option value="EE">ESTORNO ENTRADA</option>
                                    <option value="P">PERDA</option>
                                    <option value="C">CONSUMO</option>
                                    <!-- 
                                    <option value="TE">TROCA ENTRADA</option>
                                    <option value="TS">TROCA SAÍDA</option>
                                    //-->
                            			</select>                         
                                </div>
                              </div>
                              <!-- //-->
                              <div class="col-sm-3">
                                <div class="form-group">
                                  <label for="valor">* Quantidade:</label>
                                  <input type="text" autocomplete="off"  name="quantidade" id="quantidade" style="text-align: right;" class="form-control" value="0.00">
                                </div>
                              </div>
                            </div>
                            <!-- //-->                          
                            <div class="form-group">
                              <input type="hidden" name="produto_id" id="produto_id" class="form-control" value="<?php echo($Ajuste->produto_id); ?>">
                            </div>                        
                            <!-- //-->
                            <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                            <p>&nbsp;</p>
                            <input type="hidden" class="form-control" id="token" name="token" value="">
                          </form>
                      </div>
                    </div>
                  </div>
                </div>
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
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->
  <script src="application/views/estoque/ajuste/js/AjusteIndex.js" type="text/javascript"></script>
</body>
</html>
