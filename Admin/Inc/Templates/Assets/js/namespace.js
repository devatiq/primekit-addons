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
  
      // Fetch templates using AJAX request to WordPress
      $.ajax({
        url: primekit_ajax.ajaxurl, // Ensure the correct URL
        type: "POST",
        data: {
            action: "get_primekit_library_data", // Must match the PHP function
            security: primekit_ajax.security,
        },
        success: function (response) {
            console.log("API Response:", response); // 🔍 Debug: Log the API response
    
            if (!response || !response.success || !response.data.templates) {
                console.error("No templates found in response:", response);
                modalContent.innerHTML = "<p>No templates found.</p>";
                return;
            }
    
            let templateHTML = "";
            response.data.templates.forEach((template) => {
                templateHTML += `
                    <div class="primekit-template">
                        <img src="${template.thumbnail}" alt="${template.title}">
                        <h3>${template.title}</h3>
                        <button class="primekit-template-insert" data-template-id="${template.id}">
                            Insert
                        </button>
                    </div>
                `;
            });
    
            modalContent.innerHTML = templateHTML;
        },
        error: function (xhr, status, error) {
            console.error("Error loading templates:", error);
            modalContent.innerHTML = `<p>Failed to load templates. Please try again later.</p>`;
        }
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
  
      // Use API_TEMPLATE_DATA_URL instead of a local file path
      const templateUrl = `https://demo.primekitaddons.com/PrimeKitTemplates/Templates/v1/${templateId}.json`;
  
      fetch(templateUrl)
          .then((response) => {
              if (!response.ok) {
                  throw new Error(`Failed to fetch template data. HTTP Status: ${response.status}`);
              }
              return response.text(); // Read response as text first
          })
          .then((text) => {
              try {
                  const data = JSON.parse(text); // Try parsing JSON
                  console.log("Template content loaded:", data);
  
                  if (!data || !data.content || !Array.isArray(data.content)) {
                      throw new Error("Invalid template data structure");
                  }
  
                  // Transform JSON to Elementor-compatible structure
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
              } catch (jsonError) {
                  console.error("Invalid JSON response:", text);
                  alert("Server returned invalid JSON. Check console for details.");
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