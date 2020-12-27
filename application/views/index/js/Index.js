/*
 ************************************************************
 */
$(document).ready(function() {
    Index.init();
});
/*
 ************************************************************
 */
var Index = function () {
    return{
        init: function (par) {
            if (typeof(par) === 'undefined') {
                par = {};
            }
            IpageApp.wait(false);
            var dateTime = new timedateClass();
            dateTime.init();
        },
        sessionExpired: function(){
            setTimeout(function(){
                var link = $("body").data("url");
                window.location.href = link;
            }, 10000);
        }
    }
    /*
     ************************************************************
     
    function mnu_click(_value) {
        if (typeof(_value) === "undefined") {
            _value = "mnu";
        }
        $("#" + _value + "_sair").click(function() {
        alert("OK")
            window.parent.location.href = 'index.php';
        });
    }
    */
}();