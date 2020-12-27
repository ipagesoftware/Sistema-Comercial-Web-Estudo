/**
 *
 * @version    1.0
 * @package    plugins
 * @subpackage cep
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */
function ipageCep() {
    /*
     ************
     * CONSTANT
     ************
     */
    /*******************************************************************/
    this.version = version;
    this.getCep = getCep;
    this.validaCep = validaCep;
    this.ShowGoogleMaps = ShowGoogleMaps;
    this.ShowECT = ShowECT;
    /*******************************************************************/
    /*
     ************************************************************
     */
    function validaCep(cep) {
        //VERIFICA SE O CEP É VÁLIDO
        var v = cep.replace(/\D/g, "");
        if (v.length != 8) {
            return false;
        }
        return true;
    }
    /*
     ************************************************************
     */
    function getCep(cep, callback) {
        // Acesse o link:
        // https://ipage.com.br/ipage/wskey/
        // Para solicitar a sua chave da nossa api de ceps
        var chave_api = "576c0c8dde5711eabe8c525400c9158a";
        // Chave de acesso ao Webservice----------------------------------------+
        // Formato ---------------------------------------------------+         |
        // Número do CEP ------------------------------------+        |         |
        // Versão do Webservice -----------------+           |        |         |
        // Url do Webservice ---+                |           |        |         |
        //                      |                |           |        |         |
        //                      |                |           |        |         |
        //                      v                v           v        v         v
        //         ---------------------------- -- ---  ---------  ----     ---------------
        var link = "https://www.ipage.com.br/ws/v1/cep/" + cep + "/json/" + chave_api + "/";
        //
        var msg, resultadoCEP;
        if (validaCep(cep) === false) {
            callback ? callback({error:'true', msg: 'Número do CEP inválido ou inexistente, verifique!'}) : null;
            return false;
        }
        //
        $.ajax({
            contentType: 'charset=UTF-8',
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            url: link, // PÁGINA QUE RECEBERÁ OS DADOS DO CADASTRO
            datatype: 'json',
            type: 'GET',
            // Antes de enviar
            beforeSend: function(){
              IpageApp.wait(true);
            },          
            success: function(data) {
              // REALIZO UMA LIMPEZA NOS DADOS AJUSTANDO CARACETRES ESPECIAIS
              jQuery.each(data, function(index, item){
                  data[index] = unescape(item);
              });
              //
              return callback?callback(data):null;
            },
            error: function(xhr, er) {
                IpageApp.wait(false);
                // ERRO A NÍVEL DO SERVIDOR
                msg = 'Error ' + xhr.status + ' - ' + xhr.statustext + '\nTipo de erro: ' + er;
                erro = new Array({"erro": true, "msg": msg});
                return callback?callback(erro[0]):null;
            }
        });
        return false;
    }
    /*
     ************************************************************
     */
    function ShowGoogleMaps(cep, endereco, bairro, cidade, uf, callback) {
        //VERIFICA SE O CEP É VÁLIDO
        if (validaCep(cep) === false) {
            callback ? callback({error:'true', msg: 'Número do CEP inválido ou inexistente, verifique!'}) : null;
        } else if (endereco.length === 0) {
            callback ? callback({error:'true', msg: 'Endereço inválido, verifique!'}) : null;
            //return 'INVALID_ENDRESS';
        } else {
            var url = 'http://www.google.com/maps';
            url += '?q=' + endereco;
            url += '+' + cep + ',';
            url += '+' + cidade + '+-+' + uf;
            url += '&t=m&z=16&output=embed"';
            w = open_Window('home_page', url, 0, 0, 740, 560, 'yes', 'no', 'no', 'yes', 'no');
            callback ? callback({error:'false', msg: 'OK'}) : null;
            
        }
    }
    /*
     ************************************************************
     */
    function ShowECT() {
        var url = 'http://www.buscacep.correios.com.br/servicos/dnec/index.do';
        w = open_Window('home_page', url, 0, 0, 740, 560, 'yes', 'no', 'no', 'yes', 'no');
        return 'OK';
    }
    /*
     ************************************************************
     */
    function Site(v) {
        v = v.replace(/^http:\/\/?/, "");
        dominio = v;
        caminho = "";
        if (v.indexOf("/") > -1) {
            dominio = v.split("/")[0];
        }
        caminho = v.replace(/[^\/]*/, "");
        dominio = dominio.replace(/[^\w\.\+-:@]/g, "");
        caminho = caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g, "");
        caminho = caminho.replace(/([\?&])=/, "$1");
        if (caminho !== "") {
            dominio = dominio.replace(/\.+$/, "");
        }
        v = "http://" + dominio + caminho;
        return v.toLowerCase();
    }
    /*
     ************************************************************
     */
    function open_Window(name, url, left, top, width, height, toolbar, menubar, statusbar, scrollbar, resizable) {
        toolbar_str = toolbar ? 'yes' : 'no';
        menubar_str = menubar ? 'yes' : 'no';
        statusbar_str = statusbar ? 'yes' : 'no';
        scrollbar_str = scrollbar ? 'yes' : 'no';
        resizable_str = resizable ? 'yes' : 'no';
        return window.open(url, name, 'left=' + left + ',top=' + top + ',width=' + width + ',height=' + height + ',toolbar=' + toolbar_str + ',menubar=' + menubar_str + ',status=' + statusbar_str + ',scrollbars=' + scrollbar_str + ',resizable=' + resizable_str);
    };
    /*
     ************************************************************
     */
    function version() {
        return '14.12.2020';
    }
}