/*
*****************************************************
  CLASSE GESTORA MÁSCARA DO OBJETO INPUT) TYPE TEXT 
*****************************************************
*/
function IpageMask() {
    var documentall = document.all;
    var _this = this;
    this.initialize = function() {};
    this.formataMoney = function(c) {
        var t = this;
        if (c === undefined) {
            c = 2;
        }
        var p, d = (t = t.split("."))[1].substr(0, c);
        for (p = (t = t[0]).length;
            (p -= 3) >= 1;) {
            t = t.substr(0, p) + "." + t.substr(p);
        }
        return t + "," + d + Array(c + 1 - d.length).join(0);
    };
    String.prototype.formatCurrency = this.formataMoney;
    this.demaskvalue = function(valor, currency) {
        var val2 = '',
            strCheck = '0123456789',
            len = valor.length;
        if (len === 0) {
            return 0.00;
        }
        if (currency === true) {
            for (var i = 0; i < len; i++) {
                if ((valor.charAt(i) !== '0') && (valor.charAt(i) !== ',')) {
                    break;
                }
            }
            for (; i < len; i++) {
                if (strCheck.indexOf(valor.charAt(i)) !== -1) {
                    val2 += valor.charAt(i);
                }
            }
            if (val2.length === 0) {
                return "0.00";
            }
            if (val2.length === 1) {
                return "0.0" + val2;
            }
            if (val2.length === 2) {
                return "0." + val2;
            }
            var parte1 = val2.substring(0, val2.length - 2),
                parte2 = val2.substring(val2.length - 2),
                returnvalue = parte1 + "." + parte2;
            return returnvalue;
        } else {
            var val3 = "";
            for (var k = 0; k < len; k++) {
                if (strCheck.indexOf(valor.charAt(k)) !== -1) {
                    val3 += valor.charAt(k);
                }
            }
            return val3;
        }
    };
    this.Reais = function(obj, event) {
        var whichCode = (window.Event) ? event.which : event.keyCode;
        if (whichCode === 8 && !documentall) {
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
            var valor = obj.value;
            var x = valor.substring(0, valor.length - 1);
            if (x === '' || typeof(x) === undefined) {
                x = '0';
            }
            obj.value = this.demaskvalue(x, true).formatCurrency();
            return false;
        }
        this.FormataReais(obj, '.', ',', event);
        return this;
    };
    this.backSpaceReais = function(obj, event) {
        var whichCode = (window.Event) ? event.which : event.keyCode;
        if (whichCode === 8 && documentall) {
            var valor = obj.value;
            var x = valor.substring(0, valor.length - 1);
            var y = this.demaskvalue(x, true).formatCurrency();
            obj.value = "";
            obj.value += y;
            if (event.preventDefault) {
                event.preventDefault();
            } else {
                event.returnValue = false;
            }
            return false;
        }
    };
    this.FormataReais = function(fld, milSep, decSep, e) {
        //var sep = 0;
        var key = '';
        //var i = 0;
        //var j = 0;
        var len = 0;
        //var len2 = 0;
        var strCheck = '0123456789';
        //var aux = '';
        //var aux2 = '';
        var whichCode = (window.Event) ? e.which : e.keyCode;
        if (whichCode === 0) {
            return true;
        }
        if (whichCode === 9) {
            return true;
        }
        if (whichCode === 13) {
            return true;
        }
        if (whichCode === 16) {
            return true;
        }
        if (whichCode === 17) {
            return true;
        }
        if (whichCode === 27) {
            return true;
        }
        if (whichCode === 34) {
            return true;
        }
        if (whichCode === 35) {
            return true;
        }
        if (whichCode === 36) {
            return true;
        }
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
        key = String.fromCharCode(whichCode);
        if (strCheck.indexOf(key) === -1) {
            return false;
        }
        fld.value += key;
        len = fld.value.length;
        var bodeaux = this.demaskvalue(fld.value, true).formatCurrency();
        fld.value = bodeaux;
        if (fld.createTextRange) {
            var range = fld.createTextRange();
            range.collapse(false);
            range.select();
        } else if (fld.setSelectionRange) {
            fld.focus();
            length = fld.value.length;
            fld.setSelectionRange(length, length);
        }
        return false;
    };
    this.leech = function(v) {
        v = v.replace(/o/gi, "0");
        v = v.replace(/i/gi, "1");
        v = v.replace(/z/gi, "2");
        v = v.replace(/e/gi, "3");
        v = v.replace(/a/gi, "4");
        v = v.replace(/s/gi, "5");
        v = v.replace(/t/gi, "7");
        return v;
    };
    this.soLetras = function(v) {
        //v = v.replace(/[^\a-zA-Z]*/, "");
        v = v.replace(/[^\a-zA-Z.& ]+/g, "");
        return v;
    };
    this.soNumeros = function(v) {
        v = v.replace(/\D/g, "");
        return v;
    };
    this.telefone = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
        return v;
    };
    this.celular = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
        v = v.replace(/(\d{5})(\d)/, "$1-$2");
        return v;
    };
    this.cpf = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        v = v.replace(/(\d{3})(\d)/, "$1.$2");
        v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        return v;
    };
    this.cartao_credito = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d{4})(\d)/, "$1.$2");
        v = v.replace(/(\d{4})(\d)/, "$1.$2");
        v = v.replace(/(\d{4})(\d)/, "$1.$2");
        v = v.replace(/(\d{4})(\d{1,3})$/, "$1-$2");
        return v;
    };
    this.cep = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{5})(\d)/, "$1-$2");
        return v;
    };
    this.cnpj = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^(\d{2})(\d)/, "$1.$2");
        v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
        v = v.replace(/(\d{4})(\d)/, "$1-$2");
        return v;
    };
    this.romanos = function(v) {
        v = v.toUpperCase();
        v = v.replace(/[^IVXLCDM]/g, "");
        while (v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/, "") !== "") {
            v = v.replace(/.$/, "");
        }
        return v;
    };
    this.site = function(v) {
        v = v.replace(/^http:\/\/?/, "");
        var dominio = v;
        var caminho = "";
        //
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
        return v;
    };
    this.dataBr = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d{2})(\d)/, "$1/$2");
        v = v.replace(/(\d{2})(\d)/, "$1/$2");
        return v;
    };
    this.Hora = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d{2})(\d)/, "$1:$2");
        return v;
    };
    this.Pedido = function(v) {
        //v = v.replace(/\D/g, "");
        //v = v.replace(/(\d{3})(\d)/, "$1/$2");
        v = v.replace(/\D[a-zA-Z]+/g, "");
        v = v.replace(/(\d{3})(\d{4})/, "$1/$2");
        return v;
    };
    this.Valor = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/^([0-9]{3}\.?){3}-[0-9]{2}$/, "$1.$2");
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");
        return v;
    };
    this.Area = function(v) {
        v = v.replace(/\D/g, "");
        v = v.replace(/(\d)(\d{2})$/, "$1.$2");
        return v;
    };
    this.mascara = function(v, pmask) {
        var r = new RegExp(pmask);
        v = v.replace(r, "");
        return v;
    };
    this.SubstituirVirgulaPorPonto = function(campo) {
        return campo.replace(',', '.');
    };
    this.SubstituirPontoPorVirgula = function(campo) {
        return campo.replace('.', ',');
    };
    this.IsDate = function(value) {
        var date = new Date(),
            blnRet = false,
            blnDay,
            blnMonth,
            blnYear,
            day,
            month,
            year,
            array_data = value.split('/');
        //se o array nao tem tres partes, a data eh incorreta
        if (array_data.length !== 3) {
            return false;
        }
        //comprovo que o ano, mes, dia são corretos
        year = parseInt(array_data[2], 10);
        if (isNaN(year)) {
            return false;
        }
        //
        month = parseInt(array_data[1], 10) - 1;
        if (isNaN(month)) {
            return false;
        }
        //
        day = parseInt(array_data[0], 10);
        if (isNaN(day)) {
            return false;
        }
        //se o ano da data que recebo so tem 2 cifras temos que muda-lo a 4
        if (year <= 99) {
            year += 1900;
        }
        //  
        date.setFullYear(year, month, day);
        blnDay = (date.getDate() === day);
        blnMonth = (date.getMonth() === month);
        blnYear = (date.getFullYear() === year);
        if (blnDay && blnMonth && blnYear) {
            blnRet = true;
        }
        return blnRet;
    };
    this.getAge = function(dateString, dateType) {
        /*
           function getAge
           parameters: dateString dateType
           returns: boolean
    
           dateString is a date passed as a string in the following
           formats:
    
           type 1 : 19970529
           type 2 : 970529
           type 3 : 29/05/1997
           type 4 : 29/05/97
    
           dateType is a numeric integer from 1 to 4, representing
           the type of dateString passed, as defined above.
    
           Returns string containing the age in years, months and days
           in the format yyy years mm months dd days.
           Returns empty string if dateType is not one of the expected
           values.
        */
        var dob;
        //
        if (typeof(dateType) === 'undefined') {
            dateType = 3;
        }
        if (dateType === 1) {
            dob = new Date(dateString.substring(0, 4), dateString.substring(4, 6) - 1, dateString.substring(6, 8));
        } else if (dateType === 2) {
            dob = new Date(dateString.substring(0, 2), dateString.substring(2, 4) - 1, dateString.substring(4, 6));
        } else if (dateType === 3) {
            dob = new Date(dateString.substring(6, 10), dateString.substring(3, 5) - 1, dateString.substring(0, 2));
        } else if (dateType === 4) {
            dob = new Date(dateString.substring(6, 8), dateString.substring(3, 5) - 1, dateString.substring(0, 2));
        } else {
            return '';
        }
        var now = new Date(),
            //today = new Date(now.getFullYear(), now.getMonth(), now.getDate()),
            yearNow = now.getFullYear(),
            monthNow = now.getMonth(),
            dateNow = now.getDate(),
            dateAge = 0,
            yearDob = dob.getFullYear(),
            monthDob = dob.getMonth(),
            dateDob = dob.getDate(),
            monthAge = 0;
        var yearAge = yearNow - yearDob;
        if (monthNow >= monthDob) {
            monthAge = monthNow - monthDob;
        } else {
            yearAge--;
            monthAge = 12 + monthNow - monthDob;
        }
        if (dateNow >= dateDob) {
            dateAge = dateNow - dateDob;
        } else {
            monthAge--;
            dateAge = 31 + dateNow - dateDob;
            if (monthAge < 0) {
                monthAge = 11;
                yearAge--;
            }
        }
        var a = ((yearAge > 1) ? ' anos ' : ' ano '),
            m = ((monthAge > 1) ? ' meses ' : ' mês '),
            d = ((dateAge > 1) ? ' dias ' : ' dia ');
        return yearAge + a + monthAge + m + dateAge + d;
    };
    this.removeAcento = function(palavra) {
        var str_acento = "áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ";
        var str_sem_acento = "aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC";
        var nova = "";
        //
        for (var i = 0; i < palavra.length; i++) {
            if (str_acento.indexOf(palavra.charAt(i)) !== -1) {
                nova += str_sem_acento.substr(str_acento.search(palavra.substr(i, 1)), 1);
            } else {
                nova += palavra.substr(i, 1);
            }
        }
        return nova;
    };

    this.input_lostfocus = function() {        
        var data;
        var value;
        var ret;
        var cTimeDate = new timedateClass();
        /*
         * APLICO A FORMATAÇÃO DAS MÁSCARAS AS CAIXAS DE TEXTO
         */
        $("form input[type=text]").each(function(index) {            
            /*
            $(this).on("focus", function(e) {
                e.preventDefault();
                id = '#' + $(this).attr('id');
            });
            */
            $(this).on("blur", function(e) {
                var required = $(this).attr("required");
                var id = $(this).attr('id');
                var mask = $(this).data('mask');
                //
                e.preventDefault();
                //
                if ($(this).val().length == 0){
                    // Verifico se o campo é obrigatório
                    if(typeof(required)!='undefined'){
                        if ($(this).hasClass('ipage-warning') == false) {
                            $(this).addClass('ipage-warning');
                        }
                    }
                }else{
                    if(typeof(required)!='undefined'){
                        $(this).removeClass('ipage-warning');
                    }
                }
                //
                ipageViews.clearAspasSimples(this);
                // Verifica se é para remover acentuação
                value = ipageViews.removeAcento($(this).val());
                $(this).val(value);
                //
                if ($(this).attr('readonly')) {
                    return;
                }
                //
                switch (mask) {
                    case 'date':
                            if(typeof(required)!='undefined'){
                                if ($(this).val().length == 0) {
                                    $(this).val(cTimeDate.showDate());
                                    if ($(this).hasClass('ipage-warning') == true) {
                                        $(this).removeClass('ipage-warning');
                                    }                                    
                                }
                            }
                        break;
                    case 'letter':
                    case 'name':
                        if (ipageViews.apenasLetras($(this).val()) == false) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }
                        }
                        value = $(this).val().toLocaleUpperCase();
                        $(this).val(value);
                        break;
                    case 'currency':
                        if(Number($(this).val())==false){
                            $(this).val('0');
                        }
                        break;
                    case 'cep':
                        if (parseInt($(this).val().length, 10) < 9) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }
                        }
                        break;                        
                    case 'cpf':                           
                        if (ipageViews.verificaCPF($(this).val()) == false) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }
                        }
                        break;
                    case 'cnpj':
                        if (ipageViews.verificaCNPJ($(this).val()) == false) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }                            
                        }
                        break;
                    case 'home_page':
                        value = $(this).val().toLocaleLowerCase();
                        $(this).val(value);
                        break;
                    case 'email':
                        value = $(this).val().toLocaleLowerCase();
                        $(this).val(value);
                        //
                        if (ipageViews.verificaEmail($(this).val()) == false) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }
                        }
                        break;
                    case 'uf':
                        value = $(this).val().toLocaleUpperCase();
                        $(this).val(value);
                        //
                        if (ipageViews.verificaUF($(this).val()) == false) {
                            $(this).addClass("ipage-warning");
                        }else{
                            if ($(this).hasClass('ipage-warning') == true) {
                                $(this).removeClass('ipage-warning');
                            }
                        }
                        break;                        
                    default:
                        value = $(this).val().toLocaleUpperCase();
                        $(this).val(value);
                        break;
                }
            });
        });
    };
    
    this.input_keyup = function() {
        $("form input[type=text]").each(function(index) {
            $(this).on("keyup", function(e) {
                e.preventDefault();
                applyMask(this, e);
            });
        });
    };

    this.input_focus = function() {
        $("form input[type=text]").each(function(index) {
            $(this).on("focus", function(e) {
                e.preventDefault();
                $(this).select();
            });
        });
    };

    function applyMask(obj, e) {
        /**
         * Evita que input text somente leitura sejam capturadas
         **/
        if ($(obj).attr('readonly')) {
            return;
        }
        var ret;
        var data = $(obj).data('mask');
        var custom = "";
        //
        if (typeof(data) !== 'undefined') {
            switch (data) {
                case 'custom':
                    custom = $(obj).data("custom");
                    if(typeof(custom)!="undefined"){
                        ret = $(obj).get(0).value;
                        $(obj).get(0).value = _this.mascara(ret, custom);
                        break;
                    }else{
                        throw Error("Error: data-custom for " + $(obj).attr("id") + ", not defined!");
                    }
                    break;
                case 'date':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.dataBr(ret);
                    break;
                case 'currency':
                    break;
                case 'number':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.soNumeros(ret);
                    break;                
                case 'cep':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.cep(ret);
                    break;
                case 'cnpj':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.cnpj(ret);
                    break;
                case 'cpf':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.cpf(ret);
                    break;
                case 'cel':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.celular(ret);
                    break;
                case 'phone':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.telefone(ret);
                    break;
                case 'uf':
                case 'letter':
                    ret = $(obj).get(0).value;
                    $(obj).get(0).value = _this.soLetras(ret);
                    break;
                default:
                    break;
            }
        }
        return;
    };

    function getAttributes(id){
            var el = document.getElementById(id);
            var data = {};
            var s ="";
            [].forEach.call(el.attributes, function(attr) {
                var camelCaseName = attr.name.substr(5).replace(/-(.)/g, function ($0, $1) {
                    return $1.toUpperCase();
                });
                data[attr.name] = attr.value;
                s += attr.name + '="' + attr.value + '" ';
            });
            console.log(data);
            console.log(s);
    }
    
    this.handleCurrency = function () {     
        accounting.settings = {
            currency: {
                symbol: "$",
                format: "%s%v",
                decimal: ".",
                thousand: ",",
                precision: 2
            },
            number: {
                precision: 2,
                thousand: ",",
                decimal: "."
            }
        };

        $("form input[type=text]").each(function(index) {
            var data = $(this).attr("data-mask");
            if(data=="currency"){
                $(this).maskMoney();
            }

        });
    }
}