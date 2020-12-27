/**
 * @version    1.0
 * @package    produto cadastro
 * @subpackage fabricante
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 21 functions in this file.
    Function with the largest signature take 2 arguments, while the median is 1.
    Largest function has 10 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 5 while the median is 1.
 * 
*/
$(document).ready(function() {    
    FabricanteModal.init();     
});

/**
 * [Fabricante_Modal description]
 */
var FabricanteModal = function() {
    // Variáveis privadas
    //var cUrl = new IPAGE_url_encodeClass();
    var ipageMask = new IpageMask();
    // Métodos privados
    var verificaCampos = function() {
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
                $(id).focus().select();
            });
            //          
            return false;
        }
        return true;
    };   
    var handleMask = function() {
        ipageMask.input_lostfocus();
        ipageMask.input_keyup();
        ipageMask.input_focus();
    }; 
  // Métodos públicos
  return{
    init: function(par) {
        $("#form1").attr("action", "javascript:FabricanteModal.submitForm();void(0);");
        handleMask();
        //
        $('#btn_fechar').click(function(e){
          e.preventDefault();
          window.parent.$("#myModal").modal('hide');
        });           
        //
        IpageApp.wait(false, function(r){
          $('#fabricante_descricao').focus();
        });
    },
    submitForm: function() {
        if (verificaCampos() === false) {
            return false;
        }
        //
        return FabricanteModal.saveReg();
    },
    saveReg: function(){
      jQuestion('Confirma os dados digitados?', 'Atenção', function(r) {
          if (r) {
              var formData = new FormData($("#form1")[0]);
              var url = "application/views/produto/fabricante/ajax/fabricante_addupdt_ajax.php";
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
                          id = 'fabricante_descricao'; // Primeira caixa de texto
                      }
                      if (msg == "OK") {
                          ipageViews.notyMessage('Operação realizada com sucesso!', 'success', 1000, function(result) {
                              window.location.reload();
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
    },
  }
}();