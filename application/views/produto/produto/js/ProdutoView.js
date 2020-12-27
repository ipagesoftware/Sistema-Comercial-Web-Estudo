/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Produto
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
    ProdutoView.init();
});
var ProdutoView = function() {
    // Variáveis privadas
    // Métodos privados
    var handlerEvents = function() {
        ipageViews.scrollTo(800);
        $("#btn_cancel").click(function() {
            var modal = window.parent;
            modal.Produto.hideModal();
        });
    };
    // Métodos públicos    
    return {
        init: function() {
            handlerEvents();
        }
    };
}();