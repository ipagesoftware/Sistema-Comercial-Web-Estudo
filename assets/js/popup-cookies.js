$(document).ready(function() {
  let cookieAletamGet = $.cookie('scw');

  setTimeout(function() {
    if (cookieAletamGet == null) {
      $('.popup-ipage').fadeIn('slow');
    }
  }, 10);

  $('#cookie-ipage').click(function () {
    $.cookie("scw", "accept");
    $('.popup-ipage').fadeOut('slow');
  });
 
  $('#closePopupCookies').click(function () {    
    $('.popup').fadeOut('slow');
  });

  $('#cookie-ipage-no').click(function () {
    $.cookie("scw", null);
    $('.popup-ipage').fadeOut('slow');
  });  
});