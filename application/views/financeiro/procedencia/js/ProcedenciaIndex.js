/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Procedencia
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/

  Metrics
    There are 9 functions in this file.
    Function with the largest signature take 1 arguments, while the median is 1.
    Largest function has 8 statements in it, while the median is 1.
    The most complex function has a cyclomatic complexity value of 2 while the median is 1.
 */ 
$(document).ready(function() {
    Procedencia.init();
});
/**
 * [ProcedenciaIndex description]
 */
var Procedencia = function() {
    // Variáveis privadas
    // ...

    // Métodos privados
    // ...

    // Métodos públicos
    return {
        init: function() {
          //
        },
        delReg: function(id) {
            var link = $("body").data("url");
            link += "src/Delete/ajax/delete_ajax.php";
            var p = "id=" + id;
            p += "&tabela=procedencia";
            //
            ipageViews.deleteReg(link, p, function(txt) {
                switch (txt) {
                    case 'OK':
                        ipageViews.notyMessage("Operação realizada com sucesso!", 'success', 1000, function(result) {
                            window.location.reload();
                        });                        
                        break;
                    default:
                        ipageViews.notyMessage(txt, 'error', 0, function(result) {
                            window.location.reload();
                        });
                        break;
                }
            });
        },
        showModal: function(id) {
            var cUrl = new IPAGE_url_encodeClass();
            var par = cUrl.urlGenerator(3);
            var link = 'application/views/financeiro/procedencia/view.php';
            var title = id + ' - Dados Procedência';
            par += '&parameter4=' + cUrl.encodeHex($.base64.encode(id));
            link += '?parameter1=';
            link += cUrl.encodeHex($.base64.encode(par));
            //
            IpageApp.loadPage("myModal", link, title, '500px', '', true, null);
        },
        hideModal: function() {
            $("#myModal").modal("hide");
        }
    };
}();