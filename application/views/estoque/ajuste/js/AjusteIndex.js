/**
 * @version    1.0
 * @package    Estoque
 * @subpackage Ajuste
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
  There are 26 functions in this file.
  Function with the largest signature take 2 arguments, while the median is 1.
  Largest function has 14 statements in it, while the median is 2.
  The most complex function has a cyclomatic complexity value of 6 while the median is 2.
 * 
*/
$(document).ready(function() {
    Ajuste.init();
});
var Ajuste = function() {
    // Variáveis privadas
    var cUrl = new IPAGE_url_encodeClass();
    //var ipageMask = new IpageMask();
    // Métodos privados
        function input_lostfocus() {
        var id, ret;
        $("#form1 input[type=text]").each(function(index) {
            $(this).bind("blur", function(e) {
                e.preventDefault();
                id = $(this).attr('id');
                //
                if (id === 'quantidade') {
                    ret = setCurrency($(this).val());
                    if ($.isNumeric(ret) === false || ret === '0.00' || ret.length === 0 || ret === '0') {
                        $(this).val('0');
                    }
                } else {
                    ipageViews.clearAspasSimples(this);
                    $(this).val(ipageViews.removeAcento($(this).val().toUpperCase()));
                }
                //
            });
        });
    }

    function setCurrency(_value) {
        var ret = ipageViews.replaceAll(_value, ',', '');
        if ($.isNumeric(ret) === false) {
            return '0';
        }
        return parseFloat(ret).toFixed(2).replace(",", ".");
    }

    function mnu_click(_value) {
        if (typeof(_value) === "undefined") {
            _value = "mnu";
        }
        $('#' + _value + '_fechar').click(function(e) {
            e.preventDefault();
            window.parent.$("#myModal").modal('hide');
        });
    }

    function verificaCampos() {
        ipageViews.scrollTo(800);
        var quantidade = parseFloat($('#quantidade').val()),
            produto_id = $('#produto_id').val();
        //    
        if (quantidade <= 0) {
            jCritical('Quantidade inválida, verifique!', 'Atenção', function(r) {
                if (r) {
                    $('#quantidade').focus().select();
                }
            });
            //
            return false;
        }
        if (parseInt(produto_id, 10) <= 0) {
            jCritical('Código do produto inválido, verifique!', 'Atenção', function(r) {
                if (r) {
                    window.parent.$("#myModal").modal('hide');
                }
            });
            //
            return false;
        }
        return true;
    }

    function addUpdt() {
        jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
            if (r) {
                /*
                DECLARAÇÃO VARIÁVEIS
                */
                var serializeDados,
                    url,
                    idx = $('#cbo_operacao').get(0).selectedIndex,
                    tipo_op = $('#cbo_operacao').get(0).options[idx].value;
                //                
                serializeDados = 'quantidade=' + setCurrency($('#quantidade').val());
                serializeDados += '&#contas_pagar=' + tipo_op;
                serializeDados += '&#produto_id=' + $('#produto_id').val();
                //          
                url = 'parameter1=' + cUrl.encodeHex($.base64.encode(serializeDados));
                //
                serializeDados = url;
                //console.log(serializeDados);
                //
                $.ajax({
                    // Usando metodo Post
                    type: 'POST',
                    dataType: 'text',
                    timeout: 15000,
                    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    // this.action pega o script para onde vai ser enviado os dados
                    url: "application/views/estoque/ajuste/ajax/ajuste_ajax.php",
                    // os dados que pegamos com a função serialize()
                    data: serializeDados,
                    // Antes de enviar
                    beforeSend: function() {
                        IpageApp.wait(true);
                    },
                    success: function(txt, textStatus) {
                        IpageApp.wait(false);
                        /*
                        VERIFICA SE O VALOR RETORNADO PELO SERVIDOR
                        */
                        switch (txt) {
                            case 'OK_INSERT':
                                jQuestion("Operação realizada com sucesso!<br />Deseja incluir mais algum registro?", 'Atenção', function(r) {
                                    if (r) {
                                        if (typeof $.QueryString.newreg === 'undefined') {
                                            url = window.location.href + '&newreg=1';
                                            window.location.href = url;
                                        } else {
                                            window.location.reload();
                                        }
                                    } else {
                                        window.parent.$("#myModal").modal('hide');
                                    }
                                });
                                break;
                            default:
                                jCritical("Ocorreu um erro " + txt + ", <br/>Entre em contato com o suporte técnico para maiores informações.", 'Atenção');
                                break;
                        }
                    },
                    // Se acontecer algum erro é executada essa função
                    error: function(txt) {
                        jCritical('Ocorreu um erro inesperado, tente mais tarde!', 'Erro');
                    }
                });
                return false;
            }
        });
    }// 
    // Métodos públicos
    return {
        init: function(par) {
            IpageApp.wait(true);
            if (typeof(par) === 'undefined') {
                par = {};
            }
            mnu_click("btn");
            mnu_click("mnu");
            $("#form1").attr("action", "javascript:Ajuste.submitForm();void(0);");
            //
            accounting.settings = {
                currency: {
                    symbol: "$",
                    format: "%s%v",
                    decimal: ".",
                    thousand: ",",
                    precision: 2
                },
                number: {
                    precision: 2,
                    thousand: ",",
                    decimal: "."
                }
            };
            //
            $("#quantidade").maskMoney();
            //
            if ($.QueryString.newreg) {
                $('#tabs a[href="#tab_1_2"]').tab('show');
            }
            //
            /*
             * ATIVO OS EVENTOS DA ABA
             */
            $('form #tabs a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
                //var aba = $(this).html().toUpperCase(); POR CAPTION DA ABA
                var aba = $(this).attr('href').toUpperCase(); //POR HREF DA ABA
                if (aba === '#TAB_1_2') {
                    $('#quantidade').focus();
                }
            });
            //
            $('#cbo_operacao').change(function() {
                $('#quantidade').focus();
            });
            input_lostfocus();
            IpageApp.wait(false);
        },
        showObs: function(str) {
            var ret = cUrl.decodeHex(str);
            $('#txt_obs').val($.base64.decode(ret));
            $('#myModal').modal({
                keyboard: true
            });
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //      
            return addUpdt();
        },
    };
}();
//
(function($) {
    $.QueryString = (function(a) {
        if (a == "") return {};
        var b = {};
        for (var i = 0; i < a.length; ++i) {
            var p = a[i].split('=');
            if (p.length != 2) continue;
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'));
})(jQuery);