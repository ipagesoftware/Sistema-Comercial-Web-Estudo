<?php  
/**
 * @version    1.0
 * @package    Sistema
 * @subpackage Termos de uso
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
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
                  <p>Ao acessar e utilizar esta aplicação web, o usuário aceita submeter-se às seguintes condições de utilização e à todos os termos e condições contidos ou a que se faz referência no presente documento ou a qualquer termo ou condição que se estabeleça para esta aplicação web, sendo que as respectivas condições devem ser devidamente cumpridas.</p>
                  <p>Se o usuário NÃO aceitar todas estas condições de utilização, NÃO deverá utilizar esta aplicação web.</p>
                  <p>Se o usuário NÃO aceitar qualquer outra condição adicional específica que deva aplicar-se a um conteúdo em particular (tal como se define em seguida) ou a certas transações que se efetuem através desta aplicação web, o usuário NÃO deverá utilizar a secção desta aplicação web que contenha o referido conteúdo ou através da qual se possam efetuar as mesmas transações e não deverá utilizar este conteúdo nem proceder a essas transações.</p>
                  <p>Estes Termos de Utilização podem ser modificados pela <strong>IPAGE SOFTWARE &reg;</strong> a qualquer momento.</p>
                  <p>Uma vez modificadas, as condições de utilização terão efeito a partir do momento em que forem introduzidas nesta aplicação web.</p>
                  <p>Reveja, por favor, as condições de utilização publicadas nesta aplicação web de forma regular para o usuário se assegurar de que conhece todos os termos que regem o uso desta aplicação web.</p>
                  <p>Pode haver outras aplicação web da <strong>IPAGE SOFTWARE &reg;</strong> que tenham as suas próprias condições de utilização, que serão as que se aplicarão a essas aplicação web.</p>
                  <p>Também podem existir condições específicas de utilização para alguns dos conteúdos, produtos, materiais, serviços ou informação que contenham ou que se possam acender através desta aplicação web ("Conteúdo") ou para as transações que se possam levar a cabo através desta aplicação web.</p>
                  <p>Tais condições específicas podem ser um complemento destas condições de utilização ou, quando assim se especifique e somente se o conteúdo ou o objetivo dessas condições específicas resultar no oposto do que é determinado nos termos que se especificam nestas condições de utilização, essas condições específicas anularão estas condições de utilização.</p>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> reserva-se o direito de proceder a alterações ou atualizações relativamente a ou sobre o conteúdo desta aplicação web ou sobre o formato utilizado em qualquer momento e sem aviso prévio.</p>
                  <p>A <strong>IPAGE SOFTWARE &reg;</strong> reserva-se o direito de cancelar ou de restringir o acesso a esta aplicação web seja por que causa for e à sua inteira discrição.</p>
                  <p>Embora tenha havido especial cuidado em assegurar que toda a informação contida nesta aplicação web esteja correta, a <strong>IPAGE SOFTWARE &reg;</strong> não assumirá nenhum tipo de responsabilidade que daí possa advir.</p>
                </div>
              </div>
              <!--// //-->
              <div class="row">
                <div class="col-md-12">
                  <h1 class="page-header">Todo o conteúdo é proporcionado "Tal como é" e "Tal como está disponível".</h1>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> RECUSA, PORTANTO E EXPRESSAMENTE, ACEITAR QUALQUER TIPO DE REPRESENTAÇÃO OU GARANTIA,
                      EXPRESSA OU IMPLÍCITA, INCLUINDO, SEM NENHUMA LIMITAÇÃO, AS GARANTIAS DE COMERCIALIZAÇÃO, ADEQUAÇÃO A UM DETERMINADO FIM,
                      NÃO INFRAÇÃO, OU FUNCIONAMENTO DESTA APLICAÇÃO WEB OU DO SEU CONTEÚDO.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> NÃO GARANTE NEM EFETUA NENHUMA REPRESENTAÇÃO SOBRE A SEGURANÇA DESTA APLICAÇÃO WEB,
                      PELO QUE DEVE TER-SE EM CONTA QUE QUALQUER INFORMAÇÃO ENVIADA PODERÁ SER INTERCEPTADA.
                    </p>
                    <p>
                      A <strong>IPAGE SOFTWARE &reg;</strong> NÃO GARANTE QUE ESTA APLICAÇÃO WEB, OS SERVIDORES QUE UTILIZAM ESTA APLICAÇÃO WEB OU
                      OS MEIOS ELETRÔNICOS DE COMUNICAÇÃO QUE A <strong>IPAGE SOFTWARE &reg;</strong> ENVIE ESTEJAM LIVRES DE VÍRUS OU DE QUALQUER
                      OUTRO ELEMENTO QUE POSSA SER PREJUDICIAL.
                    </p>
                    <p>
                      EM NENHUM CASO SERÁ A <strong>IPAGE SOFTWARE &reg;</strong> OU QUALQUER DAS SUAS AFILIADAS RESPONSÁVEL POR QUALQUER DANO DIRETO,
                      INDIRETO, CONSEQUENCIAL, PUNÍVEL, ESPECIAL OU INCIDENTAL (INCLUINDO, SEM LIMITAÇÃO, OS DANOS RELATIVOS A PERDAS EM NEGÓCIOS,
                      CONTRATOS, INVESTIMENTOS, DADOS, INFORMAÇÃO OU INTERRUPÇÕES NO NEGÓCIO) OCASIONADOS, ORIGINADOS OU EM LIGAÇÃO COM O USO OU A
                      IMPOSSIBILIDADE DE UTILIZAR ESTA APLICAÇÃO WEB OU O SEU CONTEÚDO, INCLUSIVE SE A <strong>IPAGE SOFTWARE &reg;</strong>
                      TIVER SIDO AVISADA DA POSSIBILIDADE DE TAIS DANOS.
                    </p>
                    <p>
                      QUALQUER AÇÃO QUE SE EMPREENDA CONTRA A <strong>IPAGE SOFTWARE &reg;</strong> POR OU EM CONEXÃO COM ESTA APLICAÇÃO WEB DEVE
                      SER COMEÇADA NOTIFICANDO-SE A <strong>IPAGE SOFTWARE &reg;</strong> POR ESCRITO DENTRO DO PRAZO DE UM (1) ANO A CONTAR DA
                      DATA EM QUE SE TENHA PRODUZIDO A CAUSA QUE DÊ ORIGEM A ESSA AÇÃO.
                    </p>
                    <p>
                      Esta aplicação web pode conter links com outros website que não se encontrem sob o controle da <strong>IPAGE SOFTWARE &reg;</strong>.
                      A <strong>IPAGE SOFTWARE &reg;</strong> não será responsável de modo algum pelo conteúdo de outros website.
                      A <strong>IPAGE SOFTWARE &reg;</strong> proporciona esses links apenas para comodidade do utilizador desta aplicação web, e a
                      inclusão de um link a outros website não implica relação alguma da <strong>IPAGE SOFTWARE &reg;</strong> com o conteúdo dessas páginas.
                    </p>
                    <p>
                      Os "copyrights" e demais direitos de propriedade sobre o conteúdo (incluindo, sem limitações, software, áudio, vídeo, texto e fotografias)
                      pertencem à <strong>IPAGE SOFTWARE &reg;</strong> ou aos proprietários das licenças correspondentes. Reservam-se todos os direitos sobre
                      o conteúdo que não estejam expressamente garantidos pelo presente documento. Exceto quando se comprove o contrário, o conteúdo publicado
                      nesta aplicação web só pode ser reproduzido ou distribuído sem alteração para uso pessoal e nunca comercial. Está estritamente proibido
                      qualquer outro uso do conteúdo, incluindo, sem limitação, a distribuição, a reprodução, a modificação, a visualização ou a transmissão
                      sem autorização prévia por escrito da <strong>IPAGE SOFTWARE &reg;</strong>. Todos os "copyrights" e demais notificações sobre a
                      propriedade deste material devem constar em todas as reproduções.
                    </p>
                    <p>
                      Qualquer material que seja enviado através ou em ligação com esta aplicação web ("Materiais procedentes do usuário") será tratado como
                      não confidencial e não está sujeito a direito de propriedade, convertendo-se de forma imediata em propriedade da <strong>IPAGE SOFTWARE &reg;</strong>,
                      e estará sujeito à política de privacidade assinalada nesta aplicação web. A <strong>IPAGE SOFTWARE &reg;</strong> pode fazer uso desses
                      Materiais procedentes do usuário conforme considere oportuno, em qualquer lugar do mundo, sem obrigação alguma de compensação, e livre de todo
                      o direito moral, direitos de propriedade intelectual e/ou outros direitos de propriedade sobre esses Materiais procedentes do usuário.</p>
                      <p>Esta aplicação web pode conter referências a certos produtos e serviços específicos da <strong>IPAGE SOFTWARE &reg;</strong> que poderão
                      não estar disponíveis (totalmente) em alguns países. Tal referência não implica ou garante que esses produtos ou serviços estejam disponíveis
                      em qualquer momento e em qualquer país. Contacte, por favor, o seu distribuidor habitual <strong>IPAGE SOFTWARE &reg;</strong> para obter mais
                      informação a esse respeito.
                    </p>
                    <p>
                      A licença de software que se pode utilizar através ou a partir desta aplicação web está sujeita aos termos do acordo de licença aplicável.
                      Exceto pelo que for especificado no acordo de licença aplicável, somente os usuários podem utilizar o software e fica expressamente proibida
                      qualquer outra cópia, reprodução ou redistribuição desse software.</p>

                    <p>
                      AS GARANTIAS, SE AS HOUVER, RELATIVAS A TAL SOFTWARE SÓ SE APLICARÃO TAL E COMO ESTIVER EXPRESSAMENTE FIXADO NO ACORDO DE LICENÇA APLICÁVEL.
                      PELO PRESENTE DOCUMENTO, A <strong>IPAGE SOFTWARE &reg;</strong> RECUSA EXPRESSAMENTE QUALQUER REPRESENTAÇÃO E GARANTIA DE QUALQUER TIPO,
                      EXPRESSA OU IMPLÍCITA, INCLUINDO, SEM LIMITAÇÃO ALGUMA, AS GARANTIAS DE COMERCIALIZAÇÃO, ADEQUAÇÃO A UM DETERMINADO FIM OU NÃO INFRAÇÃO
                      COM RESPEITO A ESTE SOFTWARE.
                    </p>
                    <p>
                      Estas condições de utilização estão sob a jurisdição e serão redigidas de acordo com as leis brasileiras sem ter em conta os princípios de
                      conflitos de leis. O usuário aceita submeter-se à jurisdição exclusiva dos tribunais do Brasil para qualquer reclamação ou exercício de ação
                      que possa derivar de, esteja relacionada com ou em ligação com estas condições de utilização ou com esta aplicação web, sempre e quando essa
                      exclusividade se aplique às ações legais que a <strong>IPAGE SOFTWARE &reg;</strong> inicie ou empreenda. A informação de caráter pessoal que
                      se forneça ou se recolha através ou em ligação com esta aplicação web só será utilizada de acordo com a Política de Privacidade da
                      <strong>IPAGE SOFTWARE &reg;</strong>.
                    </p>
                    <p>
                      Se o usuário desejar fazer alguma pergunta ou formular alguma queixa, por favor contate-nos através do link "FALE CONOSCO" que se encontra
                      na parte inferior desta aplicação web.
                    </p>
                    <p class="text-right">
                      <br />
                      <strong>Última atualização:  <?= LAST_DATE ?></strong>
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
  <!-- SEMPRE POR ÚLTIMO //-->
  <script src="application/views/index/js/Index.js" type="text/javascript"></script>    
</body>
</html>
