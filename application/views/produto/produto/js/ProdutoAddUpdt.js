/**
 * @version    1.0
 * @package    produto
 * @subpackage produto
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 55 functions in this file.
    Function with the largest signature take 3 arguments, while the median is 1.
    Largest function has 30 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 21 while the median is 1.
 * 
*/
$(document).ready(function() {
    ProdutoAddUpdt.init();
});
/**
 * [Produto_AddUpdt description]
 */
var ProdutoAddUpdt = function() {
    // Variéveis privadas
    //var cUrl = new IPAGE_url_encodeClass();
    var ipageMask = new IpageMask();
    // Métodos privados
    var handleButton = function() {
        $("#btn_add_fabricante").click(function(e) {
            e.preventDefault();
            IpageApp.loadPage("myModal", "application/views/produto/fabricante_modal/", "FABRICANTE", '260px', '500px', false, '', function(r) {
                $('#produto_fabricante').focus();
            });
        });
        //
        $("#btn_add_grupo").click(function(e) {
            e.preventDefault();
            IpageApp.loadPage("myModal", "application/views/produto/grupo_modal/", "GRUPO", '260px', '500px', false, function(r) {
                $('#produto_grupo').focus();
            });
        });
        //
        $("#btn_produto_cod_interno").on("click", function(e) {
            e.preventDefault();
            //
            if (parseInt($('#produto_grupo_id').val(), 10) === 0) {
                ipageViews.notyMessage('Grupo inválido ou inexistente, verifique!', 'error', 3000, function(result) {
                    $('#produto_grupo').focus().select();
                });
            } else {
                if ($("#produto_codigo_interno").val().length === 0) {
                    ProdutoAddUpdt.get_codigo_interno();
                } else {
                    ipageViews.notyMessage('Para gerar um novo código, é necessário apagar o atual', 'error', 3000, function(result) {
                        $('#produto_codigo_interno').focus().select();
                    });
                }
            }
        });
        $("#btn_produto_cod_barras").on("click", function(e) {
            e.preventDefault();
            var cod_barras = $("#produto_cod_barras");
            var imagem = "https://www.ipage.com.br/ws/produto/v1/application/views/codebar/images/";
            ProdutoAddUpdt.validarCodigoBarras(cod_barras.val(), function(result) {
                if (result == false) {
                    cod_barras.focus();
                    return;
                }
                //
                $.ajax({
                    type: 'POST',
                    dataType: 'text',
                    timeout: 15000,
                    //contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                    url: "application/views/produto/produto/ajax/cod_barras_ajax.php",
                    data: 'cod_barras=' + $(cod_barras).val(),
                    beforeSend: function() {
                        IpageApp.wait(true);
                    },
                    success: function(txt) {
                        try {
                            ret = JSON.parse(txt);
                            //
                            if (ret.error == true) {
                                ipageViews.notyMessage(ret.msg, "error", 3000, function(result) {
                                    $("#produto_cod_barras").focus();
                                });
                                return;
                            }
                            //
                            if(ipageViews.left(ret.imagem, 6)=="https:"){
                                imagem = ret.imagem;
                            }else{
                                imagem += ret.imagem;
                            }
                            $(".foto-produto").attr("src", imagem);
                            $("#produto_foto").val(imagem);
                            $("#produto_descricao").val(ret.nome).addClass("ipage-result-cep");
                            $("#produto_fabricante").val(ret.fabricante).addClass("ipage-result-cep");
                            $("#produto_um").focus();
                        } catch (e) {
                            ipageViews.notyMessage(e, "error", 3000, function(result) {
                                $("#produto_cod_barras").focus();
                            });
                        }
                        return false;
                    },
                    error: function(xhr, er) {
                        ret = "Error " + xhr.status + " - " + xhr.statustext + "\nTipo de erro: " + er;
                        ipageViews.notyMessage(ret, "error", 3000, function(result) {
                            $("#produto_cod_barras").focus();
                        });
                        return false;
                    }
                });
            });
        });
    };
    var handleMask = function() {
        ipageMask.handleCurrency();
        ipageMask.input_lostfocus();
        ipageMask.input_keyup();
        ipageMask.input_focus();
    };

    var handleEvents = function() {
        lostFocus();
        keyPress();

        function keyPress() {
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
        }

        function lostFocus() {
            var id;
            var ret;
            var tmp;
            var l;
            var produto_val_custo;
            var produto_margem_lucro;
            var valor;
            // Aplica a formatação das máscaras as caixas de texto
            $("form input[type=text]").each(function(index) {
                $(this).bind("blur", function(e) {
                    e.preventDefault();
                    id = $(this).attr('id');
                    //
                    if (id === 'produto_um_quant' || id === 'produto_emb_com' || id === 'produto_val_custo' || id === 'produto_margem_lucro' || id === 'produto_val_revenda' || id === 'produto_estoque_minimo' || id === 'produto_maximo') {
                        ret = setCurrency($(this).val());
                        if ($.isNumeric(ret) === false || ret === '0.00' || ret.length === 0 || ret === '0') {
                            $(this).val('0');
                        }
                        //
                        valor = setCurrency($(this).val());
                        $(this).val(parseFloat(valor).toFixed(2).replace(",", "."));
                        //
                        produto_val_custo = setCurrency($('#produto_val_custo').val());
                        produto_margem_lucro = setCurrency($('#produto_margem_lucro').val());
                        valor = parseFloat(produto_val_custo) + (parseFloat(produto_val_custo) * parseFloat(produto_margem_lucro) / 100);
                        tmp = accounting.formatNumber(valor);
                        $('#produto_val_revenda').val(setCurrency(tmp));
                        //
                    } else if (id === 'produto_um') {
                        if ($(this).val().length === 0) {
                            $(this).val('UN');
                        }
                    } else if (id === 'produto_cod_barras') {
                        l = $(this).val().length;
                        //
                        if (l < 13) {
                            tmp = '0000000000000' + $(this).val();
                            l = tmp.lenght;
                            $(this).val(ipageViews.right(tmp, 13));
                        }
                    } else if (id === 'produto_uso_interno') {
                        l = $(this).val().length;
                        //
                        if (l === 0) {
                            $(this).val('N');
                        }
                    } else if (id === 'produto_fabricante') {
                        l = $(this).val().length;
                        if (l === 0) {
                            $(this).val('INDEFINIDO');
                        }
                    }
                    //
                    ipageViews.clearAspasSimples(this);
                    $(this).val(ipageViews.removeAcento($(this).val().toUpperCase()));
                    //
                    if (parseInt($('#produto_grupo').val().length, 10) === 0) {
                        $('#produto_grupo_id').val('0');
                    }
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
    };
    var handleAutoComplete = function() {
        var link = "application/views/autocomplete/";
        $("#produto_um").autocomplete(link + "um/", {
            minChars: 0,
            selectFirst: false,
            max: 10,
            width: $("#produto_um").css('width')
        }).result(function(event, data, formatted) {
            $("#produto_um_quant").focus();
        });
        //      
        $("#produto_fabricante").autocomplete(link + "fabricante/", {
            selectFirst: false,
            minChars: 0,
            max: 10,
            width: $("#produto_fabricante").css('width')
        }).result(function(event, data, formatted) {
            $("#produto_grupo").focus();
        });
        //
        $("#produto_grupo").autocomplete(link + "grupo/", {
            selectFirst: false,
            minChars: 0,
            max: 10,
            width: $("#produto_grupo").css('width')
        }).result(function(event, data, formatted) {
            if (data) {
                $('#produto_grupo_id').val(data[1]);
            }
            //
            var l;
            l = $('#produto_codigo_interno').val().length;
            if (parseInt(l, 10) !== 0) {
                ProdutoAddUpdt.get_codigo_interno();
            }
            $("#produto_codigo_interno").focus();
        });
    };
    var handleForm = function() {
        $("#form1").attr("action", "javascript:ProdutoAddUpdt.submitForm();void(0);");
        ipageViews.scrollTo(800);
        //           
        IpageApp.wait(false);
    };

    /**
     * [verificaCampos description]
     * @return {[type]} [description]
     */
    function verificaCampos() {
        var produto_descricao = $('#produto_descricao').val(), //NÃO PODE CONTER NÚMERO
            produto_um = $('#produto_um').val(),
            //produto_um_quant       = $('#produto_um_quant').val(),//APENAS NÚMERO
            //produto_emb_com        = $('#produto_emb_com').val(),
            produto_grupo = $('#produto_grupo').val(),
            produto_grupo_id = $('#produto_grupo_id').val(),
            produto_codigo_interno = $('#produto_codigo_interno').val();
        //
        if (produto_descricao.length <= 0) {
            ipageViews.notyMessage('Descrição inválida ou inexistente, digite apenas letras!', 'error', 3000, function(result) {
                $('#produto_descricao').focus().select();
            });
            return false;
        }
        //
        if (produto_um.length <= 0) {
            ipageViews.notyMessage('Campo inválido ou inexistente, verifique!', 'error', 3000, function(result) {
                $('#produto_um').focus().select();
            });
            return false;
        }
        //
        if (produto_grupo.length <= 0) {
            ipageViews.notyMessage('Grupo inválido ou inexistente, verifique!', 'error', 3000, function(result) {
                $('#produto_grupo').focus().select();
            });
            return false;
        }
        //
        if (parseInt(produto_grupo_id, 10) === 0) {
            ipageViews.notyMessage('Você selecionou um grupo que não está cadastrado em nossa base de dados, verifique!', 'error', 3000, function(result) {
                $('#produto_grupo').focus().select();
            });
            return false;
        }
        //
        if (produto_codigo_interno.length <= 0) {
            ipageViews.notyMessage('Código interno inválido ou inexistente. Digite apenas letras!', 'error', 3000, function(result) {
                $('#produto_codigo_interno').focus().select();
            });
            return false;
        }
        //
        return true;
    }
    // Métodos públicos
    return {
        init: function(par) {
            handleButton();
            handleEvents();
            handleAutoComplete();
            handleForm();            
            handleMask();
        },
        validarCodigoBarras: function(codbar, callback) {
            //
            if (codbar.length < 13) {
                ipageViews.notyMessage("Código de barras inválido ou inexistente, verifique!", "error", 3000, function(result) {
                    return callback ? callback(false) : null;
                });
            } else {
                return callback ? callback(codbar) : null;
            }
        },
        get_codigo_interno: function() {
            var l;
            l = $('#produto_grupo_id').val();
            if (parseInt(l, 10) === 0) {
                return;
            }
            //PEGO O VALOR DO CÓDIGO INTERNO BASEADO NO CÓDIGO DO PRODUTO
            $.ajax({
                type: 'POST',
                dataType: 'text',
                timeout: 15000,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                url: "application/views/autocomplete/codigo_interno/",
                data: 'term=' + $('#produto_grupo_id').val(),
                beforeSend: function() {
                    $('#produto_codigo_interno').val('');
                    IpageApp.wait(true);
                },
                success: function(txt, textStatus) {
                    /*
                    VERIFICA SE O VALOR RETORNADO PELO SERVIDOR
                    */
                    if (parseInt(txt, 10) === 0) {
                        $('#produto_codigo_interno').val($('#produto_grupo_id').val() + '.1');
                    } else {
                        $('#produto_codigo_interno').val($('#produto_grupo_id').val() + '.' + (parseInt(txt, 10) + 1));
                    }
                    $('#produto_codigo_interno').focus().select();
                },
                error: function(xhr, er) {
                    IpageApp.wait(false);
                    var ret = 'Error ' + xhr.status + ' - ' + xhr.statustext + '\nTipo de erro: ' + er;
                    ipageViews.notyMessage(ret, 'error', 0);
                }
            });
            return false;
        },
        saveReg: function() {
            jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
                if (r) {
                    var formData = new FormData($("#form1")[0]);
                    var url = "application/views/produto/produto/ajax/produto_ajax.php";
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
                                id = 'produto_descricao'; // Primeira caixa de texto
                            }
                            if (msg == "OK") {
                                ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000, function(result) {
                                    window.location.href = 'produto/';
                                });
                            } else {
                                ipageViews.notyMessage(msg, 'error', 3000, function(result) {
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
        },
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            //
            return ProdutoAddUpdt.saveReg();
        },
    };
}();