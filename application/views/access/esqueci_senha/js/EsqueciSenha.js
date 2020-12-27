  /**
       * @version    1.0
       * @package    Acesso
       * @subpackage Esqueci a senha
       * @author     Di�genes Dias <diogenesdias@hotmail.com>
       * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
       * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
       *
        Metrics
          There are 24 functions in this file.
          Function with the largest signature take 2 arguments, while the median is 0.
          Largest function has 10 statements in it, while the median is 1.
          The most complex function has a cyclomatic complexity value of 6 while the median is 1.
       * 
      */
  $(document).ready(function() {
      esqueciSenha.init();
  });
  /*
   ************************************************************
   */
  var esqueciSenha = function() {
      // M�todos privados da classe
          var handleEvents = function() {
          //// Habilita o uso da tecla enter nas caixas de texto
          //////
          $('input password').keypress(function(event) {
              var allInputs = $(':text:visible');
              if (event.keyCode == 13) {
                  event.preventDefault();
                  // A pr�xima entrada na minha cole��o de todas as entradas
                  var nextInput = allInputs.get(allInputs.index(this) + 1);
                  //
                  //// Verifica se � a �ltima caixa de texto
                  ////////
                  if ($(this).data('last-input')) {
                      Login.submitForm();
                  } else if (nextInput) {
                      // Passa o foco para pr�xima entrada se a entrada n�o for nula
                      nextInput.focus();
                  }
              }
          });
      };
      // 
      function handleButton() {
        var time =0;
          $("#btn_novo").click(function() {
              window.location.href = 'esqueci_senha/';
          });
          $("#btn_captcha").click(function() {
              esqueciSenha.change_captcha();
          });
          $("#btn_enviar").click(function() {
              $('#form1').submit();
          });
          $("#btn_sair").click(function() {
              window.parent.location.href = 'index.php';
          });
          setInterval(function(){
              time++;
              // Dois minutos de inatividade
              if(time >= 120){
                  time = 0;
                  esqueciSenha.change_captcha(function(result){
                      $("#txtkey").val("").focus();
                  });                
              }
          }, 1000);          
      }
      /**
       * Realiza a valida��o dos dados do form
       * @return true se a valida��o foi bem sucedida
       */
      function verificaCampos() {
          var msg = 'Campo inv�lido ou inexistente, verifique!';
          var email = $("#txtemail").val();
          //
          if (typeof(email) === 'undefined' || email.length === 0 || ipageViews.verificaEmail(email) === false) {
              ipageViews.notyMessage('Email: ' + msg, 'error', 2000, function(result) {
                  $("#txtemail").focus();
              });            
              return false;
          }
          //
          txtkey = $("#txtkey").val();
          if (typeof(txtkey) === 'undefined' || txtkey.length === 0) {
              ipageViews.notyMessage('C�digo Acesso: ' + msg, 'error', 2000, function(result) {
                  $("#txtkey").focus();
              });             
              return false;
          }
          //
          return true;
      }
      /**
       * Inicializa��o da classe
       * @param  par�metro com os dados do form esqueci a senha
       * @return void
       */
      return {
          init: function(par) {
              IpageApp.wait(true);
              //
              $('#form1').attr("action", "javascript:esqueciSenha.submitForm();void(0);");
              handleButton();
              IpageApp.wait(false);
          },
          change_captcha: function(callback) {
              IpageApp.wait(true);
              document.getElementById('img-key').src = "application/controles/captcha/pngimg.php?rnd=" + Math.random();
              //
              $('#img-key').load(function() {
                  IpageApp.wait(false, function() {
                      return callback ? callback(true) : false;
                  });
              });
          },
          enviar: function() {
              var cUrl = new IPAGE_url_encodeClass(),
                  par = '',
                  email = $('#txtemail').val(),
                  captcha = $('#txtkey').val(),
                  serializeDados = '';
              par += 'email=' + cUrl.encodeHex($.base64.encode(email));
              par += '&captcha=' + cUrl.encodeHex($.base64.encode(captcha));
              //  
              serializeDados = par;
              //
              $.ajax({
                  type: 'POST',
                  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
                  url: "application/views/access/esqueci_senha/ajax/esqueci_senha_validar_ajax.php?rnd=" + Math.random(),
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
                        ipageViews.notyMessage("Voc� receber� um email informando a sua nova senha.", 'success', 0, function(result) {
                            window.location.href = "login/";
                        });
                    } else {
                        ipageViews.notyMessage(msg, 'error', 2000, function(result) {
                            esqueciSenha.change_captcha(function(result){
                                if(id!='txtkey'){
                                    $('#txtkey').val("");
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
                    esqueciSenha.change_captcha();
                }
              });
              return false;
          },
          submitForm: function() {
              if (verificaCampos() === false) {
                  return false;
              }
              return esqueciSenha.enviar();
          }
      };
  }();