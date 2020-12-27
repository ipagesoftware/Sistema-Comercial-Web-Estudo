/**
 * @version    1.0
 * @package    Estoque
 * @subpackage Movimentação
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
    Metrics
      There are 7 functions in this file.
      Function with the largest signature take 7 arguments, while the median is 1.
      Largest function has 28 statements in it, while the median is 5.
      The most complex function has a cyclomatic complexity value of 7 while the median is 1.
*/

$(document).ready(function() {    
    Movimentacao.init();
});

var Movimentacao = function() {
  return{
    init: function(par) {
        $("#form1").attr("action", "javascript:Movimentacao.submitForm();void(0);");
        IpageApp.wait(false); 
    },
    viewReg: function(id, produto){
      // Criptografa o critério
      var cUrl = new IPAGE_url_encodeClass();
      var par  = cUrl.urlGenerator();
      var link = "application/views/estoque/ajuste/index.php";
      var title = 'MOVIMENTAÇÃO ESTOQUE - ';
          title += '<span  class="label label-success">';
          title += id;
          title += ' - ';
          title += produto;
          title += '</span>';
      //
      par += '&parameter6=' + id;
      serializeDados = '?parameter1=' + cUrl.encodeHex($.base64.encode(par));
      link += serializeDados;
      //
      IpageApp.loadPage("myModal", link, title, '500px', '', true, '', function(r){
        window.location.reload();
      });
      return false;
    }
  };
}();