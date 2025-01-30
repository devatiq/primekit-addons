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

      // Fetch templates from Happy Addons API
      fetch("https://templates.happyaddons.com/wp-json/ha/v2/templates-info")
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to fetch templates from the API.");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Templates loaded:", data);

          // Render the templates in the modal
          if (data.templates && data.templates.length > 0) {
            let templateHTML = "";
            data.templates.forEach((template) => {
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

      // Fetch template content by ID
      fetch(
        `https://templates.happyaddons.com/wp-json/ha/v1/templates/${templateId}`
      )
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to fetch template data.");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Template content loaded:", data);

          // Transform JSON to Elementor compatible structure
          const transformedContent = this.transformElementorContent(
            data.content
          );

          if (transformedContent) {
            try {
              $e.run("document/elements/import", {
                elements: transformedContent,
              });
              console.log("Template inserted successfully.");
            } catch (error) {
              console.error("Error inserting template:", error);
              alert("Failed to insert the template. Please try again.");
            }
          } else {
            console.error("Transformed content is invalid.");
            alert("Invalid template content.");
          }
        })
        .catch((error) => {
          console.error("Error inserting template:", error);
          alert("Failed to insert the template.");
        });
    },

    transformElementorContent(content) {
      if (!content || !Array.isArray(content)) {
        console.error("Invalid content structure for Elementor.");
        return null;
      }

      return content.map((element) => {
        return this.transformElement(element);
      });
    },

    transformElement(element) {
      // Ensure each element has the required properties for Elementor
      const transformedElement = {
        id: element.id || Math.random().toString(36).substring(2),
        elType: element.elType || "section",
        settings: element.settings || {},
        elements: Array.isArray(element.elements)
          ? element.elements.map((childElement) =>
              this.transformElement(childElement)
            )
          : [],
      };

      // Include widgetType if the element is a widget
      if (element.widgetType) {
        transformedElement.widgetType = element.widgetType;
      }

      return transformedElement;
    },
  };
})(window.jQuery, window.elementor);
