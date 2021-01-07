<?php
/**
 * PHP Pagination Class
 * @author admin@catchmyfame.com - http://www.catchmyfame.com
 * @version 3.0.0
 * @date February 6, 2014
 * @copyright (c) admin@catchmyfame.com (www.catchmyfame.com)
 * @license CC Attribution-ShareAlike 3.0 Unported (CC BY-SA 3.0) - http://creativecommons.org/licenses/by-sa/3.0/
 */
namespace App\Paginacao;
class Paginator
{
    public $current_page;
    public $items_per_page;
    public $limit_end;
    public $limit_start;
    public $num_pages;
    public $total_items;
    protected $ipp_array;
    protected $limit;
    protected $mid_range;
    protected $querystring;
    protected $return;
    protected $get_ipp;
    protected $pagina_atual;
    protected $all;

    /**
     * [__construct description]
     * @param integer $total     [description]
     * @param integer $mid_range [description]
     * @param array   $ipp_array [description]
     */
    public function __construct($total = 0, $mid_range = 7, $ipp_array = PAGINATION)
    {
        $this->all = PAGINATION[sizeof(PAGINATION)-1];
        $tmp = explode("/", str_replace("index.php", null, $_SERVER['PHP_SELF']));
        $tmp = array_filter($tmp);
        $tmp = $tmp[sizeof($tmp)] . "/";

        $this->pagina_atual = $tmp;
        $this->total_items = (int) $total;
        //
        if ($this->total_items <= 0) {
            exit("Incapaz de paginar: valor total inválido (deve ser um número inteiro > 0)");
        }
        // A faixa média deve ser um int ímpar> = 1
        $this->mid_range = (int) $mid_range;
        //
        if ($this->mid_range % 2 == 0 or $this->mid_range < 1) {
            exit("Incapaz de paginar: valor mid_range inválido (deve ser um número inteiro ímpar> = 1)");
        }
        //
        if (!is_array($ipp_array)) {
            exit("Incapaz de paginar: valor ipp_array inválido");
        }
        //
        $this->ipp_array      = $ipp_array;
        $this->items_per_page = (isset($_GET["ipp"])) ? $_GET["ipp"] : $this->ipp_array[0];
        $this->default_ipp    = $this->ipp_array[0];
        //
        if ($this->items_per_page == $this->all) {
            $this->num_pages = 1;
        } else {
            if (!is_numeric($this->items_per_page) or $this->items_per_page <= 0) {
                $this->items_per_page = $this->ipp_array[0];
            }
            //
            $this->num_pages = ceil($this->total_items / $this->items_per_page);
        }
        //
        // deve ser numérico> 0
        $this->current_page = (isset($_GET["page"])) ? (int) $_GET["page"] : 1;
        //
        if ($_GET) {
            $args = explode("&", $_SERVER["QUERY_STRING"]);            
            foreach ($args as $arg) {
                if($arg !="=/"){
                    $keyval = explode("=", $arg);
                    if ($keyval[0] != "page" and $keyval[0] != "ipp") {
                        $this->querystring .= "&" . $arg;
                    }
                }
            }
        }
        //
        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if ($key != "page" and $key != "ipp") {
                    $this->querystring .= "&$key=$val";
                }

            }
        }

        if ($this->num_pages > 10) {
            $this->return      = ($this->current_page > 1 and $this->total_items >= 10) ? "<a class=\"paginate\" href=\"$this->pagina_atual?page=" . ($this->current_page - 1) . "&ipp=$this->items_per_page $this->querystring\">Anterior</a> " : "<span class=\"inactive\">Anterior</span> ";
            $this->start_range = $this->current_page - floor($this->mid_range / 2);
            $this->end_range   = $this->current_page + floor($this->mid_range / 2);
            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->num_pages) {
                $this->start_range -= $this->end_range - $this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range, $this->end_range);
            for ($i = 1; $i <= $this->num_pages; $i++) {
                if ($this->range[0] > 2 and $i == $this->range[0]) {
                    $this->return .= " ... ";
                }

                // loop through all pages. if first, last, or in range, display
                if ($i == 1 or $i == $this->num_pages or in_array($i, $this->range)) {
                    $this->return .= ($i == $this->current_page and $this->items_per_page != $this->all) ? "<a title=\"Página $i de $this->num_pages\" class=\"current\" >$i</a> \n" : "<a class=\"paginate\" title=\"Página $i de $this->num_pages\" href=\"$this->pagina_atual?page=$i&ipp=$this->items_per_page $this->querystring\">$i</a> \n";
                }

                if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 and $i == $this->range[$this->mid_range - 1]) {
                    $this->return .= " ... ";
                }

            }
            $this->return .= (($this->current_page < $this->num_pages and $this->total_items >= 10) and ($this->items_per_page != $this->all) and $this->current_page > 0) ? "<a class=\"paginate\" href=\"$this->pagina_atual?page=" . ($this->current_page + 1) . "&ipp=$this->items_per_page $this->querystring\">Próximo</a>\n" : "<span class=\"inactive\">Próximo</span>\n";
            $this->return .= ($this->items_per_page == $this->all) ? "<a class=\"current\" style=\"margin-left:10px\" >{$this->all}</a> \n" : "<a class=\"paginate\" style=\"margin-left:10px\" href=\"$this->pagina_atual?page=1&ipp={$this->all}{$this->querystring}\">{$this->all}</a> \n";
        } else {
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $this->return .= ($i == $this->current_page) ? "<a class=\"current\" >$i</a> " : "<a class=\"paginate\" href=\"$this->pagina_atual?page=$i&ipp=$this->items_per_page $this->querystring\">$i</a> ";
            }
            $this->return .= "<a class=\"paginate\" href=\"$this->pagina_atual?page=1&ipp={$this->all}{$this->querystring}\">{$this->all}</a> \n";
        }
        $this->return = str_replace("&", "&amp;", $this->return);

        // Todos os registros
        if (!is_numeric($this->items_per_page)) {
            //
            // Mostra apenas mil registros
            // se a última opção do array PAGINATION foi selecionada
            //
            if ($total > 1000) {
                $total = 1000;
            }

            $this->items_per_page = $total;
        }

        $this->limit_start = ($this->current_page <= 0) ? 0 : ($this->current_page - 1) * $this->items_per_page;
        if ($this->current_page <= 0) {
            $this->items_per_page = 0;
        }

        $this->limit_end = ($this->items_per_page == $this->all) ? (int) $this->total_items : (int) $this->items_per_page;
    }

    /**
     * [display_items_per_page description]
     * @return [type] [description]
     */
    public function display_items_per_page()
    {        
        $items = null;
        natsort($this->ipp_array); // This sorts the drop down menu options array in numeric order (with 'all' last after the default value is picked up from the first slot
        foreach ($this->ipp_array as $ipp_opt) {
            if(!(int)$ipp_opt){
                $items .= ($this->total_items == $this->items_per_page) ? "<option selected=\"\" value=\"{$ipp_opt}\">{$ipp_opt}</option>\n" : "<option value=\"{$ipp_opt}\">{$ipp_opt}</option>\n";
            }else{
                $items .= ($ipp_opt == $this->items_per_page) ? "<option selected=\"\" value=\"{$ipp_opt}\">{$ipp_opt}</option>\n" : "<option value=\"{$ipp_opt}\">{$ipp_opt}</option>\n";
            }
        }

        return "<span >Reg. por pág.: </span><select class=\"cbo-paginate\" onchange=\"window.location='{$this->pagina_atual}?page=1&amp;ipp='+this[this.selectedIndex].value+'{$this->querystring}';return false\">$items</select>\n";
    }
    /**
     * [display_jump_menu description]
     * @return [type] [description]
     */
    public function display_jump_menu()
    {
        $option = null;
        for ($i = 1; $i <= $this->num_pages; $i++) {
            $opt1 = "<option value=\"$i\" selected>$i</option>\n";
            $opt2 = "<option value=\"$i\">$i</option>\n";
            //
            $option .= ($i == $this->current_page) ? $opt1 : $opt2;
        }
        //        
        return "<span>Pág.: </span><select class=\"cbo-paginate\" onchange=\"window.location='$this->pagina_atual?page='+this[this.selectedIndex].value+'&amp;ipp=$this->items_per_page $this->querystring';return false\">$option</select>\n";
    }
    /**
     *************************************************************************
     */
    public function display_pages()
    {
        return $this->return;
    }
}
