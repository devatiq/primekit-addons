(function ($, elementor) {
  "use strict";
  $(document).ready(function() {
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
          url: primekit_ajax.ajaxurl,
          type: "POST",
          data: {
              action: "get_primekit_library_data",
              security: primekit_ajax.security,
              fetch_remote: true // Add parameter to fetch from remote server
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
                      <div class=\"primekit-template\">
                          <img src=\"${template.thumbnail}\" alt=\"${template.title}\">
                          <h3>${template.title}</h3>
                          <button class=\"primekit-template-insert\" data-template-id=\"${template.id}\">
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
        if (!templateId) {
          console.error('Template ID is required');
          alert('Invalid template ID');
          return;
        }
  
        console.log(`Inserting template with ID: ${templateId}`);
  
        // Use WordPress admin-ajax.php to fetch template data
        $.ajax({
            url: primekit_ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'primekit_get_template_content',
                template_id: templateId,
                security: primekit_ajax.security
            },
            success: (response) => {
                if (!response || !response.success) {
                    const errorMessage = response?.data?.message || 'Failed to fetch template data';
                    console.error('Template fetch error:', errorMessage);
                    alert(errorMessage);
                    return;
                }
  
                const templateContent = response.data.content || [];
  
                if (!Array.isArray(templateContent)) {
                    console.error('Invalid template content format:', templateContent);
                    alert('Template content is not in the expected format');
                    return;
                }
  
                try {
                    const transformedContent = this.transformElementorContent(templateContent);
  
                    if (!transformedContent || !Array.isArray(transformedContent)) {
                        throw new Error('Failed to transform template content');
                    }
  
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
            },
            error: function(xhr, status, error) {
                const errorMessage = xhr.responseJSON?.data || error || 'Failed to fetch the template';
                console.error("Error fetching template:", {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
                alert("Failed to fetch the template: " + errorMessage);
            }
        });
      },
    
      transformElementorContent(content) {
        if (!content || !Array.isArray(content)) {
          console.error("Invalid content structure for Elementor:", content);
          return null;
        }
    
        try {
          const transformed = content.map(element => {
            if (!element) {
              console.error("Null or undefined element in content array");
              throw new Error("Invalid element in content array");
            }
            return this.transformElement(element);
          });
          console.log("Transformed content:", transformed);
          return transformed;
        } catch (error) {
          console.error("Error transforming content:", error);
          return null;
        }
      },
    
      transformElement(element) {
        if (!element || typeof element !== 'object') {
          console.error('Invalid element structure:', element);
          throw new Error('Invalid element structure');
        }
    
        // Validate element type
        if (!element.elType && !element.widgetType) {
          console.error('Element missing required type:', element);
          throw new Error('Element missing required type');
        }
    
        const transformedElement = {
          id: element.id || elementor.helpers.getUniqueID(),
          elType: element.elType || (element.widgetType ? 'widget' : 'section'),
          settings: element.settings || {}
        };
    
        if (element.widgetType) {
          transformedElement.widgetType = element.widgetType;
        }
    
        // Handle elements array
        if (Array.isArray(element.elements)) {
          try {
            transformedElement.elements = element.elements.map(child => this.transformElement(child));
          } catch (error) {
            console.error('Error transforming child elements:', error);
            throw new Error('Failed to transform child elements');
          }
        } else {
          transformedElement.elements = [];
        }
    
        console.log('Transformed element:', transformedElement);
        return transformedElement;
      },
    };
  });

})(window.jQuery, window.elementor);


