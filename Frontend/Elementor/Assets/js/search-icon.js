jQuery(function ($) {
    'use strict';
    $('.primekit-ele-search-icon .primekit-search-icon').click(function() {
        var searchField = $(this).closest('.primekit-search-icon-container').find('.s');
        searchField.toggleClass('active');
        if (searchField.hasClass('active')) {
            searchField.focus();
        }
    });
});