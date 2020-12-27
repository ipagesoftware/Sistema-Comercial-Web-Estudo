/**
 * @version    1.0
 * @package    Usuário
 * @subpackage Permissões
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 42 functions in this file.
    Function with the largest signature take 6 arguments, while the median is 1.
    Largest function has 21 statements in it, while the median is 3.
    The most complex function has a cyclomatic complexity value of 9 while the median is 1.
 * 
*/
$(document).ready(function() {
    Permissoes.init({});
});
/*
 ************************************************************
 */
var Permissoes = function() {
    // Variáveis privadas a classe
    var cUrl = new IPAGE_url_encodeClass();
    var nivel_usuario = [];
    // Métodos privados
    function setDefault() {
        var tmp = 'Deseja restaurar os valores padrões das permissões<br/>';
        tmp += 'do usuário baseadas no nível do usuário?';
        jQuestion(tmp, 'Atenção', function(r) {
            if (r) {
                tmp = 'Dependendo do tamanho do seu banco de dados, da velocidade da sua internet e das configurações ';
                tmp += 'do seu hardware, esta operação poderá levar alguns minutos.<br/><br/>';
                tmp += 'Deseja continuar mesmo assim?';
                jQuestion(tmp, 'Atenção', function(r) {
                    if (r) {
                        private_setDefault();
                        return false;
                    }
                });
            }
        });
    }

    function private_setDefault() {
        var idx = $('#cbo_usuario').get(0).selectedIndex;
        var user_id = $('#cbo_usuario').get(0).options[idx].value;
        var formData = new FormData($("#form1")[0]);
        var url = "application/views/access/permissoes/ajax/permissoes.setdefault.ajax.php";
        //
        if (idx < 0) {
            ipageViews.notyMessage("Selecione o usuário!", 'error', 0);
            return false;
        }
        //
        $.ajax({
            type: 'POST',
            dataType: 'text',
            timeout: 15000,
            contentType: 'multipart/form-data; charset=UTF-8',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            url: url,
            data: formData,                
            beforeSend: function() {
                IpageApp.wait(true);
            },
            success: function(txt) {
               IpageApp.wait(false);
                try {
                    json = JSON.parse(txt);
                    msg = json.msg;
                    id = json.id;
                } catch (e) {
                    msg = txt;
                    id = 'cbo_usuario'; // Primeira caixa de texto
                }
                if (msg == "OK") {
                    ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000);
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

    function loadTableInComboBox(page, criterio, cbo, initialcaption, valueid, showretorno) {
        setValueButtonToolbar();
        $("select#" + cbo).empty();
        //
        var options = '';
        var obj;
        //
        $("select#" + cbo).html('');
        $.ajax({
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            url: page,
            data: geraUrl(criterio),
            dataType: 'text',
            timeout: 15000,
            beforeSend: function() {
                IpageApp.wait(true);
            },
            success: function(data, textStatus) {
                try {
                    obj = $.parseJSON(data);
                } catch (err) {
                    ipageViews.notyMessage(data, 'error', 0);
                    return false;
                }
                if (obj[0].retorno) {
                    options += '<option value="' + 0 + '" selected="selected">' + initialcaption + '</option>';
                    $("select#" + cbo).html(options);
                    if (showretorno === true) {
                        ipageViews.notyMessage(obj[0].retorno, 'error', 0);
                    }
                } else {
                    var j = obj.length;
                    if (parseInt(initialcaption.length, 10) !== 0) {
                        options += '<option value="" selected="selected">' + initialcaption + '</option>';
                    }
                    for (var i = 0; i < j; i++) {
                        options += '<option value="' + obj[i].descricao + '">' + obj[i].descricao + '</option>';
                    }
                    $("select#" + cbo).html(options);
                    setValueButtonToolbar();
                    $("#btn_padrao").removeClass("disabled");
                    getTotalReg();
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

    function getTotalReg() {
        var rows = $('#list_tabela').get(0).options.length;
        $('#tot_reg').html("Total de Tegistro(s): " + rows);
    }

    function geraUrl(criterio) {
        var url = cUrl.urlGenerator() + '&';
        url += 'parameter6=' + cUrl.encodeHex($.base64.encode(criterio));
        //          
        return url;
    }

    function loadCombo(page, criterio, cbo, initialcaption, valueid, showretorno) {
        var options = '';
        var obj;
        $("select#" + cbo).html('');
        $.ajax({
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            url: page,
            data: criterio,
            dataType: 'text',
            timeout: 15000,
            beforeSend: function() {
                IpageApp.wait(true);
            },
            success: function(data, textStatus) {
                try {
                    //var obj = eval(data);
                    obj = $.parseJSON(data);
                } catch (err) {
                    ipageViews.notyMessage(data, 'error', 0);
                    return false;
                }
                if (obj[0].retorno) {
                    options += '<option value="' + 0 + '" selected="selected">' + initialcaption + '</option>';
                    $("select#" + cbo).html(options);
                    if (showretorno === true) {
                        ipageViews.notyMessage(obj[0].retorno, 'error', 0);
                    }
                } else {
                    var j = obj.length;
                    var n = '';
                    if (parseInt(initialcaption.length, 10) !== 0) {
                        options += '<option value="' + 0 + '" selected="selected">' + initialcaption + '</option>';
                        nivel_usuario[0] = '';
                    }
                    for (var i = 0; i < j; i++) {
                        options += '<option value="' + obj[i][2].id + '">' + obj[i][0].descricao + '</option>';
                        switch (obj[i][1].nivel) {
                            case 'A':
                                n = 'ADMINISTRADOR';
                                break;
                            case 'C':
                                n = 'COMUM';
                                break;
                            case 'O':
                                n = 'OPERACIONAL';
                                break;
                            default:
                                n = '';
                                break;
                        }
                        nivel_usuario[obj[i][2].id] = n;
                    }
                    $("select#" + cbo).html(options);
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

    function setCheckBox(criterio) {
        $.ajax({
            type: 'POST',
            dataType: 'text',
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            url: "application/views/access/permissoes/ajax/permissoes.ajax.php",
            data: criterio,
            beforeSend: function() {
                IpageApp.wait(true);
            },
            success: function(data, textStatus) {
                try {
                    obj = $.parseJSON(data);
                } catch (err) {
                    ipageViews.notyMessage(data, 'error', 0);
                    return false;
                }

                if (obj[0].retorno) {
                    ipageViews.notyMessage(obj[0].retorno, 'error', 0);
                } else {
                    if (parseInt(obj[0].inserir, 10) === 0) {
                        $("#chk_inserir").prop("checked", false);
                    } else {
                        $("#chk_inserir").prop("checked", true);
                    }
                    if (parseInt(obj[1].editar, 10) === 0) {
                        $("#chk_editar").prop("checked", false);
                    } else {
                        $("#chk_editar").prop("checked", true);
                    }
                    if (parseInt(obj[2].excluir, 10) === 0) {
                        $("#chk_excluir").prop("checked", false);
                    } else {
                        $("#chk_excluir").prop("checked", true);
                    }
                    if (parseInt(obj[3].imprimir, 10) === 0) {
                        $("#chk_imprimir").prop("checked", false);
                    } else {
                        $("#chk_imprimir").prop("checked", true);
                    }
                    if (parseInt(obj[4].negar, 10) === 0) {
                        $("#chk_negar").prop("checked", false);
                    } else {
                        $("#chk_negar").prop("checked", true);
                    }
                    IpageApp.wait(false);
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

    function setValueButtonToolbar(value) {
        if (typeof(value) === 'undefined') {
            value = false;
        }
        //            
        if (value) {
            $('#btn_padrao').removeClass("disabled");
            $('#btn_salvar').removeClass("disabled");
        } else {
            $('#btn_padrao').addClass("disabled");
            $('#btn_salvar').addClass("disabled");
        }
    }
    // Métodos públicos
    return {
        init: function() {
            IpageApp.wait(true);
            /*
             ************************************************************
             */
            $("#form1").attr("action", "javascript:Permissoes.saveReg();void(0);");
            //
            loadCombo('application/views/access/permissoes/ajax/permissoes.usuario.ajax.php', 'criterio=%', 'cbo_usuario', '** NENHUM **');
            IpageApp.wait(false);
            /*
             ************************************************************
             */
            $('#cbo_usuario').change(function() {
                IpageApp.wait(false);
                $('.marcar').each(function(index) {
                    $(this).prop("checked", false);
                });
                var i = $(this).get(0).value;
                $('#nivel_usuario').html("Nível Usuário: <b>" + nivel_usuario[i] + "</b>");
                switch (i) {
                    case '0':
                        setValueButtonToolbar();
                        $('#list_tabela').empty();
                        getTotalReg();
                        break;
                    default:
                        loadTableInComboBox('application/views/access/permissoes/ajax/permissoes.tables.ajax.php', '%', $('#list_tabela').get(0).id, '** NENHUM **');
                        $('#btn_padrao').removeClass("disabled");
                        break;
                }
            });
            /*
             ************************************************************
             */
            $('#list_tabela').change(function() {
                $('.marcar').each(function(index) {
                    $(this).prop("checked", false);
                });
                var i = $('#cbo_usuario').get(0).selectedIndex,
                    y = $(this).get(0).selectedIndex;
                //
                setValueButtonToolbar();
                $("#btn_padrao").removeClass("disabled");
                //
                if (y <= 0) {
                    return;
                }
                var tmp,
                    tabela;
                if (i > 0) {
                    setValueButtonToolbar(true);
                    var user_id = $('#cbo_usuario').get(0).options[i].value;
                    tabela = $(this).get(0).options[y].value;
                    tmp = 'user_id=' + user_id;
                    tmp += '&tabela=' + tabela;
                    setCheckBox(tmp);
                }
            });
            /*
             ************************************************************
             */
            $("#todos").click(function() {
                var i = $('#cbo_usuario').get(0).selectedIndex && $('#list_tabela').get(0).selectedIndex;
                if (i <= 0) {
                    $('.marcar').each(function(index) {
                        $(this).prop("checked", false);
                    });
                    $(this).prop("checked", false);
                    return;
                }
                Permissoes.marcardesmarcar(this);
            });
            /*
             ************************************************************
             */
            $('#btn_padrao').click(function() {
                setDefault();
            });
        },
        marcardesmarcar: function(obj) {
            var ret = $('input[name=todos]:checked', '#form1').val();
            //
            if (typeof(ret) !== 'undefined') {
                $('.marcar').each(function(index) {
                    $(this).prop("checked", true);
                });
            } else {
                $('.marcar').each(function(index) {
                    $(this).prop("checked", false);
                });
            }
        },
        saveReg: function() {
            var url = "application/views/access/permissoes/ajax/permissoes.dao.ajax.php";
            var formData = new FormData($("#form1")[0]);
            var msg;
            var json;
            var id;
            var idx = $('#cbo_usuario').get(0).selectedIndex;
            //
            if (idx < 0) {
                ipageViews.notyMessage("Selecione o usuário!", 'error', 0);
                return;
            }
            //
            jQuestion("Confirma os dados modificados?", 'Atenção', function(r) {
                if (r) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'text',
                        timeout: 15000,
                        //contentType: 'multipart/form-data; charset=UTF-8',
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        url: url,
                        data: formData,                
                        beforeSend: function() {
                            IpageApp.wait(true);
                        },
                        success: function(txt) {
                            IpageApp.wait(false);
                               IpageApp.wait(false);
                                try {
                                    json = JSON.parse(txt);
                                    msg = json.msg;
                                    id = json.id;
                                } catch (e) {
                                    msg = txt;
                                    id = 'cbo_usuario'; // Primeira caixa de texto
                                }
                                if (msg == "OK") {
                                    ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000);
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
                    
                }
            });
        }
    };
}();