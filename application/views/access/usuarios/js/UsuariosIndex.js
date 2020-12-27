/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Usuarios
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/

  Metrics
    There are 7 functions in this file.
    Function with the largest signature take 1 arguments, while the median is 1.
    Largest function has 5 statements in it, while the median is 1.
    The most complex function has a cyclomatic complexity value of 2 while the median is 1.
 */ 
$(document).ready(function() {
    Usuarios.init();
});
/**
 * [UsuariosIndex description]
 */
var Usuarios = function() {
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
            p += "&tabela=user";
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
    };
}();