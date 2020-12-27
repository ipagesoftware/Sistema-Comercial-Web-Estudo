/*
 ************************************************************
 */
$(document).ready(function() {
    ProcedenciaAddUpdt.init();
});
var ProcedenciaAddUpdt = function() {
    // Variáveis provadas
    var cUrl = new IPAGE_url_encodeClass();
    var classCep = new ipageCep();
    var ipageMask = new IpageMask();
    // Métodos privados
    var handleForm = function(){
        $(function() {
            $('#datetimepicker1').datetimepicker({
                locale: 'pt-br',
                showTodayButton: true,
                showClose: true,
                format: 'DD/MM/YYYY'
            });
        });
    }

    var handleMask = function() {
        ipageMask.input_lostfocus();
        ipageMask.input_keyup();
        ipageMask.input_focus();
    };    

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
    }

    // Métodos públicos
    return {
        init: function(par) {
            IpageApp.wait(true);
            if (typeof(par) === 'undefined') {
                par = {};
            }
            handleEvents();
            handleForm();
            handleMask();
            $("#form1").attr("action", "javascript:ProcedenciaAddUpdt.submitForm();void(0);");
            //
            ipageViews.scrollTo(800);
            //           
            IpageApp.wait(false);
            //      
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //
            return ProcedenciaAddUpdt.saveReg();
        },
        saveReg: function() {
            jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
                if (r) {
                    var formData = new FormData($("#form1")[0]);
                    var url = "application/views/financeiro/procedencia/ajax/procedencia_addupdt_ajax.php";
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
                                id = 'procedencia_empresae'; // Primeira caixa de texto
                            }
                            if (msg == "OK") {
                                ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000, function(result) {
                                    window.location.href = 'procedencia/';
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
    }

    function verificaCampos() {
        var warning = $('form').find('.ipage-warning');
        var error;
        var msg = "";
        var obj;
        //
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
}();