/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Procedência x usuário
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 3 functions in this file.
    Function with the largest signature take 1 arguments, while the median is 0.
    Largest function has 4 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 2 while the median is 1.
 * 
*/
$(document).ready(function() {
    ProcedenciaUsuario.init();
});

var ProcedenciaUsuario = function() {
    return{
        init: function(par) {
            IpageApp.wait(false);
        }
    }    
}();