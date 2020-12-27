/**
 * @version    1.0
 * @package    produto
 * @subpackage Edição foto
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 *
  Metrics
    There are 13 functions in this file.
    Function with the largest signature take 4 arguments, while the median is 1.
    Largest function has 4 statements in it, while the median is 2.
    The most complex function has a cyclomatic complexity value of 6 while the median is 1.
 * 
*/
var FotoEdit;
$(document).ready(function() {    
    FotoEdit = new Foto_Edit();
    FotoEdit.init({});     
});

/**
 * [Foto_Edit description]
 */
function Foto_Edit(){
  this.init = init;

  /**
   * [init description]
   * @param  {[type]} par [description]
   * @return {[type]}     [description]
   */
  function init(par) {
      IpageApp.wait(false);
      if (typeof(par) === 'undefined') {
          par = {};
      }
      //
      /* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */ 
      $('#fileUpload').on('change',function(){
        resetValuesPB();        
        /* Efetua o Upload sem dar refresh na pagina */ 
        $('#form1').ajaxForm({
            beforeSubmit: function(arr, $form, options) { 
                // The array of form data takes the following form: 
                // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ] 
                 
                // return false to cancel submit                                  
            },
            uploadProgress: function(event, position, total, percentComplete){
              //console.log('event: ' + event + ', position: ' + position + ', total: ' + total + ', percentComplete: ' + percentComplete)              
              $('.progress-bar').css({
                'width': percentComplete + '%',
                'visibility': 'visible'
              }).attr('aria-valuenow', percentComplete);
              $('#prg_result').html(percentComplete +'%');
            },
            success: function(txt, status, xhr){
              IpageApp.wait(false);
              var ret = txt.split(';');
              /*
              VERIFICA SE O VALOR RETORNADO PELO SERVIDOR
              */
              switch (ret[0]){
                case 'OK':
                    $('#produto_foto').attr('src', 'application/views/produto/produto/foto_edit/foto/' + ret[1]);                                    
                    /*
                    jAlert("Operação realizada com sucesso!", 'Atenção', function(r){
                      if(r){
                        $('#produto_foto').attr('src', 'application/views/produto/produto/foto_edit/foto/' + ret[1]);                        
                      }
                    });
                    */
                    break;
                case 'USER_CANCEL':
                    resetValuesPB();
                    jCritical("Operação cancelada pelo usuário", 'Atenção', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;                    
                case 'INVALID_FORMAT_FILE':
                    resetValuesPB();
                    jCritical("O formato do arquivo não é permitido, verifique!", 'Atenção', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                case 'OVERFLOW':
                    resetValuesPB();
                    jCritical("O tamanho do arquivo excede o valormáximo permitido:<br />(máx. 1 mega bytes), verifique!", 'Atenção', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                case 'ERROR':
                    resetValuesPB();
                    jCritical("Ocorreu um erro inesperado, entre em contato com o usuário administrador!", 'Atenção', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                default:
                    resetValuesPB();
                    jCritical("Ocorreu um erro " + txt + ", <br/>Entre em contato com o suporte técnico para maiores informações.", 'Atenção');
                    break;
                }
            },
            // Se acontecer algum erro é executada essa função
            error : function(txt){
              resetValuesPB();
              jCritical('Ocorreu um erro inesperado, entre em contato com o usuário administrador!', 'Erro');
            }
         }).submit(); 
       });
  }

  /**
   * [resetValuesPB description]
   * @return {[type]} [description]
   */
  function resetValuesPB(){
    $('.progress-bar').css({
      'width': 0,
      'visibility': 'hidden'
    }).attr('aria-valuenow', 0);
    $('#prg_result').html('0% completo');                  
  }
}