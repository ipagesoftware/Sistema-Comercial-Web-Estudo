/**
 * @version    1.0
 * @package    produto
 * @subpackage Edi��o foto
 * @author     Di�genes Dias <diogenesdias@hotmail.com>
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
      /* #imagem � o id do input, ao alterar o conteudo do input execurar� a fun��o baixo */ 
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
                    jAlert("Opera��o realizada com sucesso!", 'Aten��o', function(r){
                      if(r){
                        $('#produto_foto').attr('src', 'application/views/produto/produto/foto_edit/foto/' + ret[1]);                        
                      }
                    });
                    */
                    break;
                case 'USER_CANCEL':
                    resetValuesPB();
                    jCritical("Opera��o cancelada pelo usu�rio", 'Aten��o', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;                    
                case 'INVALID_FORMAT_FILE':
                    resetValuesPB();
                    jCritical("O formato do arquivo n�o � permitido, verifique!", 'Aten��o', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                case 'OVERFLOW':
                    resetValuesPB();
                    jCritical("O tamanho do arquivo excede o valorm�ximo permitido:<br />(m�x. 1 mega bytes), verifique!", 'Aten��o', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                case 'ERROR':
                    resetValuesPB();
                    jCritical("Ocorreu um erro inesperado, entre em contato com o usu�rio administrador!", 'Aten��o', function(r){
                      if(r){
                        $('#fileUpload').trigger('focus');
                      }
                    });
                    break;
                default:
                    resetValuesPB();
                    jCritical("Ocorreu um erro " + txt + ", <br/>Entre em contato com o suporte t�cnico para maiores informa��es.", 'Aten��o');
                    break;
                }
            },
            // Se acontecer algum erro � executada essa fun��o
            error : function(txt){
              resetValuesPB();
              jCritical('Ocorreu um erro inesperado, entre em contato com o usu�rio administrador!', 'Erro');
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