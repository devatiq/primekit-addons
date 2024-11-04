jQuery(window).on('elementor/frontend/init', function() {
  'use strict';
  elementorFrontend.hooks.addAction('frontend/element_ready/global', function(scope) {
    jQuery('.primekit-elementor-count-down-area', scope).each(function() {
      var $countDownArea = jQuery(this);
      var countdownData = $countDownArea.data('countdown');
      var primekitcountdownDate;

      if (countdownData) {
        primekitcountdownDate = new Date(countdownData).getTime();
      } else {
        // Set default countdown date to 2 days from now
        var defaultCountdownPeriod = 48 * 60 * 60 * 1000; // 2 days in milliseconds
        primekitcountdownDate = new Date().getTime() + defaultCountdownPeriod;
      }

      var $primekitcounttime = $countDownArea.find('#primekitcounttime');
      var $primekitcountexpired = $countDownArea.find('#primekitcountexpired');

      var updateCountdown = function() {
        var primekitnow = new Date().getTime();
        var primekitdistance = primekitcountdownDate - primekitnow;

        if (primekitdistance < 0) {
          clearInterval(primekitcountInterval);
          $primekitcounttime.hide();
          $primekitcountexpired.show();
          return;
        }

        $primekitcounttime.find(".primekit-count-num-days").text(Math.floor(primekitdistance / (1000 * 60 * 60 * 24)));
        $primekitcounttime.find(".primekit-count-num-hours").text(Math.floor((primekitdistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
        $primekitcounttime.find(".primekit-count-num-minutes").text(Math.floor((primekitdistance % (1000 * 60 * 60)) / (1000 * 60)));
        $primekitcounttime.find(".primekit-count-num-seconds").text(Math.floor((primekitdistance % (1000 * 60)) / 1000));
      };

      updateCountdown();
      var primekitcountInterval = setInterval(updateCountdown, 1000);
    });
  });
});
