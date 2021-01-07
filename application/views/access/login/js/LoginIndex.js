/**
 * @version    1.0
 * @package    Acesso
 * @subpackage Login
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 * 
   @Metrics
    There are 27 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 0.
    Largest function has 15 statements in it, while the median is 1.
    The most complex function has a cyclomatic complexity value of 8 while the median is 1.
*/
$(document).ready(function() {
    Login.init();
});
/**
 * Classe para gerir a página de login da aplicação
 * 
 * @return void
 */
var Login = function() {
    // Métodos privados
    var handleEvents = function() {
        //// Habilita o uso da tecla enter nas caixas de texto
        //////
        $('input password').keypress(function(event) {
            var allInputs = $(':text:visible');
            if (event.keyCode == 13) {
                event.preventDefault();
                // A próxima entrada na minha coleção de todas as entradas
                var nextInput = allInputs.get(allInputs.index(this) + 1);
                //
                //// Verifica se é a última caixa de texto
                ////////
                if ($(this).data('last-input')) {
                    Login.submitForm();
                } else if (nextInput) {
                    // Passa o foco para próxima entrada se a entrada não for nula
                    nextInput.focus();
                }
            }
        });
    };
    /**
     * Método resposável pelos eventos das opçãoes
     * do form login
     * 
     * @param  valor opcional do prefixo do menu
     * @return void;
     */
    function handleButton(_value) {
        var time = 0;
        $("#btn_novo").click(function() {
            window.location.href = 'login/';
        });
        //
        $("#btn_captcha").click(function() {
            Login.change_captcha(function(result){
                $("#txtkey").focus();
            });
        });
        //
        $("#btn_login").click(function() {
            $('#form1').submit();
        });
        //
        $("#btn_sair").click(function() {
            window.parent.location.href = URL;
        });
        // Remove o tabindex do botão visualizar senha/ocultar
        $(".input-group-btn, #toggle-password").attr('tabindex', -1);
        //
        setInterval(function(){
            time++;
            // Dois minutos de inatividade
            if(time >= 120){
                time = 0;
                Login.change_captcha(function(result){
                    $("#txtkey").val("").focus();
                });                
            }
        }, 1000);
    }
    /**
     * Realiza a validação dos dados do form login
     * @return true se a validação foi bem sucedida
     */
    function verificaCampos() {
        var msg = 'Campo inválido ou inexistente, verifique!';
        var email = $("#txtemail").val();
        var pwd = $("#txtpwd").val();
        //
        if (typeof(email) === 'undefined' || email.length === 0 || ipageViews.verificaEmail(email) === false) {
            ipageViews.notyMessage('Email: ' + msg, 'error', 2000, function(result) {
                $("#txtemail").focus();
            });            
            return false;
        }
        //
        if (typeof(pwd) === 'undefined' || pwd.length === 0) {
            ipageViews.notyMessage('Senha: ' + msg, 'error', 2000, function(result) {
                $("#txtpwd").focus();
            });             
            return false;
        }
        //
        txtkey = $("#txtkey").val();
        if (typeof(txtkey) === 'undefined' || txtkey.length === 0) {
            ipageViews.notyMessage('Código Acesso: ' + msg, 'error', 2000, function(result) {
                $("#txtkey").focus();
            });             
            return false;
        }
        //
        return true;
    }
    /**
     * [handleTogglePassword description]
     * @return {[type]} [description]
     */
    function handleTogglePassword() {
        var togglePassword = document.getElementById("toggle-password");
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                var x = document.getElementById("txtpwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });
        }
    }
    // Métodos público da classe
    return {
        init: function() {
            $('#form1').attr("action", "javascript:Login.submitForm();void(0);");
            handleButton();
            handleTogglePassword();
            handleEvents();
            IpageApp.wait(false);
        },
        change_captcha: function(callback) {
            IpageApp.wait(true);
            document.getElementById('img-key').src = "application/controles/captcha/pngimg.php?rnd=" + Math.random();
            //
            $('#img-key').load(function() {
                return callback ? callback(true) : false;
            });
        },
        logar: function() {
            var url = "application/views/access/login/ajax/login_validar_ajax.php?rnd=" + Math.random();
            var financas = $("body").data("financas");
            var home = $("body").data("url");
            var cUrl = new IPAGE_url_encodeClass();
            var par = '';
            var email = $('#txtemail').val();
            var pwd = $('#txtpwd').val();
            var captcha = $('#txtkey').val();
            var serializeDados = '';
            //        
            par += 'email=' + cUrl.encodeHex($.base64.encode(email));
            par += '&pwd=' + cUrl.encodeHex($.base64.encode(pwd));
            par += '&captcha=' + cUrl.encodeHex($.base64.encode(captcha));
            //                
            serializeDados = par;
            $.ajax({
                type: 'POST',
                dataType: 'text',
                timeout: 15000,
                url: url,
                data: serializeDados,
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
                        id = 'txtemail'; // Primeira caixa de texto
                    }
                    if (msg == "OK") {
                        if (parseInt(financas, 10) == 1) {
                            // Após o login ser bem sucedido direciona para 
                            // a seleção da procedênciado módulo financeiro                    
                            window.parent.location.href = "sel_procedencia/";
                        } else {
                            window.parent.location.href = home;
                        }
                    } else {
                        ipageViews.notyMessage(msg, 'error', 2000, function(result) {
                            Login.change_captcha(function(result){
                                if(id!='txtkey'){
                                    $('#' + id).trigger('focus').select();
                                }else{
                                    $('#txtkey').trigger('focus').select();                                    
                                }
                            });
                        });
                    }
                },
                error: function(xhr, er) {
                    IpageApp.wait(false);
                    var ret = 'Error ' + xhr.status + ' - ' + xhr.statustext + '\nTipo de erro: ' + er;
                    ipageViews.notyMessage(ret, 'error', 2000);
                    Login.change_captcha();
                }
            });
            return false;
        },
        /**
         * Faz a validação dos dados ao submeter o formulário de login
         * @return false se algum erro ocorreu na tentativa de logar-se
         * no sistema
         */
        submitForm: function() {
            if (verificaCampos() === false) {
                return false;
            }
            return Login.logar();
        },
    };
}();