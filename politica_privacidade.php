<?php  
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Política Privacidade
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
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
                          Política de Privacidade
                      </h1>
                  </div>
              </div>
              <!-- //-->
              <div class="row">
                <div class="col-md-12">
                  <h4><strong>Informações ao usuário</strong></h4>
                  <p>
                    Suas informações são importantes, pois nos ajudam a tornar este aplicativo melhor e cada vez mais direcionado à você,
                    usuário, na busca de sua total satisfação.
                  </p>
                  <p>Sua privacidade é nossa preocupação. Temos o compromisso de preservá-la.</p>
                  <p>
                    Nossa política de privacidade visa assegurar a garantia de que, quaisquer informações relativas aos usuários,
                    não serão fornecidas, publicadas ou comercializadas em quaisquer circunstâncias.
                  </p>
                  <p>
                    A <strong>IPAGE SOFTWARE &reg;</strong> obtém informações dos usuários de duas maneiras: Cadastro e Cookies.
                  </p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Cadastro</strong></h3>
                    <p>
                      Para usufruir dos benefícios adicionais do site e receber o email com Ofertas Exclusivas, você precisa se cadastrar
                      na <strong>IPAGE SOFTWARE &reg;</strong>.
                    </p>
                    <p>
                      Este cadastro é armazenado em um banco de dados protegido e sigiloso. Qualquer comunicação enviada para seu email
                      será através do boletim periódico da <strong>IPAGE SOFTWARE &reg;</strong>. Seu email não será divulgado.
                    </p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Cookies</strong></h3>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> coleta informações através de cookies (informações enviadas pelo servidor da <strong>IPAGE SOFTWARE &reg;</strong> ao
                  computador do usuário, para identificá-lo).</p>
                  <p>Os cookies servem unicamente para controle interno de audiência e de navegação e jamais para controlar, identificar
                  ou rastrear preferências do internauta, exceto quando este desrespeitar alguma regra de segurança ou exercer alguma
                  atividade prejudicial ao bom funcionamento do site, como por exemplo tentativas de hackear o serviço.</p>
                  <p>A aceitação dos cookies pode ser livremente alterada na configuração de seu navegador.</p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h3 class="page-title"><strong>Segurança das informações</strong></h3>
                    <p>
                      Todos os dados pessoais informados ao nosso site são armazenados em um banco de dados reservado e com acesso restrito
                      a alguns funcionários habilitados, que são obrigados, por contrato, a manter a confidencialidade das informações e não
                      utilizá-las inadequadamente.
                    </p>
                    <p>
                      Assegurar a sua privacidade é mais um compromisso da <strong>IPAGE SOFTWARE &reg;</strong> com você!
                    </p>
                    <p>
                      Antes de usufruir de nossos serviços leia atentamente nosso Termo de Uso. Caso não esteja de acordo, por favor, não os
                      utilize.
                    </p>
                    <p>
                      Os dados da busca são obtidos em sua maioria de forma automática e podem não representar o preço real praticado pelas
                      lojas.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> não se responsabiliza pela inexatidão nas informações enviadas pelas lojas ou obtidas pela ferramenta
                      de busca.
                    </p>
                    <p>
                      Sempre verifique no site da loja o preço e as condições de pagamento antes de concluir a compra. Confira o valor do
                      serviço de entrega. Exija sempre nota fiscal.
                    </p>
                    <p>
                      As opiniões sobre produtos e empresas são enviadas pelos consumidores. Elas não refletem a opinião da <strong>IPAGE SOFTWARE &reg;</strong>,
                      que se isenta de qualquer responsabilidade sobre informações enviadas por seus usuários. As avaliações das lojas são
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
  <!-- SEMPRE POR ÚLTIMO //-->
  <script src="application/views/index/js/Index.js" type="text/javascript"></script>    
</body>
</html>
