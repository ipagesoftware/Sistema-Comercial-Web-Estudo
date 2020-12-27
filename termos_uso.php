<?php  
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Termos de uso
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
*/
require_once "config.php";
require_once "vendor/autoload.php";
//
$layout       = new App\Layout\LayoutClass();
$navBarHeader = $layout->topHeader();
$menuLateral  = $layout->menuLateral('TERMOS_USO',3); 
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
                          Termos de Uso
                      </h1>
                  </div>
              </div>
              <!-- //-->

              <div class="row">
                <div class="col-md-12">
                  <p>Ao acessar e utilizar esta aplica��o web, o usu�rio aceita submeter-se �s seguintes condi��es de utiliza��o e � todos os termos e condi��es contidos ou a que se faz refer�ncia no presente documento ou a qualquer termo ou condi��o que se estabele�a para esta aplica��o web, sendo que as respectivas condi��es devem ser devidamente cumpridas.</p>
                  <p>Se o usu�rio N�O aceitar todas estas condi��es de utiliza��o, N�O dever� utilizar esta aplica��o web.</p>
                  <p>Se o usu�rio N�O aceitar qualquer outra condi��o adicional espec�fica que deva aplicar-se a um conte�do em particular (tal como se define em seguida) ou a certas transa��es que se efetuem atrav�s desta aplica��o web, o usu�rio N�O dever� utilizar a sec��o desta aplica��o web que contenha o referido conte�do ou atrav�s da qual se possam efetuar as mesmas transa��es e n�o dever� utilizar este conte�do nem proceder a essas transa��es.</p>
                  <p>Estes Termos de Utiliza��o podem ser modificados pela <strong>IPAGE SOFTWARE &reg;</strong> a qualquer momento.</p>
                  <p>Uma vez modificadas, as condi��es de utiliza��o ter�o efeito a partir do momento em que forem introduzidas nesta aplica��o web.</p>
                  <p>Reveja, por favor, as condi��es de utiliza��o publicadas nesta aplica��o web de forma regular para o usu�rio se assegurar de que conhece todos os termos que regem o uso desta aplica��o web.</p>
                  <p>Pode haver outras aplica��o web da <strong>IPAGE SOFTWARE &reg;</strong> que tenham as suas pr�prias condi��es de utiliza��o, que ser�o as que se aplicar�o a essas aplica��o web.</p>
                  <p>Tamb�m podem existir condi��es espec�ficas de utiliza��o para alguns dos conte�dos, produtos, materiais, servi�os ou informa��o que contenham ou que se possam acender atrav�s desta aplica��o web ("Conte�do") ou para as transa��es que se possam levar a cabo atrav�s desta aplica��o web.</p>
                  <p>Tais condi��es espec�ficas podem ser um complemento destas condi��es de utiliza��o ou, quando assim se especifique e somente se o conte�do ou o objetivo dessas condi��es espec�ficas resultar no oposto do que � determinado nos termos que se especificam nestas condi��es de utiliza��o, essas condi��es espec�ficas anular�o estas condi��es de utiliza��o.</p>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> reserva-se o direito de proceder a altera��es ou atualiza��es relativamente a ou sobre o conte�do desta aplica��o web ou sobre o formato utilizado em qualquer momento e sem aviso pr�vio.</p>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> reserva-se o direito de cancelar ou de restringir o acesso a esta aplica��o web seja por que causa for e � sua inteira discri��o.</p>
                  <p>Embora tenha havido especial cuidado em assegurar que toda a informa��o contida nesta aplica��o web esteja correta, a <strong>IPAGE SOFTWARE &reg;</strong> n�o assumir� nenhum tipo de responsabilidade que da� possa advir.</p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h1 class="page-header">Todo o conte�do � proporcionado "Tal como �" e "Tal como est� dispon�vel".</h1>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> RECUSA, PORTANTO E EXPRESSAMENTE, ACEITAR QUALQUER TIPO DE REPRESENTA��O OU GARANTIA,
                      EXPRESSA OU IMPL�CITA, INCLUINDO, SEM NENHUMA LIMITA��O, AS GARANTIAS DE COMERCIALIZA��O, ADEQUA��O A UM DETERMINADO FIM,
                      N�O INFRA��O, OU FUNCIONAMENTO DESTA APLICA��O WEB OU DO SEU CONTE�DO.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> N�O GARANTE NEM EFETUA NENHUMA REPRESENTA��O SOBRE A SEGURAN�A DESTA APLICA��O WEB,
                      PELO QUE DEVE TER-SE EM CONTA QUE QUALQUER INFORMA��O ENVIADA PODER� SER INTERCEPTADA.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> N�O GARANTE QUE ESTA APLICA��O WEB, OS SERVIDORES QUE UTILIZAM ESTA APLICA��O WEB OU
                      OS MEIOS ELETR�NICOS DE COMUNICA��O QUE A <strong>IPAGE SOFTWARE &reg;</strong> ENVIE ESTEJAM LIVRES DE V�RUS OU DE QUALQUER
                      OUTRO ELEMENTO QUE POSSA SER PREJUDICIAL.
                    </p>
                    <p>
                      EM NENHUM CASO SER� A <strong>IPAGE SOFTWARE &reg;</strong> OU QUALQUER DAS SUAS AFILIADAS RESPONS�VEL POR QUALQUER DANO DIRETO,
                      INDIRETO, CONSEQUENCIAL, PUN�VEL, ESPECIAL OU INCIDENTAL (INCLUINDO, SEM LIMITA��O, OS DANOS RELATIVOS A PERDAS EM NEG�CIOS,
                      CONTRATOS, INVESTIMENTOS, DADOS, INFORMA��O OU INTERRUP��ES NO NEG�CIO) OCASIONADOS, ORIGINADOS OU EM LIGA��O COM O USO OU A
                      IMPOSSIBILIDADE DE UTILIZAR ESTA APLICA��O WEB OU O SEU CONTE�DO, INCLUSIVE SE A <strong>IPAGE SOFTWARE &reg;</strong>
                      TIVER SIDO AVISADA DA POSSIBILIDADE DE TAIS DANOS.
                    </p>
                    <p>
                      QUALQUER A��O QUE SE EMPREENDA CONTRA A <strong>IPAGE SOFTWARE &reg;</strong> POR OU EM CONEX�O COM ESTA APLICA��O WEB DEVE
                      SER COME�ADA NOTIFICANDO-SE A <strong>IPAGE SOFTWARE &reg;</strong> POR ESCRITO DENTRO DO PRAZO DE UM (1) ANO A CONTAR DA
                      DATA EM QUE SE TENHA PRODUZIDO A CAUSA QUE D� ORIGEM A ESSA A��O.
                    </p>
                    <p>
                      Esta aplica��o web pode conter links com outros website que n�o se encontrem sob o controle da <strong>IPAGE SOFTWARE &reg;</strong>.
                      A <strong>IPAGE SOFTWARE &reg;</strong> n�o ser� respons�vel de modo algum pelo conte�do de outros website.
                      A <strong>IPAGE SOFTWARE &reg;</strong> proporciona esses links apenas para comodidade do utilizador desta aplica��o web, e a
                      inclus�o de um link a outros website n�o implica rela��o alguma da <strong>IPAGE SOFTWARE &reg;</strong> com o conte�do dessas p�ginas.
                    </p>
                    <p>
                      Os "copyrights" e demais direitos de propriedade sobre o conte�do (incluindo, sem limita��es, software, �udio, v�deo, texto e fotografias)
                      pertencem � <strong>IPAGE SOFTWARE &reg;</strong> ou aos propriet�rios das licen�as correspondentes. Reservam-se todos os direitos sobre
                      o conte�do que n�o estejam expressamente garantidos pelo presente documento. Exceto quando se comprove o contr�rio, o conte�do publicado
                      nesta aplica��o web s� pode ser reproduzido ou distribu�do sem altera��o para uso pessoal e nunca comercial. Est� estritamente proibido
                      qualquer outro uso do conte�do, incluindo, sem limita��o, a distribui��o, a reprodu��o, a modifica��o, a visualiza��o ou a transmiss�o
                      sem autoriza��o pr�via por escrito da <strong>IPAGE SOFTWARE &reg;</strong>. Todos os "copyrights" e demais notifica��es sobre a
                      propriedade deste material devem constar em todas as reprodu��es.
                    </p>
                    <p>
                      Qualquer material que seja enviado atrav�s ou em liga��o com esta aplica��o web ("Materiais procedentes do usu�rio") ser� tratado como
                      n�o confidencial e n�o est� sujeito a direito de propriedade, convertendo-se de forma imediata em propriedade da <strong>IPAGE SOFTWARE &reg;</strong>,
                      e estar� sujeito � pol�tica de privacidade assinalada nesta aplica��o web. A <strong>IPAGE SOFTWARE &reg;</strong> pode fazer uso desses
                      Materiais procedentes do usu�rio conforme considere oportuno, em qualquer lugar do mundo, sem obriga��o alguma de compensa��o, e livre de todo
                      o direito moral, direitos de propriedade intelectual e/ou outros direitos de propriedade sobre esses Materiais procedentes do usu�rio.</p>
                      <p>Esta aplica��o web pode conter refer�ncias a certos produtos e servi�os espec�ficos da <strong>IPAGE SOFTWARE &reg;</strong> que poder�o
                      n�o estar dispon�veis (totalmente) em alguns pa�ses. Tal refer�ncia n�o implica ou garante que esses produtos ou servi�os estejam dispon�veis
                      em qualquer momento e em qualquer pa�s. Contacte, por favor, o seu distribuidor habitual <strong>IPAGE SOFTWARE &reg;</strong> para obter mais
                      informa��o a esse respeito.
                    </p>
                    <p>
                      A licen�a de software que se pode utilizar atrav�s ou a partir desta aplica��o web est� sujeita aos termos do acordo de licen�a aplic�vel.
                      Exceto pelo que for especificado no acordo de licen�a aplic�vel, somente os usu�rios podem utilizar o software e fica expressamente proibida
                      qualquer outra c�pia, reprodu��o ou redistribui��o desse software.</p>

                    <p>
                      AS GARANTIAS, SE AS HOUVER, RELATIVAS A TAL SOFTWARE S� SE APLICAR�O TAL E COMO ESTIVER EXPRESSAMENTE FIXADO NO ACORDO DE LICEN�A APLIC�VEL.
                      PELO PRESENTE DOCUMENTO, A <strong>IPAGE SOFTWARE &reg;</strong> RECUSA EXPRESSAMENTE QUALQUER REPRESENTA��O E GARANTIA DE QUALQUER TIPO,
                      EXPRESSA OU IMPL�CITA, INCLUINDO, SEM LIMITA��O ALGUMA, AS GARANTIAS DE COMERCIALIZA��O, ADEQUA��O A UM DETERMINADO FIM OU N�O INFRA��O
                      COM RESPEITO A ESTE SOFTWARE.
                    </p>
                    <p>
                      Estas condi��es de utiliza��o est�o sob a jurisdi��o e ser�o redigidas de acordo com as leis brasileiras sem ter em conta os princ�pios de
                      conflitos de leis. O usu�rio aceita submeter-se � jurisdi��o exclusiva dos tribunais do Brasil para qualquer reclama��o ou exerc�cio de a��o
                      que possa derivar de, esteja relacionada com ou em liga��o com estas condi��es de utiliza��o ou com esta aplica��o web, sempre e quando essa
                      exclusividade se aplique �s a��es legais que a <strong>IPAGE SOFTWARE &reg;</strong> inicie ou empreenda. A informa��o de car�ter pessoal que
                      se forne�a ou se recolha atrav�s ou em liga��o com esta aplica��o web s� ser� utilizada de acordo com a Pol�tica de Privacidade da
                      <strong>IPAGE SOFTWARE &reg;</strong>.
                    </p>
                    <p>
                      Se o usu�rio desejar fazer alguma pergunta ou formular alguma queixa, por favor contate-nos atrav�s do link "FALE CONOSCO" que se encontra
                      na parte inferior desta aplica��o web.
                    </p>
                    <p class="text-right">
                      <br />
                      <strong>�ltima atualiza��o:  <?= LAST_DATE ?></strong>
                    </p>
                </div>
              </div>
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
