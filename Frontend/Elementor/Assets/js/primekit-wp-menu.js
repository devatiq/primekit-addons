jQuery(function ($) {
  'use strict';

  $(".primekit-responsive-menu").click(function () {
      // Use `next` to target the immediately following `.primekit-mobilemenu` relative to the clicked `.primekit-responsive-menu`
      $(this).next(".primekit-mobilemenu").slideToggle("slow");
  });

  $('.primekit-mobilemenu .menu-item-has-children').append('<span class="sub-toggle"> <i class="eicon-caret-right"></i> </span>');
  
  $('.primekit-mobilemenu').on('click', '.sub-toggle', function () {
      $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
      $(this).children('.eicon-caret-right').first().toggleClass('eicon-caret-down');
  });
});
