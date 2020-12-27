<?php  
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Pol�tica Privacidade
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
require_once "config.php";
require_once "vendor/autoload.php";
//
$layout       = new App\Layout\LayoutClass();
$navBarHeader = $layout->topHeader();
$menuLateral  = $layout->menuLateral('POLITICA_PRIVACIDADE',3); 
$footer       = $layout->createFooter();
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
          <?php echo($navBarHeader);
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
                          Pol�tica de Privacidade
                      </h1>
                  </div>
              </div>
              <!-- //-->
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>Informa��es ao usu�rio</strong></h4>
                  <p>
                    Suas informa��es s�o importantes, pois nos ajudam a tornar este aplicativo melhor e cada vez mais direcionado � voc�,
                    usu�rio, na busca de sua total satisfa��o.
                  </p>
                  <p>Sua privacidade � nossa preocupa��o. Temos o compromisso de preserv�-la.</p>
                  <p>
                    Nossa pol�tica de privacidade visa assegurar a garantia de que, quaisquer informa��es relativas aos usu�rios,
                    n�o ser�o fornecidas, publicadas ou comercializadas em quaisquer circunst�ncias.
                  </p>
                  <p>
                    A <strong>IPAGE SOFTWARE &reg;</strong> obt�m informa��es dos usu�rios de duas maneiras: Cadastro e Cookies.
                  </p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Cadastro</strong></h3>
                    <p>
                      Para usufruir dos benef�cios adicionais do site e receber o email com Ofertas Exclusivas, voc� precisa se cadastrar
                      na <strong>IPAGE SOFTWARE &reg;</strong>.
                    </p>
                    <p>
                      Este cadastro � armazenado em um banco de dados protegido e sigiloso. Qualquer comunica��o enviada para seu email
                      ser� atrav�s do boletim peri�dico da <strong>IPAGE SOFTWARE &reg;</strong>. Seu email n�o ser� divulgado.
                    </p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Cookies</strong></h3>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> coleta informa��es atrav�s de cookies (informa��es enviadas pelo servidor da <strong>IPAGE SOFTWARE &reg;</strong> ao
                  computador do usu�rio, para identific�-lo).</p>
                  <p>Os cookies servem unicamente para controle interno de audi�ncia e de navega��o e jamais para controlar, identificar
                  ou rastrear prefer�ncias do internauta, exceto quando este desrespeitar alguma regra de seguran�a ou exercer alguma
                  atividade prejudicial ao bom funcionamento do site, como por exemplo tentativas de hackear o servi�o.</p>
                  <p>A aceita��o dos cookies pode ser livremente alterada na configura��o de seu navegador.</p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Seguran�a das informa��es</strong></h3>
                    <p>
                      Todos os dados pessoais informados ao nosso site s�o armazenados em um banco de dados reservado e com acesso restrito
                      a alguns funcion�rios habilitados, que s�o obrigados, por contrato, a manter a confidencialidade das informa��es e n�o
                      utiliz�-las inadequadamente.
                    </p>
                    <p>
                      Assegurar a sua privacidade � mais um compromisso da <strong>IPAGE SOFTWARE &reg;</strong> com voc�!
                    </p>
                    <p>
                      Antes de usufruir de nossos servi�os leia atentamente nosso Termo de Uso. Caso n�o esteja de acordo, por favor, n�o os
                      utilize.
                    </p>
                    <p>
                      Os dados da busca s�o obtidos em sua maioria de forma autom�tica e podem n�o representar o pre�o real praticado pelas
                      lojas.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> n�o se responsabiliza pela inexatid�o nas informa��es enviadas pelas lojas ou obtidas pela ferramenta
                      de busca.
                    </p>
                    <p>
                      Sempre verifique no site da loja o pre�o e as condi��es de pagamento antes de concluir a compra. Confira o valor do
                      servi�o de entrega. Exija sempre nota fiscal.
                    </p>
                    <p>
                      As opini�es sobre produtos e empresas s�o enviadas pelos consumidores. Elas n�o refletem a opini�o da <strong>IPAGE SOFTWARE &reg;</strong>,
                      que se isenta de qualquer responsabilidade sobre informa��es enviadas por seus usu�rios. As avalia��es das lojas s�o
                      providas pela e-bit.
                    </p>
                </div>
              </div>
              <!-- END PAGE CONTENT-->
              <div style="height: 50px;"></div>
              <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
      </div>
      <!-- / FOOTER -->
      <?php
        echo($footer);
      ?>
      <!-- END FOOTER -->  
      <!-- /#page-wrapper -->
  </div>
  <!-- /#wrapper -->
  <?php include_once 'inc_js.php'; ?>
  <!-- SEMPRE POR �LTIMO //-->
  <script src="application/views/index/js/Index.js" type="text/javascript"></script>    
</body>
</html>
