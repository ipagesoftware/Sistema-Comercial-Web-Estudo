/**
 * @version    1.0
 * @package    Financeiro
 * @subpackage Seleção da procedência financeira
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 * 
   @Metrics
    There are 11 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 1.
    Largest function has 14 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 4 while the median is 2.
*/
$(document).ready(function() {
    SelProcedencia.init();
});
/**
 * Classe para gerir a página da seleção da procedência
 */
var SelProcedencia = function() {
    // Variável privada e global a classe
    var cUrl = new IPAGE_url_encodeClass();
    // Métodos públicos da classe
    return{
        init: function (par) {
            $("#form1").attr("action", "javascript:SelProcedencia.selecionarProcedencia();void(0);");
            //
            $('#cbo_procedencia').change(function() {
                var idx = $(this).get(0).selectedIndex,
                    procedencia_id = $(this).get(0).options[idx].value;
                //
                if (parseInt(procedencia_id, 10) === 0) {
                    $('#btn_ok').addClass('disabled');
                } else {
                    //
                    $('#btn_ok').removeClass('disabled');
                }
            });
            //
            IpageApp.wait(false);
        },
        selecionarProcedencia: function() {
            if ($('#btn_ok').hasClass('disabled')) {
                return false;
            }
            var idx = $('#cbo_procedencia').get(0).selectedIndex,
                procedencia_id = $('#cbo_procedencia').get(0).options[idx].value,
                procedencia_descricao = $('#cbo_procedencia').get(0).options[idx].text,
                serializeDados = '',
                url;
            //
            if (parseInt(procedencia_id, 10) === 0) {
                jCritical("Nenhuma procedência foi selecionada, verifique!", 'Atenção', function(r) {
                    if (r) {
                        $('#cbo_procedencia').trigger('focus');
                    }
                });
                //
                return false;
            }
            //
            serializeDados = 'procedencia_id=' + procedencia_id;
            serializeDados += '&procedencia=' + procedencia_descricao;
            url = cUrl.urlGenerator() + '&';
            url += serializeDados;
            url = 'parameter1=' + cUrl.encodeHex($.base64.encode(url));
            //
            serializeDados = url;
            //
            $.ajax({
                // Usando metodo Post
                type: 'POST',
                dataType: 'text',
                timeout: 15000,
                contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                // this.action pega o script para onde vai ser enviado os dados
                url: "application/views/financeiro/sel_procedencia/ajax/sel_procedencia_ajax.php",
                // os dados que pegamos com a função serialize()
                data: serializeDados,
                // Antes de enviar
                beforeSend: function() {
                    IpageApp.wait(true);
                },
                success: function(txt, textStatus) {
                    IpageApp.wait(false);
                    // Verifica se o valor retornado pelo servidor
                    switch (txt) {
                        case 'OK':
                            window.location.href = 'index.php';
                            break;
                        case 'INVALID_NAME':
                            jCritical("Procedência inválida, verifique!", 'Atenção', function(r) {
                                if (r) {
                                    $('#cbo_procedencia').trigger('focus');
                                }
                            });
                            break;
                        case 'INVALID_ID':
                            jCritical("Código procedência inválido, verifique!", 'Atenção', function(r) {
                                if (r) {
                                    $('#cbo_procedencia').trigger('focus');
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
    };
}();