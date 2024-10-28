jQuery(document).ready(function($) {
  "use strict";
  var showAlways = $('#primekit-back-to-top').hasClass('primekit-backtop-always');
  if (!showAlways) {
      $(window).scroll(function() {
          if ($(this).scrollTop() > 300) {
              $('#primekit-back-to-top').fadeIn(200);
          } else {
              $('#primekit-back-to-top').fadeOut(200);
          }
      });
  } else {
      $('#primekit-back-to-top').show();
  }
  
  $('#primekit-back-to-top').click(function(event) {
      event.preventDefault();
      $('html, body').animate({scrollTop: 0}, 500);
  });
});
