(function ($) {
  "use strict";

  const PrimeKitLibrary = {
      logoURL: primekitAjax.logo_url, // Update to your logo path if needed
      init: function () {
          window.elementor.on('preview:loaded', PrimeKitLibrary.addLibraryButton);
      },
      addLibraryButton: function () {
          const previewIframe = window.elementor.$previewContents;
          const libraryButton = `<div id="primekit-library-btn" class="elementor-add-section-area-button"></div>`;

          // Inject Library Button
          const elementorAddSection = $("#tmpl-elementor-add-section");
          let elementorAddSectionText = elementorAddSection.text();
          elementorAddSectionText = elementorAddSectionText.replace('<div class="elementor-add-section-drag-title', libraryButton + '<div class="elementor-add-section-drag-title');
          elementorAddSection.text(elementorAddSectionText);

          // Open Popup on Click
          previewIframe.on('click', '#primekit-library-btn', function () {
              PrimeKitLibrary.renderPopup(previewIframe);
              PrimeKitLibrary.loadTemplates(previewIframe);
          });
      },
      renderPopup: function (previewIframe) {
          // Render Popup UI
          if (previewIframe.find('.primekit-popup').length === 0) {
              previewIframe.find('body').append(`
                  <div class="primekit-popup-overlay">
                      <div class="primekit-popup">
                          <div class="primekit-popup-header">
                              <div class="primekit-popup-title">PrimeKit Library</div>
                              <div class="primekit-popup-close">×</div>
                          </div>
                          <div class="primekit-popup-content"></div>
                      </div>
                  </div>
              `);
          }

          previewIframe.find('.primekit-popup-overlay').fadeIn();

          // Close Popup
          previewIframe.find('.primekit-popup-close').on('click', function () {
              previewIframe.find('.primekit-popup-overlay').fadeOut();
          });
      },
      loadTemplates: function (previewIframe) {
          // AJAX Call to Fetch Templates
          $.ajax({
              url: primekitAjax.ajax_url,
              method: 'POST',
              data: {
                  action: 'primekit_get_templates',
              },
              success: function (response) {
                  if (response.success) {
                      const templates = response.data;
                      let templateHTML = '';
                      templates.forEach(template => {
                          templateHTML += `
                              <div class="primekit-template-item">
                                  <div class="primekit-template-title">${template.title}</div>
                                  <button data-template-id="${template.id}" class="primekit-insert-template">Insert</button>
                              </div>
                          `;
                      });
                      previewIframe.find('.primekit-popup-content').html(templateHTML);

                      // Add Click Listener for Insertion
                      previewIframe.find('.primekit-insert-template').on('click', function () {
                          const templateId = $(this).data('template-id');
                          PrimeKitLibrary.insertTemplate(templateId);
                      });
                  } else {
                      console.error('Failed to load templates:', response.data.message);
                  }
              },
              error: function (error) {
                  console.error('Error fetching templates:', error);
              },
          });
      },
      insertTemplate: function (templateId) {
        $.ajax({
            url: primekitAjax.ajax_url,
            method: 'POST',
            data: {
                action: 'primekit_get_template_content',
                template_id: templateId,
            },
            success: function (response) {
                if (response.success) {        
                    console.log('Fetched template content:', content);
    
                    // Validate and preprocess content
                    if (content && Array.isArray(content.content)) {
                        $e.run('document/elements/import', { elements: content.content });
                    } else {
                        console.error('Invalid content format:', content);
                    }
                } else {
                    console.error('Failed to fetch template content:', response.data.message);
                }
            },
            error: function (error) {
                console.error('Error fetching template content:', error);
            },
        });
    }
    
  };

  $(window).on('elementor:init', PrimeKitLibrary.init);
})(jQuery);
