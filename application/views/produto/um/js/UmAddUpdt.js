/**
 * @version    1.0
 * @package    Produto
 * @subpackage Cadastro
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 15 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 1.
    Largest function has 11 statements in it, while the median is 3.
    The most complex function has a cyclomatic complexity value of 3 while the median is 1.
 * 
*/
$(document).ready(function() {
    UmAddUpdt.init();
});
var UmAddUpdt = function() {
    // Vari�veis privadas
    //var cUrl = new IPAGE_url_encodeClass();
    var ipageMask = new IpageMask();
    // M�todos privados
    var verificaCampos = function() {
        var warning = $('form').find('.ipage-warning');
        var error;
        var msg = "";
        var obj;
        ipageViews.scrollTo(800);
        if (typeof(warning[0]) !== 'undefined') {
            warning.each(function(index, item) {
                if (parseInt($(item).val().length, 10) != 0) {
                    error = $(item).data('error');
                    msg += (index + 1) + ' - ';
                    msg += error + "<br>";
                    if (typeof(obj) == 'undefined') {
                        id = '#' + $(item).attr('id');
                        obj = item;
                    }
                } else {
                    $(item).removeClass('ipage-warning');
                }
            });
            //
            if (msg.length == 0) return true;
            ipageViews.notyMessage(msg, 'error', 0, function(result) {
                $(id).focus().select();
            });
            //          
            return false;
        }
        return true;
    };   
    var handleMask = function() {
        ipageMask.input_lostfocus();
        ipageMask.input_keyup();
        ipageMask.input_focus();
    };  
    // M�todos p�blicos
    return {
        init: function(par) {
            $("#form1").attr("action", "javascript:UmAddUpdt.submitForm();void(0);");
            //
            handleMask();
            IpageApp.wait(false);
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //
            return UmAddUpdt.saveReg();
        },
        saveReg: function() {
            jQuestion('Confirma os dados digitados?', 'Aten��o', function(r) {
                if (r) {
                    var formData = new FormData($("#form1")[0]);
                    var url = "application/views/produto/um/ajax/um_addupdt_ajax.php";
                    //
                    $.ajax({
                        type: 'POST',
                        dataType: 'text',
                        timeout: 15000,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formData,
                        beforeSend: function() {
                            IpageApp.wait(true);
                        },
                        success: function(txt, textStatus) {
                            IpageApp.wait(false);
                            try {
                                json = JSON.parse(txt);
                                msg = json.msg;
                                id = json.id;
                            } catch (e) {
                                msg = txt;
                                id = 'um_sigla'; // Primeira caixa de texto
                            }
                            if (msg == "OK") {
                                ipageViews.notyMessage('Opera��o realizada com sucesso!', 'success', 1000, function(result) {
                                    window.location.href = 'um/';
                                });
                            } else {
                                ipageViews.notyMessage(msg, 'error', 0, function(result) {
                                    $('#' + id).trigger('focus').select();
                                });
                            }
                        },
                        error: function(xhr, er) {
                            IpageApp.wait(false);
                            var ret = 'Error ' + xhr.status + ' - ' + xhr.statustext + '\nTipo de erro: ' + er;
                            ipageViews.notyMessage(ret, 'error', 0);
                        }
                    });
                    return false;
                }
            });
        }
    };
}();