jQuery(function ($) {
    'use strict';

    //Skill bar
    var ourskill = $('.primekit-ele-skill-bar-area');
    ourskill.appear({ force_process: true });
  
    $('.primekit-ele-progress-bar > span').each(function () {
      var $this = $(this);
      var width = $(this).data('percent');
      $this.css({
        'transition': 'width 3s'
      });
      ourskill.on('appear', function () {
        setTimeout(function () {
          $this.css('width', width + '%');
        }, 500);
      });
    }); 

});