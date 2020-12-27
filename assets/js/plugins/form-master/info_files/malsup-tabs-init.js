var malsup = malsup || {};

(function($) {

malsup.initializeTabs = function(subtabParent, subtabFirst, subtabRegex) {

    var ignoreTabSelect = false;
    
    $('#tabs,#sub-tabs').tabs({
        select: function(e, ui) {
            if (ignoreTabSelect) return;
            var tabId = $(ui.panel).attr('data-tabid');
            if (tabId == subtabParent) {
                var $subTabs = $('#sub-tabs');
                var selected = $subTabs.tabs('option', 'selected');
                tabId = $subTabs.find('> div:eq('+selected+')').attr('data-tabid');
            }
            location.hash = tabId;
        }
    }).removeClass('ui-corner-all');

    // sub-tabs (examples tab)
    $('#sub-tabs ul.ui-tabs-nav').removeClass('ui-corner-all').addClass('ui-corner-top');

    // select initial tab based on location hash value
    var lastHash = location.hash;
    loadTab(lastHash);
    
    function loadTab(tabId) {
        if (!tabId) 
        	tabId = '#' + $('#tabs > div:eq(0)').attr('data-tabid');
        var $tabs = $('#tabs'), $subTabs = $('#sub-tabs');
        var $el, index, id = tabId.substring(1);
        var subId = subtabRegex.exec(id);
        
        if (subId)
            id = subtabParent;
        else if (id == subtabParent) {
            ignoreTabSelect = true;
            subId = [subtabFirst];
        }

        if (subId) {
            $el = $subTabs.find(' > div[data-tabid='+subId[0]+']');
            if ($el.length) {
                index = $subTabs.find('> div').index($el);
                $subTabs.tabs('select', index);
                ignoreTabSelect = false;
            }
        }
        
        $el = $tabs.find(' > div[data-tabid='+id+']');
        if ($el.length) {
            index = $tabs.find('> div').index($el);
            if (subId)
                ignoreTabSelect = true;
            $tabs.tabs('select', index);
        }
        ignoreTabSelect = false;
    }
    
    setInterval(checkHash, 200);
    
    function checkHash() {
        if (lastHash == location.hash) return;
        lastHash = location.hash;
        if (ignoreTabSelect) return;
        loadTab(lastHash);
    }
    
};

})(jQuery);
