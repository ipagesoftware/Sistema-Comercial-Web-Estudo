<?php  
  /**
   * @version    1.0
   * @package    produto
   * @subpackage produto
   * @author     Diógenes Dias <diogenesdias@hotmail.com>
   * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
   * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
  */

  $nivel = "../../../../";
  require_once "{$nivel}config.php";
  require_once "{$nivel}vendor/autoload.php";
  require_once("class/ProdutoView.php");
  //
  $layout       = new App\Layout\LayoutClass();
  $ProdutoView = new ProdutoView();
  $barcode  = new App\BarCode\BarCodeClass($nivel);
  $code_bar = $barcode->barcode_print($ProdutoView->myfields['produto_cod_barras'], "EAN", 1, 'html')
  
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
                  <div class="col-sm-6">
                    <div class="form-group">
                      <img src="application/views/produto/produto/foto_edit/foto/<?= $ProdutoView->myfields['produto_foto']; ?>" class="foto-produto" id="produto_foto"/>
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-6">
                    <div class="form-group">
                        <label>* Descrição:</label>
                        <input disabled="" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_descricao']); ?>">
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Código de Barras:</label>
                      <input disabled="" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_cod_barras']); ?>" >
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Unidade Medida:</label>
                      <input disabled="" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_um']); ?>">
                    </div>
                  </div>
                </div>               
                <!-- //-->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Quantidade:</label>                              
                      <input disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_um_quant']); ?>" >
                    </div>
                  </div>
                  <!-- //-->                          
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Embalagem Com:</label>
                      <input disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_um_quant']); ?>" >
                    </div>
                  </div>                          
                  <!-- //--> 
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Fabricante:</label>
                      <input disabled="" type="text" placeholder="* Fabricante" class="form-control" value="<?php echo($ProdutoView->myfields['produto_fabricante']); ?>" >
                    </div>
                  </div>
                </div>
                <!-- //--> 
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                    <label>* Grupo:</label>
                      <input disabled="" type="text" placeholder="* Grupo:" class="form-control" value="<?php echo($ProdutoView->myfields['produto_grupo']); ?>">
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Cód. Interno:</label>                              
                      <input disabled="" type="text" placeholder="* Cód. Interno" class="form-control" value="<?php echo($ProdutoView->myfields['produto_codigo_interno']); ?>" >
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Valor Custo R$:</label>
                      <input disabled="" type="text" style="text-align: right;" class="form-control" value="<?php echo($ProdutoView->myfields['produto_val_custo']); ?>">
                    </div>
                  </div>
                </div>
                <!-- //-->
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Margem Lucro %:</label>                              
                      <input disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_margem_lucro']); ?>" >
                    </div>
                  </div>
                  <!-- //-->                          
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Valor Revenda R$:</label>
                      <input disabled="" disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_val_revenda']); ?>" >
                    </div>
                  </div>
                  <!-- //-->
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Valor Desconto %:</label>
                      <input disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_desconto']); ?>" >
                    </div>
                  </div>                          
                </div>                        
                <!-- //-->                        
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Estoque Mínimo:</label>
                      <input disabled="" type="text" style="text-align: right;" class="form-control" value="<?php echo($ProdutoView->myfields['produto_estoque_minimo']); ?>">
                    </div>
                  </div>
                  <!-- //-->                          
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Estoque Máximo:</label>                              
                      <input disabled="" style="text-align: right;" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_estoque_maximo']); ?>" >
                    </div>
                  </div>
                  <!-- //-->                          
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>* Uso Interno:</label>
                      <input disabled="" type="text" class="form-control" value="<?php echo($ProdutoView->myfields['produto_uso_interno']); ?>" >
                      <p class="help-block" id="produto_uso_interno_p">Produto de uso externo</p>
                    </div>
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
                <div class="form-group">
                  <input type="hidden" class="form-control" value="<?php echo((int)$ProdutoView->myfields['produto_id']); ?>">
                </div>
                <p>&nbsp;</p>
                <!-- //-->
                <button type="button" class="btn btn-success ipage-btn" onclick="javascript:window.location.href='application/views/produto/produto/view.php<?= $layout->getParameter() ?>'">
                  <i class="fa fa-refresh"></i> Atualizar
                </button>
                <!-- //-->
                <button type="button" class="btn btn-primary ipage-btn" onclick="window.parent.location.href='produto/addupdt/?parameter1=<?= $_GET['parameter1'] ?>'">
                  <i class="fa fa-pencil"></i> Editar
                </button>
                <button id="btn_cancel" type="button" class="btn btn-danger ipage-btn"><i class="fa fa-times"></i> Fechar</button>
                <p>&nbsp;</p>              
          </div>
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  <!-- /#wrapper -->
  <!-- //--> 
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //--> 
  <script src="application/views/produto/produto/js/ProdutoView.js" type="text/javascript"></script>
</body>
</html>
