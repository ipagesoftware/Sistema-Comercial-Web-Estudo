<?php
/**
 *
 * @version    1.0
 * @package    Sistema
 * @subpackage funÁıes genÈricas
 * @author     DiÛgenes Dias <diogenesdias@hotmail.com>
 * @copyright  Copyright (c) 1995-2019 Ipage Software Ltd. (https://www.ipage.com.br)
 * @license    https://www.ipagesoftware.com.br/license_key/www/examples/license/
 */

if (!function_exists('ucwords_improved')) {
    /**
     * Converte para mai˙scula o nome e o sobrenome do associado
     */
    function ucwords_improved($s, $e = array())
    {
        return join(' ',
            array_map(
                create_function(
                    '$s',
                    'return (!in_array($s, ' . var_export($e, true) . ')) ? ucfirst($s) : $s;'
                ),
                explode(
                    ' ',
                    strtolower($s)
                )
            )
        );
    }
}

if (!function_exists('replaceAllX')) {
    /**
     * [replaceAllX description]
     * @param  [type] $str     [description]
     * @param  [type] $search  [description]
     * @param  [type] $replace [description]
     * @return [type]          [description]
     */
    function replaceAllX( $str, $search, $replace )
    {
      return trim(str_ireplace( $search, $replace, $str));
    }
}

if (!function_exists('fullTrimX')) {
    /**
     * [fullTrimX description]
     * @param  [type]  $str     [description]
     * @param  integer $toupper [description]
     * @return [type]           [description]
     */
    function fullTrimX($str, $toupper = 1)
    {
        if ($toupper == 1) {
            return utf8_encode(addslashes(strip_tags(strtoupper(trim($str)))));
        } else {
            return utf8_encode(addslashes(strip_tags(trim($str))));
        }
    }
}

if (!function_exists('getGUID')) {
    /**
     * [getGUID description]
     * @param  integer $num_letras [description]
     * @return [type]              [description]
     */
    function getGUID($num_letras = 10)
    {
        return substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvYyXxWwZz123456789"), 0, $num_letras);
    }
}

if (!function_exists('right')) {
    /**
     * [right description]
     * @param  [type] $value [description]
     * @param  [type] $count [description]
     * @return [type]        [description]
     */
    function right($value, $count)
    {
        return substr($value, ($count * -1));
    }
}

if (!function_exists('left')) {
    /**
     * [left description]
     * @param  [type] $string [description]
     * @param  [type] $count  [description]
     * @return [type]         [description]
     */
    function left($string, $count)
    {
        return substr($string, 0, $count);
    }
}

if (!function_exists('date2mysql')) {
    /**
     * [date2mysql description]
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    function date2mysql($data)
    {
        if (strlen($data) <= 0) {
            $data = Date("d/m/Y");
        } elseif (!isset($data)) {
            $data = Date("d/m/Y");
        }
        //recebe o par‚metro e armazena em um array separado por -
        $data = explode('/', $data);
        //armazena na variavel data os valores do vetor data e concatena /
        $data = $data[2] . '-' . $data[1] . '-' . $data[0];
        //retorna a string da ordem correta, formatada
        return $data;
    }
}

if (!function_exists('validEmail')) {
    /**
     * [validEmail description]
     * @param  [type] $email [description]
     * @return [type]        [description]
     */
    function validEmail($email)
    {
        if (strlen($email) == 0) {
            return true;
        }

        $conta    = "^[a-zA-Z0-9\._-]+@";
        $domino   = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$";

        $pattern = $conta . $domino . $extensao;

        if (preg_match("/" . $pattern . "/", $email)) {
            return true;
        } else {
            return false;
        }

    }
}

if (!function_exists('retiraAcentos')) {
    /***
     * FunÁ„o para remover acentos de uma string
     *
     * @autor Thiago Belem <contato@thiagobelem.net>
     */
    function retiraAcentos($string, $slug = false)
    {
        $string = strtolower($string);
        // CÛdigo ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // CÛdigo ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item as $codigo) {
                $acentos .= chr($codigo);
            }

            $troca[$key] = '/[' . $acentos . ']/i';
        }

        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Slug?
        if ($slug) {
            // Troca tudo que n„o for letra ou n˙mero por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }

        $string = strtoupper($string);
        return $string;
    }
}
//
if (!function_exists('getSecureKey')) {
    /**
     * [getSecureKey description]
     * @return [type] [description]
     */
    function getSecureKey()
    {
        return md5(uniqid(rand(), true));
    }
}

if (!function_exists('isDate')) {
    /**
     * [isDate description]
     * @param  [type]  $par [description]
     * @return boolean      [description]
     */
    function isDate($par)
    {
        $char       = strpos($par, "/") !== false ? "/" : "-";
        $date_array = explode($char, $par);
        if (count($date_array) != 3) {
            return 0;
        }

        //return checkdate($date_array[1],$date_array[2],$date_array[0]) ? -1 : 0;
        return checkdate($date_array[1], $date_array[0], $date_array[2]) ? ($date_array[2] . "-" . $date_array[1] . "-" . $date_array[0]) : false;
    }

}
if (!function_exists('mask')) {
    /**
     ***********************************************************************
    $cnpj = "11222333000199";
    $cpf = "00100200300";
    $cep = "08665110";
    $data = "10102010"
    echo mask($cnpj,'##.###.###/####-##');
    echo mask($cpf,'###.###.###-##');
    echo mask($cep,'#####-###');
    echo mask($data,'##/##/####');
     *
     */
    function mask($val, $mask)
    {
        $maskared = '';
        $k        = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }

            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }

            }
        }
        return $maskared;
    }
}

if (!function_exists('encrypt')) {
    /**
     * Encrypt password
     *
     * @param string $passwd String to encrypt
     */
    function encrypt($passwd)
    {
        return md5(COOKIE_KEY . $passwd);
    }
}

if (!function_exists('formata_data_extenso')) {
    /**
     * Esta funÁ„o retorna uma data escrita da seguinte maneira:
     * Exemplo: TerÁa-feira, 17 de Abril de 2007
     * @author Leandro Vieira Pinho [http://leandro.w3invent.com.br]
     * @param string $strDate data a ser analizada; por exemplo: 2007-04-17 15:10:59
     * @return string
     */
    function formata_data_extenso($strDate)
    {
        // Array com os dia da semana em portuguÍs;
        $arrDaysOfWeek = array(
            'Domingo',
            'Segunda-feira',
            'TerÁa-feira',
            'Quarta-feira',
            'Quinta-feira',
            'Sexta-feira',
            'S·bado',
        );
        // Array com os meses do ano em portuguÍs;
        $arrMonthsOfYear = array(
            1 => 'Janeiro',
            'Fevereiro',
            'MarÁo',
            'Abril',
            'Maio',
            'Junho',
            'Julho',
            'Agosto',
            'Setembro',
            'Outubro',
            'Novembro',
            'Dezembro',
        );
        // Descobre o dia da semana
        $intDayOfWeek = date('w', strtotime($strDate));
        // Descobre o dia do mÍs
        $intDayOfMonth = date('d', strtotime($strDate));
        // Descobre o mÍs
        $intMonthOfYear = date('n', strtotime($strDate));
        // Descobre o ano
        $intYear = date('Y', strtotime($strDate));
        // Formato a ser retornado
        return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear . ' ' . date('H:i');
    }
}

if (!function_exists('fulltrim')) {
    /**
     * [fulltrim description]
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    function fulltrim($str)
    {
        return trim(preg_replace('/\s+/', ' ', $str));
    }
}

if(!function_exists('stringFormat')){
    function stringFormat($value, $criterio, $utf8)
    {   
        $retorno = $value;
        //
        if($utf8){
            $retorno = utf8_decode($retorno);
        }

        if($criterio){
            $retorno = pintaTextoConsulta($retorno, $criterio);
        }

        return properCase($retorno);
    }
}

if (!function_exists('pintaTextoConsulta')) {
    function pintaTextoConsulta($texto, $criterio)
    {
        if ($criterio == '%') {
            return $texto;
        }
        //
        $tmp = str_ireplace('%', '', $criterio);
        $ret = str_ireplace($tmp, '<span style="background:#ff00ff;color:#fff;">' . $tmp . '</span>', $texto);
        //
        return $ret;
    }
}

if (!function_exists('apenasLetras')) {
    function apenasLetras($str = '')
    {
        $letra = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ√’—¡…Õ”⁄¿»Ã“Ÿ¬ Œ‘€„ıÒ·ÈÌÛ˙‡ËÏÚ˘‚ÍÓÙ˚. ';
        $tmp;
        //
        if (strlen($str) == 0) {
            return 0;
        }
        //
        $str = strtoupper($str);
        //
        for ($i = 0; $i < strlen($str); $i++) {
            //
            $tmp = substr($str, $i, 1);
            $pos = strrpos($letra, $tmp);
            //
            if ($pos === false) {
                return 0;
                break;
            }
        }
        return 1;
    }
}

if (!function_exists('getGUID')) {
    function getGUID($num_letras = 10)
    {
        return substr(str_shuffle("AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvYyXxWwZz123456789"), 0, $num_letras);
    }
}

if (!function_exists('returnFileNameReport')) {
    /**
     * [returnFileNameReport description]
     * @return [type] [description]
     */
    function returnFileNameReport($value)
    {
        /**
         * FORMATO DO NOME DO ARQUIVO GERADO
         *                     cliente_resumido_32671_2015_09_29_22_21_32.pdf
         *                     --------+------- --+-- ---+------ ---+----
         *                             |          |      |          |
         * NOME DO ARQUIVO <-----------+          |      |          +-----> HORA EM QUE O ARQUIVO FOI GERADO
         * ID ALEAT”RIO    <----------------------+      +----------------> DATA FORMATO AMERICANO ANO-M S-DIA
         *
         */
        //
        $current_date = getGUID(5) . '_' . date("Y-m-d H:i:s");
        //
        $dt = str_replace("-", "_", $current_date);
        $dt = str_replace(":", "_", $dt);
        $dt = str_replace(" ", "_", $dt);
        $dt = str_replace("/", "_", $dt);
        //
        return $value . '_' . $dt . '.pdf';
    }
}
if (!function_exists('properCase')) {
    /**
     *properCase()
     *
     * Converte uma texto para formato nome prÛprio
     *
     * @param mixed $str
     * @return
     */
    function properCase($str)
    {
        $ret   = null;
        $resto = trim(mb_strtolower($str, 'ISO-8859-1')) . " ";
        //
        $i = 0; // PROTE«√O LOOP INFINITO
        while ($resto !== " ") {
            $pos   = strpos($resto, " ") + 1;
            $parte = substr($resto, 0, $pos);
            //
            switch (strtolower(trim($parte))) {
                case 's/a':
                case 'ltda':
                    $parte = strtoupper($parte);
                    break;
            }

            if (trim($parte) !== "e"
                and trim($parte) !== "a"
                and trim($parte) !== "do"
                and trim($parte) !== "dos"
                and trim($parte) !== "da"
                and trim($parte) !== "das"
                and trim($parte) !== "ou"
                and trim($parte) !== "de") {
                $parte = mb_strtoupper(substr($parte, 0, 1), 'ISO-8859-1') . substr($parte, 1);
            }
            //
            $ret .= $parte;
            $resto = trim(substr($resto, $pos)) . " ";
            $i++;if ($i > 1000) {
                die('Error!!!!!');
            }

        }
        //
        return trim($ret);
    }
}
