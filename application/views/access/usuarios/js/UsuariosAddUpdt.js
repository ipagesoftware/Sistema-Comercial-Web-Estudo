/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Usuários
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 17 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 0.
    Largest function has 11 statements in it, while the median is 3.
    The most complex function has a cyclomatic complexity value of 4 while the median is 1.
*/
$(document).ready(function() {
    UsuariosAddUpdt.init();
});
var UsuariosAddUpdt = function() {
    // Variáveis privadas
    //var cUrl = new IPAGE_url_encodeClass();
    var ipageMask = new IpageMask();
    // Métodos privados
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
    var handleEvents = function() {
        $("#form1").attr("action", "javascript:UsuariosAddUpdt.submitForm();void(0);");
        $("#user_password").keyup(function() {
            ipageViews.forcaSenha($(this).val());
        });
        //// Habilita o uso da tecla enter nas caixas de texto
        //////
        $('input').keypress(function(event) {
            var allInputs = $(':text:visible');
            if (event.keyCode == 13) {
                event.preventDefault();
                // A próxima entrada na minha coleção de todas as entradas
                var nextInput = allInputs.get(allInputs.index(this) + 1);
                //
                //// Verifica se é a última caixa de texto
                ////////
                if ($(this).data('last-input')) {
                    UsuariosAddUpdt.submitForm();
                } else if (nextInput) {
                    // Passa o foco para próxima entrada se a entrada não for nula
                    nextInput.focus();
                }
            }
        });
    };

    function saveReg() {
        jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
            if (r) {
                var url = "application/views/access/usuarios/ajax/usuario_addupdt_ajax.php";
                var formData = new FormData($("#form1")[0]);
                var msg;
                var json;
                var id;
                //
                $.ajax({
                    // Usando metodo Post
                    type: 'POST',
                    dataType: 'text',
                    timeout: 15000,
                    //contentType: 'multipart/form-data; charset=UTF-8',
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    // this.action pega o script para onde vai ser enviado os dados
                    url: url,
                    // os dados que pegamos com a função serialize()
                    data: formData,
                    // Antes de enviar
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
                            id = 'user_login'; // Primeira caixa de texto
                        }
                        if (msg == "OK") {
                            ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000, function(result) {
                                window.location.href = 'usuarios/';
                            });
                        } else {
                            ipageViews.notyMessage(msg, 'error', 0, function(result) {
                                $('#' + id).trigger('focus').select();
                            });
                        }
                    },
                    // Se acontecer algum erro é executada essa função
                    error: function(txt) {
                        console.log(txt);
                        ipageViews.notyMessage('Ocorreu um erro inesperado, tente mais tarde!', 'error', 0);
                    }
                });
                return false;
            }
        });
    }
    // Métodos públicos
    return {
        init: function() {
            IpageApp.wait(true);
            ipageMask.input_lostfocus();
            ipageMask.input_keyup();
            ipageMask.input_focus();
            handleEvents();
            IpageApp.wait(false);
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //
            return saveReg();
        }
    };
}();