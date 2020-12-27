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
    require_once "class/ProdutoAddUpdt.php";  
    //
    $layout       = new App\Layout\LayoutClass();
    $navBarHeader = $layout->topHeader();
    $menuLateral  = $layout->menuLateral('PRODUTO', 4); 
    //////////////////////////////////////////////////////////
    $ProdutoAddUpdt = new ProdutoAddUpdt($nivel);
    $ret = $ProdutoAddUpdt->getValues();
    //
    $foto = "application/views/produto/produto/foto_edit/foto/produto.png";

    if($ret=='OK'){
      $ProdutoAddUpdt->getReg();
      //
      if($ProdutoAddUpdt->myfields['produto_id']){
        $foto = "application/views/produto/produto/foto_edit/foto/{$ProdutoAddUpdt->myfields['produto_foto']}";
      }
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
  <div id="wrapper" <?=$layout->paddingLeft; ?>>
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
                            if((int)$ProdutoAddUpdt->myfields['produto_id']!=0){
                              echo('Editar Cadastro Produto(' . $ProdutoAddUpdt->myfields['produto_id'] . ')');    
                            }else{
                              echo('Cadastro Produto');
                            }
                          ?>
                          <small> - <?=$ProdutoAddUpdt->sid->getNode('procedencia_empresa'); ?></small>                          
                      </h1>
                      <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-home"></i> <a href="<?= URL ?>">Home</a>
                        </li>
                        <?php
                          if(intval($ProdutoAddUpdt->myfields['produto_id'],10)!=0 && 
                                    $ProdutoAddUpdt->permission['inserir']==1){
                        ?>                        
                        <li class="active">
                            <i class="fa fa-plus"></i> <a href="produto/addupdt/">Adicionar</a>
                        </li>
                        <?php
                          }
                        ?>
                        <li>
                            <i class="fa fa-refresh"></i> <a href="produto/addupdt/<?= $layout->getParameter() ?>">Atualizar</a>
                        </li>
                        
                        <li>
                            <i class="fa fa-tasks"></i> <a href="produto/">Planilha</a>
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
                          <div class="col-sm-4">
                            <div class="form-group">                              
                              <img src="<?= $foto; ?>" class="foto-produto" />

                              <input type="hidden" id="produto_foto" name="produto_foto" class="form-control" value="<?= $foto; ?>">                              
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-4">
                              <label>Código de Barras:</label>
                            <div class="form-group input-group">
                              <input style="text-align: center;" type="text" name="produto_cod_barras" id="produto_cod_barras" data-toggle="tooltip" data-placement="bottom" title="Informe o código de barras padrão EAN13" class="form-control" maxlength="13" autofocus="" autocomplete="off" data-mask="number" value="<?=$ProdutoAddUpdt->myfields['produto_cod_barras']; ?>" >
                              <span class="input-group-btn">
                                <button tabindex="-1" class="btn btn-info" type="button" id="btn_produto_cod_barras" data-toggle="tooltip" data-placement="top" title="Pesquisar Código Barras"><i class="fa fa-search"></i></button>
                              </span>                              
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-12">                  
                                <label>* Nome:</label>
                            <div class="form-group">
                                <input type="text" autocomplete="off"  name="produto_descricao" id="produto_descricao" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do produto" class="form-control" maxlength="29" autocomplete="off" value="<?=$ProdutoAddUpdt->myfields['produto_descricao']; ?>">
                            </div>
                          </div>                        
                        </div>    
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Unidade Medida:</label>
                              <input type="text" autocomplete="off"  style="text-align: center;" name="produto_um" id="produto_um" data-toggle="tooltip" data-placement="bottom" title="Informe a unidade de medida do Produto. Ex: UN para unidade." class="form-control" autocomplete="off" maxlength="3" value="<?=$ProdutoAddUpdt->myfields['produto_um']; ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Quantidade:</label>                              
                              <input style="text-align: right;" type="text" name="produto_um_quant" id="produto_um_quant"  class="form-control" autocomplete="off" maxlength="9" data-toggle="tooltip" data-placement="bottom" title="Informe a a quantidade em unidades contida na unidade de medida. Nota se a unidade de medida for UN a quantidade será sempre 1." data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_um_quant']; ?>" >
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>* Embalagem Com:</label>
                              <input style="text-align: right;" type="text" name="produto_emb_com" id="produto_emb_com" data-toggle="tooltip" data-placement="bottom" title="Informe a quantidade de itens que compõe a embalagem do produto." class="form-control" autocomplete="off" maxlength="9" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_um_quant']; ?>" >
                            </div>
                          </div>                          
                        </div>
                        <!-- //--> 
                        <div class="row">
                          <div class="col-sm-5">                       
                            <label>* <a href="fabricante/" target="_blank">Fabricante</a>:</label>
                            <div class="form-group input-group" style="min-width: 110px;">
                              <input type="text" autocomplete="off"  placeholder="* Fabricante" name="produto_fabricante" id="produto_fabricante" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do fabricante do produto." class="form-control" autocomplete="off" maxlength="30" value="<?=$ProdutoAddUpdt->myfields['produto_fabricante']; ?>" >
                              <span class="input-group-btn">
                                <button tabindex="-1" class="btn btn-success" type="button" id="btn_add_fabricante" data-toggle="tooltip" data-placement="top" title="Adicionar Fabricante"><i class="fa fa-plus"></i></button>
                              </span>                           
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-4">
                            <label>* <a href="grupo/" target="_blank">Grupo</a>:</label>
                            <div class="form-group input-group" style="min-width: 110px;">
                              <input type="text" autocomplete="off"  placeholder="* Grupo:" name="produto_grupo" id="produto_grupo" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do grupo do produto." class="form-control" maxlength="30" autocomplete="off" value="<?=$ProdutoAddUpdt->myfields['produto_grupo']; ?>">
                              <input type="hidden" name="produto_grupo_id" id="produto_grupo_id" class="form-control" autocomplete="off" value="<?=$ProdutoAddUpdt->myfields['produto_grupo_id']; ?>">
                              <span class="input-group-btn">
                                <button tabindex="-1" class="btn btn-success" type="button" id="btn_add_grupo" data-toggle="tooltip" data-placement="top" title="Adicionar Grupo"><i class="fa fa-plus"></i></button>
                              </span>                           
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-3">
                            <label>* Cód. Interno:</label>
                            <div class="form-group input-group" style="min-width: 110px;">
                              <input type="text" autocomplete="off"  placeholder="* Cód. Interno" name="produto_codigo_interno" id="produto_codigo_interno" data-toggle="tooltip" data-placement="bottom" title="Informe a descrição do código interno do produto." autocomplete="off" class="form-control" maxlength="6" value="<?=$ProdutoAddUpdt->myfields['produto_codigo_interno']; ?>" >
                              <span class="input-group-btn">
                                <button tabindex="-1" class="btn btn-info" type="button" id="btn_produto_cod_interno" data-toggle="tooltip" data-placement="top" title="Gerar Código Interno"><i class="fa fa-search"></i></button>
                              </span>                              
                            </div>
                          </div>
                        </div>
                        <!-- //-->
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Valor Custo R$:</label>
                              <input type="text" autocomplete="off"  style="text-align: right;" name="produto_val_custo" id="produto_val_custo" data-toggle="tooltip" data-placement="bottom" title="Informe o valor em reais referente ao custo do produto" class="form-control" autocomplete="off" maxlength="13" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_val_custo']; ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Margem Lucro %:</label>                              
                              <input style="text-align: right;" type="text" name="produto_margem_lucro" id="produto_margem_lucro" data-toggle="tooltip" data-placement="bottom" title="Informe o valor em percentual referente margem de lucro aplicada ao valor de custo do produto." class="form-control" maxlength="13" autocomplete="off" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_margem_lucro']; ?>" >
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Valor Revenda R$:</label>
                              <input readonly="" style="text-align: right;" type="text" name="produto_val_revenda" id="produto_val_revenda" data-toggle="tooltip" data-placement="bottom" title="O preço de venda é a relação entre o preço de csuto + a margem de lucro aplicada ao produto." class="form-control" maxlength="13" autocomplete="off" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_val_revenda']; ?>" >
                            </div>
                          </div>
                          <!-- //-->
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Valor Desconto %:</label>
                              <input style="text-align: right;" type="text" name="produto_desconto" id="produto_desconto" data-toggle="tooltip" data-placement="bottom" title="Informe o valor em percentual referente ao desconto que o vendedor poderá aplicar à este produto." class="form-control" autocomplete="off" maxlength="13" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_desconto']; ?>" >
                            </div>
                          </div>                          
                        </div>                        
                        <!-- //-->                        
                        <div class="row">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Estoque Mínimo:</label>
                              <input type="text" autocomplete="off"  style="text-align: right;" name="produto_estoque_minimo" id="produto_estoque_minimo" data-toggle="tooltip" data-placement="bottom" title="Informe a quantidade mínima em que o produto será considerado estoque crítico." class="form-control" autocomplete="off" maxlength="13" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_estoque_minimo']; ?>">
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Estoque Máximo:</label>                              
                              <input style="text-align: right;" type="text" name="produto_estoque_maximo" id="produto_estoque_maximo" data-toggle="tooltip" data-placement="bottom" title="Informe a quantidade máxima em que o produto será considerado estoque máximo." class="form-control" maxlength="13" autocomplete="off" data-mask="currency" value="<?=$ProdutoAddUpdt->myfields['produto_estoque_maximo']; ?>" >
                            </div>
                          </div>
                          <!-- //-->                          
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>* Uso Interno:</label>
                              <input style="text-align: center;" type="text" name="produto_uso_interno" id="produto_uso_interno" data-toggle="tooltip" data-placement="bottom" title="Digite [S] para sim ou [N] para não." class="form-control" maxlength="1" data-last-input="1" autocomplete="off" data-mask="custom" data-custom="[^SNsn]" value="<?=$ProdutoAddUpdt->myfields['produto_uso_interno']; ?>" >
                              <p class="help-block" id="produto_uso_interno_p">Produto de uso externo</p>
                            </div>
                          </div>                         
                        </div> 
                        <!-- //-->                        
                        <div class="form-group">
                           <fieldset class="fieldset">
                              <legend>Status:</legend>
                                <label class="radio-inline">
                                    <input type="radio" name="produto_status" value="1" checked>Ativo
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="produto_status" value="0" >Inativo
                                </label>
                            </fieldset>
                        </div>                         
                        <div class="form-group">
                          <input type="hidden" name="produto_id" id="produto_id" class="form-control" value="<?=(int)$ProdutoAddUpdt->myfields['produto_id']; ?>">
                        </div>                        
                        <!-- //-->
                        <button type="submit" class="btn btn-success ipage-btn" id="btn_submit"><i class="fa fa-floppy-o"></i> Salvar</button>
                        <a href="produto/">
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
  <!-- //-->
  <?php $layout->createCookie(); ?>
  <!-- //-->  
  <?php include_once $nivel . 'inc_js.php'; ?>
  <!-- //-->  
  <script src="application/views/produto/produto/js/ProdutoAddUpdt.js" type="text/javascript"></script>
</body>
</html>
