/**
 *
 * @version    1.0
 * @package    assets
 * @subpackage time date
 * @author     Diógenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2021 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 * @modify     Diógenes Dias <diogenesdias@hotmail.com>, 22 Mar 2019
 */
function timedateClass(myobj) {
    this.myobj = myobj;
    this.init = function() {
        saudacoes();
    };

    function saudacoes() {
        var date = new Date();        
        var dianumsem = date.getDay() + 1;
        var mesnum = date.getMonth() + 1;
        var diames = date.getDate();
        var ano = date.getYear();
        var diasem;
        var mes;
      
        switch(dianumsem){
          case 1:
            diasem = "Domingo";
            break;
        case 2:
            diasem = "Segunda";
            break;
        case 3:
            diasem = "Terça";
            break;
        case 4:
            diasem = "Quarta";
            break;
        case 5:
            diasem = "Quinta";
            break;
        case 6:
            diasem = "Sexta";
            break;
        case 7:
            diasem = "Sábado";
            break;
        }
        //
        switch(mesnum){
          case 1:
              mes = "Janeiro";
              break;
          case 2:
              mes = "Fevereiro";
              break;
          case 3:
              mes = "Março";
              break;
          case 4:
              mes = "Abril";
              break;
          case 5:
              mes = "Maio";
              break;
          case 6:
              mes = "Junho";
              break;
          case 7:
              mes = "Julho";
              break;
          case 8:
              mes = "Agosto";
              break;
          case 9:
              mes = "Setembro";
              break;
          case 10:
              mes = "Outubro";
              break;
          case 11:
              mes = "Novembro";
              break;
          case 12:
              mes = "Dezembro";
              break;
        }

        if (ano < 2000) {
            ano = 1900 + ano;
        }
        //
        var horas = date.getHours();
        if (horas < 10) {
            horas = "0" + horas;
        }
        var minutos = date.getMinutes();
        if (minutos < 10) {
            minutos = "0" + minutos;
        }

        if (diames < 10) {
            diames = "0" + diames;
        }

        var semana = diasem;
        //var semana = ("Recife PE, " + diasem);
        var hoje = (diames + " de " + mes + " de " + ano);
        //var time = (horas + ":" + minutos + " hrs");
        var ret = '';
        var workdamnyou = new Date();
        var hour = workdamnyou.getHours();

        switch(hour){
          case 1:
          case 2:
          case 3:
          case 4:
          case 5:
          case 6:
          case 7:
          case 8:
          case 9:
          case 10:
          case 11:
              ret = "Bom Dia! ";
              break;
          case 12:
          case 13:
          case 14:
          case 15:
          case 16:
          case 17:
          case 18:
              ret = "Boa Tarde! ";
              break;
          default:
              ret = "Boa Noite! ";
              break;
        }

        ret = '&nbsp;' + ret + semana + ' - ' + hoje + ' - ' + _showTime();
        //    
        if (myobj === undefined) {
            $("#mydate").html(ret);
        } else {
            //document.getElementById(myobj).innerHTML = ret;
            $(myobj).html(ret);
        }
       setTimeout(function() {
            saudacoes();
        }, 1000);
    }
    this.showDate = function() {
    var date = new Date();
    var dia = (date.getDay() + 1);
    var mes = (date.getMonth() + 1);
    var diames = date.getDate();
    var ano = date.getYear();
    if (ano < 2000) {
        ano = 1900 + ano;
    }
    if (dia < 10) {
        dia = '0' + dia;
    }
    if (diames < 10) {
        diames = '0' + diames;
    }
    if (mes < 10) {
        mes = '0' + mes;
    }
        var hoje = (diames + "/" + mes + "/" + ano);
        return hoje;
    };
    this.currentYear = function() {
        var date = new Date();
        var ano = date.getYear();
        if (ano < 2000) {
            ano = 1900 + ano;
        }
        return ano;
    };
    this.currentMonth = function() {
        var date = new Date();
        var mes = (date.getMonth() + 1);
        if (mes < 10) {
            mes = '0' + mes;
        }
        return mes;
    };
    this.currentDay = function() {
        var date = new Date();
        var dia = date.getDate();
        if (dia < 10) {
            dia = '0' + dia;
        }
        return dia;
    };

    function _showTime(reduzido) {
        var thetime = new Date();
        var nhours = thetime.getHours();
        var nmins = thetime.getMinutes();
        var nsecn = thetime.getSeconds();
        var AorP = " ";
        var ret = '';
        if (nhours >= 12) {
            AorP = '';
            nhours = nhours + 12;
        } else {
            AorP = '';
        }
        if (nhours >= 13) {
            nhours -= 12;
        }
        if (nhours === 0) {
            nhours = 12;
        }
        if (nhours < 10) {
            nhours = "0" + nhours;
        }
        if (nsecn < 10) {
            nsecn = "0" + nsecn;
        }
        if (nmins < 10) {
            nmins = "0" + nmins;
        }
        if (reduzido === undefined) {
            ret = nhours + ":" + nmins + ":" + nsecn + " " + AorP;
        } else {
            ret = nhours + ":" + nmins;
        }
        return ret;
    }
    this.showTime = function(reduzido) {
        var thetime = new Date();
        var nhours = thetime.getHours();
        var nmins = thetime.getMinutes();
        var nsecn = thetime.getSeconds();
        var AorP = " ";
        var ret = '';
        if (nhours >= 12) {
            AorP = '';
            nhours = nhours + 12;
        } else {
            AorP = '';
        }
        if (nhours >= 13) {
            nhours -= 12;
        }
        if (nhours === 0) {
            nhours = 12;
        }
        if (nhours < 10) {
            nhours = "0" + nhours;
        }
        if (nsecn < 10) {
            nsecn = "0" + nsecn;
        }
        if (nmins < 10) {
            nmins = "0" + nmins;
        }
        if (reduzido === undefined) {
            ret = nhours + ":" + nmins + ":" + nsecn + " " + AorP;
        } else {
            ret = nhours + ":" + nmins;
        }
        return ret;
    };
    this.dateDiff = function(strDate1, strDate2) {
        return (((Date.parse(strDate2)) - (Date.parse(strDate1))) / (24 * 60 * 60 * 1000)).toFixed(0);
    };
}