(function ($, elementor) {
  "use strict";
  window.primekitNamespace = {
    loadTemplates() {
      const modalContent = document.getElementById("modal-1-content");
      if (!modalContent) {
        console.error("Modal content element not found.");
        return;
      }

      modalContent.innerHTML = "<p>Loading templates...</p>"; // Display loading message

      // Fetch templates using WordPress site URL
      const siteUrl = window.location.origin;
      //fetch(`${siteUrl}/wp-content/plugins/primekit-addons/Admin/Inc/Templates/data/templates-info.json`)
      fetch(`https://demo.primekitaddons.com/wp-json/primekit/v1/templates`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to fetch templates.");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Templates loaded:", data);

          // Render the templates in the modal
          if (data && data.length > 0) {
            let templateHTML = "";
            data.forEach((template) => {
              templateHTML += `
                                <div class="primekit-template">
                                    <img src="${template.thumbnail}" alt="${template.title}">
                                    <div class="primekit-template-content">
                                  
                                    <h3>${template.title}</h3>
                                    <button class="primekit-template-insert" data-template-id="${template.id}">
                                        Insert
                                    </button>
                                    </div>
                                </div>
                            `;
            });

            modalContent.innerHTML = templateHTML; // Update the modal with templates
          } else {
            modalContent.innerHTML = "<p>No templates found.</p>";
          }
        })
        .catch((error) => {
          console.error("Error loading templates:", error);
          modalContent.innerHTML = `<p>Failed to load templates. Please try again later.</p>`;
        });
    },

    showModal() {
      const modalElement = document.getElementById("primekit-template-modal");
      if (!modalElement) {
        console.error("Modal element not found.");
        return;
      }

      // Load templates when the modal is opened
      this.loadTemplates();

      MicroModal.show("primekit-template-modal");
    },

    insertTemplate(templateId) {
      console.log(`Inserting template with ID: ${templateId}`);

      // Fetch template content using WordPress site URL
      const siteUrl = window.location.origin;
      //fetch(`${siteUrl}/wp-content/plugins/primekit-addons/Admin/Inc/Templates/data/templates/${templateId}.json`)
      fetch(`https://cors-anywhere.herokuapp.com/https://demo.primekitaddons.com/PrimeKitTemplates/Templates/v1/${templateId}.json`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to fetch template data.");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Template content loaded:", data);

          if (!data || !data.content || !Array.isArray(data.content)) {
            throw new Error("Invalid template data structure");
          }

          // Transform JSON to Elementor compatible structure
          const transformedContent = this.transformElementorContent(data.content);

          if (!transformedContent || !Array.isArray(transformedContent)) {
            throw new Error("Failed to transform template content");
          }

          try {
            $e.run("document/elements/import", {
              model: elementor.elementsModel,
              data: {
                content: transformedContent
              }
            });
            console.log("Template inserted successfully.");
            MicroModal.close("primekit-template-modal");
          } catch (error) {
            console.error("Error inserting template:", error);
            alert("Failed to insert the template: " + error.message);
          }
        })
        .catch((error) => {
          console.error("Error processing template:", error);
          alert(error.message || "Failed to process the template.");
        });
    },

    transformElementorContent(content) {
      if (!content || !Array.isArray(content)) {
        console.error("Invalid content structure for Elementor.");
        return null;
      }

      try {
        return content.map(element => this.transformElement(element));
      } catch (error) {
        console.error("Error transforming content:", error);
        return null;
      }
    },

    transformElement(element) {
      if (!element || typeof element !== 'object') {
        throw new Error('Invalid element structure');
      }

      const transformedElement = {
        id: element.id || elementor.helpers.getUniqueID(),
        elType: element.elType || 'section',
        settings: element.settings || {},
        elements: []
      };

      if (element.widgetType) {
        transformedElement.widgetType = element.widgetType;
      }

      if (Array.isArray(element.elements)) {
        transformedElement.elements = element.elements.map(child => this.transformElement(child));
      }

      return transformedElement;
    },
  };


})(window.jQuery, window.elementor);