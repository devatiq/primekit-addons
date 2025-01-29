"use strict";

(function ($, elementor) {
  const primekitNamespace = {
    /**
     * Adds the custom button to the Elementor editor interface.
     * @param {object} $previewContents - The Elementor editor preview contents.
     */
    addCustomButton: function ($previewContents) {
      const FIND_SELECTOR =
        ".elementor-add-new-section .elementor-add-section-drag-title";

      // Define the button HTML with the SVG icon
      const customButtonHTML = `
                <div class="elementor-add-section-area-button primekit-custom-button">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <style type="text/css">
                            .st0{fill:url(#SVGID_1_);}
                            .st1{fill:#FFFFFF;}
                        </style>
                        <g>
                            <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="4.2174" y1="256" x2="507.7826" y2="256">
                                <stop offset="0" style="stop-color:#0049E7"/>
                                <stop offset="1" style="stop-color:#C835F8"/>
                            </linearGradient>
                            <path class="st0" d="M507.8,256c0,57.4-19.2,110.3-51.6,152.7c-14,18.5-30.6,35-49.2,48.9c-42.1,31.5-94.3,50.2-150.9,50.2
                                c-37,0-72.2-8-103.7-22.3c-22.8-10.3-43.8-23.9-62.4-40.3C37.4,399,4.2,331.4,4.2,256C4.2,116.9,116.9,4.2,256,4.2
                                c57.5,0,110.6,19.3,153,51.8c16.6,12.7,31.7,27.5,44.6,44C487.6,142.9,507.8,197.1,507.8,256z"/>
                            <g>
                                <path class="st1" d="M311.7,179.1c-5.2,60.5-65.8,62.4-65.8,62.4v-44.7c0,0,19.5-8.1,20.1-29.1c0.1-0.9,0.1-1.7,0-2.6v-9.1
                                    c0-21.8-17.6-39.4-39.4-39.4h-61.1v223.3L118.1,301V100.8c0-12.4,10.1-22.5,22.5-22.5h82.2c46.8-1.4,63.5,14.6,63.5,14.6
                                    c28,24.6,27.7,60.4,26.5,73.7C312.3,170.8,312,175,311.7,179.1z"/>
                                <path class="st1" d="M228.9,157.4h-24.2c-12.3,0-22.3,10-22.3,22.3v217.8l54.5-49.3c0,0,11.9-9.8,24.2-5.4c0,0,12.1,2.9,26.1,22.6
                                    c12.7,18,25.3,36.2,38.3,54.1l15,20.8h56.8L294,299.8l103.1-103.3h-59.8l-108.4,115V157.4z"/>
                            </g>
                        </g>
                    </svg>
                </div>
            `;

      // Check if the button is already added
      if (!$previewContents.find(".primekit-custom-button").length) {
        $previewContents.find(FIND_SELECTOR).before(customButtonHTML);
      }

      // Add a click event listener to the button
      $previewContents.on("click", ".primekit-custom-button", function () {
        MicroModal.show("primekit-template-modal");
        primekitNamespace.loadTemplates();
      });
    },

    /**
     * Fetches and loads templates into the modal dynamically.
     */
    loadTemplates: function () {
      $.ajax({
        url: primekitAjax.ajax_url,
        method: "POST",
        data: {
          action: "primekit_get_templates",
        },
        success: function (response) {
          if (response.success) {
            const templates = response.data;
            let templateHTML = "";

            templates.forEach((template) => {
              templateHTML += `
                                <div class="single-primekit-template">
                                    <img src="${template.thumbnail}" alt="${template.title}">
                                    <h3>${template.title}</h3>
                                    <button data-template-id="${template.id}" class="primekit-insert-template">
                                        Insert
                                    </button>
                                </div>
                            `;
            });

            $(".primekit-template-modal-content-area").html(templateHTML);
          }
        },
        error: function () {
          console.error("Failed to load templates");
        },
      });
    },

    /**
     * Handles template insertion logic.
     */
    handleTemplateInsert: function () {
        $(document).on('click', '.primekit-insert-template', function () {
            const templateId = $(this).data('template-id');
        
            console.log(`Inserting template with ID: ${templateId}`);
        
            // Fetch the template content
            $.ajax({
                url: primekitAjax.ajax_url,
                method: 'POST',
                data: {
                    action: 'primekit_get_template_content',
                    template_id: templateId,
                },
                success: function (response) {
                    if (response.success) {
                        const content = response.data.content;
        
                        console.log('Fetched template content:', content);
        
                        // Ensure content is structured correctly for Elementor
                        if (content && typeof content === 'object') {
                            $e.run('document/elements/import', { elements: content.content });
                        } else {
                            console.error('Invalid content format:', content);
                        }
                    } else {
                        console.error('Failed to load template content:', response.data.message);
                    }
                },
                error: function (error) {
                    console.error('Error fetching template content:', error);
                },
            });
        
            MicroModal.close('primekit-template-modal');
        });
        
    },

    /**
     * Initializes the plugin.
     */
    init: function () {
      // Hook into Elementor's preview:loaded event
      elementor.on("preview:loaded", function () {
        const $previewContents = window.elementor.$previewContents;

        // Wait for the editor to fully load
        const interval = setInterval(() => {
          if ($previewContents.find(".elementor-add-new-section").length) {
            clearInterval(interval);
            primekitNamespace.addCustomButton($previewContents);
          }
        }, 100);
      });

      // Handle template insertion
      primekitNamespace.handleTemplateInsert();

      // Initialize Micromodal
      MicroModal.init();
    },
  };

  // Initialize the namespace
  primekitNamespace.init();
})(jQuery, window.elementor);
