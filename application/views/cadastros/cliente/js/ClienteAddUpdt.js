/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Cliente
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/

  Metrics
    There are 30 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 1.
    Largest function has 10 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 7 while the median is 2.
 */
$(document).ready(function() {
    ClienteAddUpdt.init();
});
var ClienteAddUpdt = function() {
    // variáveis privadas
    //var cUrl = new IPAGE_url_encodeClass();
    var classCep = new ipageCep();
    var ipageMask = new IpageMask();
    // Métodos privados
    /**
     * [handleTab description]
     * @return {[type]} [description]
     */
    var handleTab = function() {
        // Ativo os eventos da aba
        $('form #tabs a').click(function(e) {
            //$('#tabs a[href="#tab_1_2"]').tab('show');
            e.preventDefault();
            $(this).tab('show');
            //var aba = $(this).html().toUpperCase(); POR CAPTION DA ABA
            var aba = $(this).attr('href').toUpperCase(); //POR HREF DA ABA
            if (aba === '#TAB_1_1') {
                $('#cliente_fone1').focus();
            } else if (aba === '#TAB_1_2') {
                $('#cliente_cpf').focus();
            } else if (aba === '#TAB_1_3') {
                $('#cliente_razao_social').focus();
            } else {
                $('#cliente_obs').focus();
            }
        });
    };
    /**
     * [handleMask description]
     * @return {[type]} [description]
     */
    var handleMask = function() {
        ipageMask.input_lostfocus();
        ipageMask.input_keyup();
        ipageMask.input_focus();
    };
    /**
     * [handleEvents description]
     * @return {[type]} [description]
     */
    var handleEvents = function() {
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
                    $('#btn_submit').trigger('click');
                } else if (nextInput) {
                    // Passa o foco para próxima entrada se a entrada não for nula
                    nextInput.focus();
                }
            }
        });
        $("#btn_cep").click(function(e) {
            e.preventDefault();
            var cep = $('.cep-numero').val();
            IpageApp.wait(true);
            classCep.getCep(cep, function(r) {
                IpageApp.wait(false);
                if (r.error == "true") {
                    ipageViews.notyMessage(r.msg, 'error', 0, function(result) {
                        $(".ipage-result-cep").each(function(index, item) {
                            $(this).val('').removeClass("ipage-result-cep");
                        });
                        $('.cep-numero').focus().select();
                    });
                } else {
                    $('.cep-endereco').val(r.logradouro2.toUpperCase()).addClass("ipage-result-cep");
                    $('.cep-bairro').val((r.bairro.toUpperCase())).addClass("ipage-result-cep");
                    $('.cep-cidade').val((r.cidade.toUpperCase())).addClass("ipage-result-cep");
                    $('.cep-uf').val(r.uf.toUpperCase()).addClass("ipage-result-cep");
                    $('.cep-complemento').focus().select();
                }
            });
        });
        //
        $("#btn_google_maps").click(function(e) {
            e.preventDefault();
            var cep = $('.cep-numero').val(); //$(".cep-numero")[0];
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
                    });
                }
            });
        });
        //
        $("#btn_ect").click(function(e) {
            e.preventDefault();
            classCep.ShowECT();
        });
    };
    /**
     * [verificaCampos description]
     * @return {[type]} [description]
     */
    function verificaCampos() {
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
                if (id == '#cliente_cpf') {
                    // Se o cpf for inválido, muda a aba 
                    // para pessoa física
                    $('#tabs a[href="#tab_1_2"]').tab('show');
                } else if (id == '#cliente_cnpj') {
                    // Se o cnpj for inválido, muda a aba 
                    // para pessoa jurídica                    
                    $('#tabs a[href="#tab_1_3"]').tab('show');
                }
                $(id).focus().select();
            });
            //          
            return false;
        }
        return true;
    };
    /**
     * [saveReg description]
     * @return {[type]} [description]
     */
    var saveReg = function() {
        jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
            if (r) {
                var url = "application/views/cadastros/cliente/ajax/cliente_addupdt_ajax.php";
                var formData = new FormData($("#form1")[0]);
                var msg;
                var json;
                var id;
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
                            id = 'cliente_nome'; // Primeira caixa de texto
                        }
                        if (msg == "OK") {
                            ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000, function(result) {
                                window.location.href = 'cliente/';
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
    };
    // Métodos públicos
    return {
        init: function() {
            handleTab();
            handleMask();
            handleEvents();
            // Atribui a submissão do form ao javascript
            $("#form1").attr("action", "javascript:ClienteAddUpdt.submitForm();void(0);");
            // Move a página para o topo
            ipageViews.scrollTo(800);
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //
            return saveReg();
        },
    }
}();