/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Procedencia
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/

  Metrics
    There are 8 functions in this file.
    Function with the largest signature take 1 arguments, while the median is 0.
    Largest function has 6 statements in it, while the median is 1.5.
    The most complex function has a cyclomatic complexity value of 3 while the median is 1.
 */
$(document).ready(function() {
    ProcedenciaView.init();
});
var ProcedenciaView = function() {
    // Variáveis privadas
    var classCep = new ipageCep();
    // Métodos privados
    var handlerEvents = function() {
        ipageViews.scrollTo(800);
        $("#btn_google_maps").click(function(e) {
            e.preventDefault();
            var cep = $('.cep-numero').val();
            var endereco = $(".cep-endereco").val();
            var bairro = $(".cep-barro").val();
            var cidade = $(".cep-cidade").val();
            var uf = $(".cep-uf").val();
            //
            classCep.ShowGoogleMaps(cep, endereco, bairro, cidade, uf, function(r) {
                if (r.error == "true") {
                    ipageViews.notyMessage(r.msg, 'error', 0, function(result) {
                        $(".ipage-result-cep").each(function(index, item) {
                            $('.cep-numero').focus().select();
                        });
                        $('.cep-numero').focus().select();
                    });
                }
            });
        });
        $("#btn_cancel").click(function() {
            var modal = window.parent;
            modal.Procedencia.hideModal();
        });
    };
    // Métodos públicos    
    return {
        init: function() {
            handlerEvents();
        }
    };
}();