/**
 * @version    1.0
 * @package    usuário
 * @subpackage redefinir a senha
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 26 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 1.
    Largest function has 27 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 14 while the median is 2.
 * 
*/
var RedefinirSenha;
$(document).ready(function() {    
    RedefinirSenha = new RedefinirSenhaIndex();
    RedefinirSenha.init({});
    
});
/*
  ************************************************************
*/
function RedefinirSenhaIndex() {
  var cUrl = new IPAGE_url_encodeClass();
  this.init = init;
  this.redefineSenha = redefineSenha;
  this.submitForm = submitForm;
  var m_email, m_form;
  /*
    ************************************************************
  */
  function init(par) {
      IpageApp.wait(true);
      if (typeof(par) === 'undefined') {
          par = {};
      }
      if (typeof(par.email) === 'undefined') {
          par.email = 'txtemail';
      }
      if (typeof(par.form) === 'undefined') {
          par.form = 'form1';
      }
      //PASSO OS DADOS PARA AS VARIÁVEIS DA CLASSE        
      m_email = par.email;
      m_form = par.form;
      //
      $("#" + m_form).attr("action", "javascript:RedefinirSenha.submitForm();void(0);");
      $("#user_nova_senha").keyup(function(){
        forcaSenha($(this).val());
        equal($('#user_confirmar_senha').val());
      });
      $("#user_confirmar_senha").keyup(function(){
        equal($(this).val());
      });
      IpageApp.wait(false);
      //
  }
  /*
    ************************************************************
  */
  function login() {
      jAlert("Você receberá um email informando a sua nova senha.", 'Atenção', function(r) {
          if (r) {
              window.location.href = "application/views/access/login/index.php?logout=true";
          }
      });
  }

  /*
    ************************************************************
  */
  function submitForm() {
      if (verificaCampos() === false) {
          return false;
      }
      //
      return redefineSenha();
  }
  /*
    ************************************************************
  */
  function verificaCampos(){
    var user_senha_atual     = ipageViews.replaceAll($('#user_senha_atual').val(), "'", "");//NAO DEVE SER MENOR QUE 6 CARACTERES
    var user_nova_senha      = ipageViews.replaceAll($('#user_nova_senha').val(), "'", "");//NAO DEVE SER MENOR QUE 6 CARACTERES
    var user_confirmar_senha = ipageViews.replaceAll($('#user_confirmar_senha').val(), "'", "");//NAO DEVE SER MENOR QUE 6 CARACTERES
    var user_id       = $('#user_id').val();//SE FOR ZERO É ADIÇÃO CASO CONTRÁRIO É EDIÇÃO.
    //
    if(typeof($('#user_senha_atual').attr('required'))!=='undefined'){
      if(user_senha_atual.length < 6){
        jCritical('A senha não poderá conter menos que 6 caracteres, verifique!', 'Atenção', function(r){
          if(r){
            $('#user_senha_atual').focus().select();
          }  
        });
        return false;
      }
    }
    //
    if(typeof($('#user_nova_senha').attr('required'))!=='undefined'){
      if(user_nova_senha.length < 6){
        jCritical('A senha não poderá conter menos que 6 caracteres, verifique!', 'Atenção', function(r){
          if(r){
            $('#user_nova_senha').focus().select();
          }  
        });
        return false;
      }        
    }
    //
    if(typeof($('#user_confirmar_senha').attr('required'))!=='undefined'){
      if(user_confirmar_senha.length < 6){
        jCritical('A senha não poderá conter menos que 6 caracteres, verifique!', 'Atenção', function(r){
          if(r){
            $('#user_confirmar_senha').focus().select();
          }  
        });
        return false;
      }        
    }
    // VERIFICA SE A NOVA SENHA É IGUAL A CONFIRMAÇÃO DA SENHA
    if($('#user_nova_senha').val() !== $('#user_confirmar_senha').val()){
        jCritical('As senhas são divergentes, verifique!', 'Atenção', function(r){
          if(r){
            $('#user_nova_senha').focus().select();
          }  
        });
        return false;      
    }
    // A NOVA SENHA NÃO PODE SER IGUAL A SENHA ATUAL
    if($('#user_senha_atual').val().toUpperCase() === $('#user_confirmar_senha').val().toUpperCase()){
        jCritical('A nova senha não pode ser igual a senha atual, verifique!', 'Atenção', function(r){
          if(r){
            $('#user_nova_senha').focus().select();
          }  
        });
        return false;      
    }
    //
    if(typeof($('#user_id').attr('required'))!=='undefined'){
      if(user_id.length <= 0){
        jCritical('Código do usuário inválido, esta página será redirecionada', 'Atenção', function(r){
          if(r){
            window.location.href = "index.php";
          }  
        });
        return false;
      }        
    }
    
    return true;
  }
  /*
    ************************************************************
  */  
  function equal(senha){    
    //
    var user_nova_senha = $('#user_nova_senha').val();
    //
    if(senha.length===0){
      $(".confirme").html('<table><tr><td bgcolor="red" width="100"></td><td>&nbsp;Confirme a Senha</td></tr></table>');
    }else	if(user_nova_senha !== senha){
  		$(".confirme").html('<table><tr><td bgcolor="red" width="100"></td><td>&nbsp;Senha diferente</td></tr></table>');
    }else	if(user_nova_senha === senha){
  		$(".confirme").html('<table><tr><td bgcolor="green" width="100"></td><td>&nbsp;Senha Ok</td></tr></table>');
  	}
  }  
  /*
    ************************************************************
  */  
  function forcaSenha(senha){
  	var forca = 0;
    
  	if((senha.length >= 4) && (senha.length <= 7)){
  		forca += 10;
  	}else if(senha.length>7){
  		forca += 25;
  	}
  	if(senha.match(/[a-z]+/)){
  		forca += 10;
  	}
  	if(senha.match(/[A-Z]+/)){
  		forca += 20;
  	}
  	if(senha.match(/d+/)){
  		forca += 20;
  	}
  	if(senha.match(/W+/)){
  		forca += 25;
  	}
    //
    if(senha.length===0){
      $(".mostra").html('<table><tr><td bgcolor="red" width="0"></td><td>&nbsp;Informe a senha</td></tr></table>');
    }else	if(forca < 30){
  		$(".mostra").html('<table><tr><td bgcolor="red" width="'+forca+'"></td><td>&nbsp;Fraca</td></tr></table>');
  	}else if((forca >= 30) && (forca < 60)){
  		$(".mostra").html('<table><tr><td bgcolor="yellow" width="'+forca+'"></td><td>&nbsp;Justa</td></tr></table>');
  	}else if((forca >= 60) && (forca < 85)){
  		$(".mostra").html('<table><tr><td bgcolor="blue" width="'+forca+'"></td><td>&nbsp;Forte</td></tr></table>');
  	}else{
  		$(".mostra").html('<table><tr><td bgcolor="green" width="'+forca+'"></td><td>&nbsp;Excelente</td></tr></table>');
  	}
  }   
  /*
    ************************************************************
  */  
  function redefineSenha(){
      jQuestion('Confirma os dados digitados?', 'Atenção', function(r)
      {
        if(r){
          /*
          DECLARAÇÃO VARIÁVEIS
          */          
          var serializeDados,    
              url;
          //
          serializeDados  = 'user_senha_atual=' + $('#user_senha_atual').val();
          serializeDados += '&user_nova_senha=' + $('#user_nova_senha').val();
          serializeDados += '&user_confirmar_senha=' + $('#user_confirmar_senha').val();
          serializeDados += '&user_id=' + $('#user_id').val();
          //
          url = 'parameter1=' + cUrl.encodeHex($.base64.encode(serializeDados));
          //
          serializeDados = url;
          //
          $.ajax({
            // Usando metodo Post
            type : 'POST',
            dataType : 'text',
            timeout : 15000,
            contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
            // this.action pega o script para onde vai ser enviado os dados
            url : "application/views/user/redefinir_senha_/ajax/redefinir.senha.ajax.php",
            // os dados que pegamos com a função serialize()
            data : serializeDados,
            // Antes de enviar
            beforeSend : function(){
              IpageApp.wait(true);
            },
            success : function(txt, textStatus){
              IpageApp.wait(false);
              /*
              VERIFICA SE O VALOR RETORNADO PELO SERVIDOR
              */
              switch (txt) {
                case 'OK':
                    jAlert("Operação realizada com sucesso!", 'Atenção', function(r){
                      if(r){
                        window.location.href = 'index.php';
                      }
                    });
                    break;
                case 'NO_MATCH':
                    jCritical("Senha inválida, verifique!", 'Atenção', function(r){
                      if(r){
                        $('#user_senha_atual').trigger('focus').select();
                      }
                    });
                    break;
                case 'NO_MACTH_NEW_PASSWORD':
                    jCritical("As senhas são divergentes, verifique!", 'Atenção', function(r){
                      if(r){
                        $('#user_nova_senha').trigger('focus').select();
                      }
                    });
                    break;
                case 'EQUAL_PASSWORDS':
                    jCritical("A nova senha não pode ser igual a senha atual, verifique!", 'Atenção', function(r){
                      if(r){
                        $('#user_nova_senha').trigger('focus').select();
                      }
                    });
                    break;
                default:
                    jCritical("Ocorreu um erro " + txt + ", Entre em contato com o suporte técnico para maiores informações.", 'Atenção');
                    break;
                }

            },
            // Se acontecer algum erro é executada essa função
            error : function(txt){
              jCritical('Ocorreu um erro inesperado, tente mais tarde!', 'Erro');
            }
          }
          );
          return false;
        }
      }
      );
    }  
}