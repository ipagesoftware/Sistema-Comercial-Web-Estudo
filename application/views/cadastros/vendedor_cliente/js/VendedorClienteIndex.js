/**
 * @version    1.0
 * @package    Cadastros
 * @subpackage Vendedor x Cliente
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 27 functions in this file.
    Function with the largest signature take 5 arguments, while the median is 1.
    Largest function has 26 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 7 while the median is 1.
*/
$(document).ready(function() {
    VendedorCliente.init();
});

var VendedorCliente = function() {
    // variáveis privadas
    var select_Class = new selectClass();
    // Métodos privados
    function clearTxt() {
        $("#list1").html('');
        $("#list2").html('');
        setTotalReg();
    }

    function setTotalReg() {
        var t1 = select_Class.selectCount("list1"),
            t2 = select_Class.selectCount("list2");
        //    
        $("#tot_reg1").html('Total de registro(s): ' + t1);
        $("#tot_reg2").html('Total de registro(s): ' + t2);
    }

    function loadItensIntoCombo(page, criterio, cbo, initialcaption, showretorno) {
        var options = '';
        var t1;
        var t2;
        clearTxt();
        setTotalReg();
        $("#" + cbo).html(''); //LIMPO TODOS OS OBJETO SELECT
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
                var obj;
                try {
                    //var obj = eval(data)          
                    obj = $.parseJSON(data);
                } catch (err) {
                    IpageApp.wait(false);
                    ipageViews.notyMessage(data, 'error', 0, function(result) {
                        window.location.reload();
                    });
                    return false;
                }
                if (obj[0].retorno) {
                    if (initialcaption.length !== 0) {
                        options += '<option value="' + 0 + '" selected="selected">' + initialcaption + '</option>';
                        $("select#" + cbo).html(options);
                    }
                    IpageApp.wait(false);
                    if (showretorno === true) {
                        ipageViews.notyMessage(obj[0].retorno, 'error', 0);
                    }
                } else {
                    var j = obj.length;
                    if (initialcaption.length !== 0) {
                        options += '<option value="' + 0 + '" selected="selected">' + initialcaption + '</option>';
                    }
                    for (var i = 0; i < j; i++) {
                        options += '<option value="' + obj[i][1].id + '">' + obj[i][0].descricao + '</option>';
                    }
                    $("select#" + cbo).html(options);
                    /*
                     * REMOVE OS DADOS DA LIST1 CONTIDOS NA LIST2
                     */
                    select_Class.notEqual('list1', 'list2');
                    t1 = select_Class.selectCount('list1');
                    t2 = select_Class.selectCount('list2');
                    //
                    setTotalReg();
                    statusBtn();
                    IpageApp.wait(false);
                }
                return false;
            },
            error: function(xhr, er) {
                IpageApp.wait(false);
                var ret = 'Error ' + xhr.status + ' - ' + xhr.statustext + '\nTipo de erro: ' + er;
                ipageViews.notyMessage(ret, 'error', 0);
            }
        });
        return false;
    }

    function incluirOptions(obj1, obj2, callback) {
        var ret = select_Class.moveOptions(obj1, obj2);
        if(ret!=0){
            setTotalReg();
            statusBtn();
        }        
        return callback ? callback(ret) : null;
    }

    /* 
    function incluirTodosOptions(obj1, obj2){
      select_Class.selectAllOptions(obj1);
      select_Class.moveOptions(obj1, obj2);
      setTotalReg();
      statusBtn();
    }
    */

    function retirarOptions(obj1, obj2, callback) {
        var ret = select_Class.moveOptions(obj1, obj2);
        if(ret!=0){
            setTotalReg();
            statusBtn();
        }
        return callback ? callback(ret) : null;
    }

    function statusBtn() {
        var t2 = select_Class.selectCount('list2');
        //
        if (t2 === 0) {
            $("#btn_salvar").addClass("disabled");
        } else {
            $("#btn_salvar").removeClass("disabled");
        }
    }
    
    /*    
    function retirarTodosOptions(obj1, obj2){
      select_Class.selectAllOptions(obj1,true);
      select_Class.moveOptions(obj1, obj2);
      setTotalReg();
      statusBtn();
    }
    */
   
    // Métodos públicos
    return {
        init: function() {
            IpageApp.wait(true);
            $("#form1").attr("action", "javascript:VendedorCliente.saveReg();void(0);");
            //
            $('#cbo_vendedor').change(function() {
                var idx = $(this).get(0).selectedIndex,
                    id = 0;
                //   
                if (idx <= 0) {
                    clearTxt();
                    statusBtn();
                } else {
                    id = $(this).get(0).options[idx].value;
                    //                    
                    loadItensIntoCombo('application/views/cadastros/vendedor_cliente/ajax/vendedor_cliente_ajax.php', '', 'list1', '');
                    loadItensIntoCombo('application/views/cadastros/vendedor_cliente/ajax/vendedor_cliente_ajax.php', 'descricao=' + id, 'list2', '');
                    statusBtn();
                }
            });
            $("#list1").dblclick(function() {
                incluirOptions('list1', 'list2');
            });
            //
            $("#list2").dblclick(function() {
                retirarOptions('list2', 'list1');
            });
            //
            $("#mnu_adicionar").click(function() {
                incluirOptions("list1", "list2", function(r) {
                    if(r!==0){
                        ipageViews.notyMessage("Operação realizada com sucesso!", 'success', 1000);
                    }else{
                        ipageViews.notyMessage("Selecione um ítem na listagem: Cliente à Associar para esta operação!", 'warning', 3000);
                    }
                });
            });
            //
            $("#mnu_retirar").click(function() {
                retirarOptions("list2", "list1", function(r) {
                    if(r!==0){
                        ipageViews.notyMessage("Operação realizada com sucesso!", 'success', 1000);
                    }else{
                        ipageViews.notyMessage("Selecione um ítem na listagem: Cliente(s) Associado(s) para esta operação!", 'warning', 3000);
                    }
                });
            });
            IpageApp.wait(false);
        },
        saveReg: function() {
            jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
                if (r) {
                    select_Class.selectAllOptions('list2');
                    var serializeDados,
                        idx = $('#cbo_vendedor').get(0).selectedIndex,
                        vendedor_id = $('#cbo_vendedor').get(0).options[idx].value,
                        cliente_id = $("#list2").val() || [];
                    //  
                    serializeDados = 'vendedor_id=' + vendedor_id;
                    //
                    for (var i = 0; i < cliente_id.length; i++) {
                        serializeDados += '&list2=' + cliente_id[i];
                    }
                    //
                    $.ajax({
                        // Usando metodo Post
                        type: 'POST',
                        dataType: 'text',
                        timeout: 15000,
                        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                        // this.action pega o script para onde vai ser enviado os dados
                        url: "application/views/cadastros/vendedor_cliente/ajax/vendedor_cliente_addupdt_ajax.php",
                        // os dados que pegamos com a função serialize()
                        data: $('#form1').serialize(),
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
                                case 'PERMISSION_DENIED':
                                    jCritical("Permissão negada para acessar as rotinas de inserção/edição deste módulo!", 'Atenção', function(r) {
                                        if (r) {
                                            window.location.href = 'index.php';
                                        }
                                    });
                                    break;
                                case 'OK_INSERT':
                                    ipageViews.notyMessage("Operação realizada com sucesso!", 'success', 1000, function(result){
                                        window.location.reload();
                                    });
                                    break;
                                default:
                                    var ret = "Ocorreu um erro " + txt + ", <br/>";
                                    ret += "Entre em contato com o suporte técnico para maiores informações.";
                                    ipageViews.notyMessage(ret, 'error', 0);
                                    break;
                            }
                        },
                        // Se acontecer algum erro é executada essa função
                        error: function(txt) {
                            ipageViews.notyMessage('Ocorreu um erro inesperado, tente mais tarde!', 'error', 0);
                        }
                    });
                    return false;
                }
            });
        }
    }
}();