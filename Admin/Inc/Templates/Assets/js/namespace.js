(function ($, elementor) {
  "use strict";
  window.primekitNamespace = {
    selectedCategory: "all",
    selectedType: "all",
    searchQuery: "",
    loadTemplates() {
      const modalContent = document.getElementById(
        "primekit-templates-modal-content"
      );
      if (!modalContent) {
        console.error("Modal content element not found.");
        return;
      }

        //  Cleaner loading display
        this.clearAndShowLoading(); // Clear existing content

      modalContent.innerHTML = "<p>Loading templates...</p>"; // Display loading message

      // Fetch templates using WordPress site URL
      const siteUrl = "https://demo.primekitaddons.com/";
      fetch(`${siteUrl}/wp-json/primekit/v1/templates`)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Failed to fetch templates.");
          }
          return response.json();
        })
        .then((data) => {
          console.log("Templates loaded:", data);

          this.templates = data; //  Store globally for filtering
          this.renderTemplates(data); // move rendering into a dedicated method
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
      this.selectedCategory = "all";
      this.selectedType = "all";
      this.searchQuery = "";
      // Load templates when the modal is opened
      this.loadTemplates();

      // Wait briefly to ensure modal is fully in DOM
      setTimeout(() => {
        loadTemplateCategories();
        // Bind click event to insert button
        this.bindSearchInput(); // Bind search input event
      }, 100); // Call the function to load template categories

      // Show the modal
      MicroModal.show("primekit-template-modal");
    },

    /**
     * Clears existing content in the modal and displays a loading message
     * @param {string} message - Optional message to display. Defaults to "Loading templates..."
     */
    clearAndShowLoading(message = "Loading templates...") {
      const modalContent = document.getElementById("primekit-templates-modal-content");
      if (modalContent) {
        modalContent.innerHTML = `<p>${message}</p>`;
      }
    },
    
    /** Binds input event to search field with debouncing
     * Updates searchQuery and filters templates when user types
     * Uses 200ms delay to avoid excessive filtering while typing
     **/
    bindSearchInput() {
      const input = document.getElementById("primekit-templates-search");
      if (!input) return;

      let timeout;
      input.addEventListener("input", function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
          primekitNamespace.searchQuery = this.value;
          primekitNamespace.filterTemplates();
        }, 200);
      });
    },

    /**
     * Renders template items in the modal content area
     * @param {Array} templates - Array of template objects to render
     * Each template object should contain:
     * - thumbnail: URL of template preview image
     * - title: Template name/title
     * - id: Unique template identifier
     *
     * If templates array is empty, displays "No templates found" message
     * Otherwise generates HTML for each template with image, title and insert button
     */
    renderTemplates(templates) {
      const modalContent = document.getElementById(
        "primekit-templates-modal-content"
      );
      if (!modalContent) return;

      if (templates.length === 0) {
        modalContent.innerHTML = "<p>No templates found.</p>";
        return;
      }

      let templateHTML = "";
      templates.forEach((template) => {
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

      modalContent.innerHTML = templateHTML;
    },

    /**
     * Filters templates based on selected type, category and search query
     * Applies three levels of filtering:
     * 1. By template type if selectedType is not "all"
     * 2. By category if selectedCategory is not "all"
     * 3. By search query if searchQuery is not empty
     *
     * Uses the stored this.templates array as source
     * Calls renderTemplates() with filtered results
     */
    filterTemplates() {
      let filtered = this.templates;

      if (this.selectedType !== "all") {
        filtered = filtered.filter((tpl) => tpl.type === this.selectedType);
      }

      if (this.selectedCategory !== "all") {
        filtered = filtered.filter(
          (tpl) =>
            Array.isArray(tpl.categories) &&
            tpl.categories.some(
              (cat) => cat.toLowerCase() === this.selectedCategory
            )
        );
      }

      if (this.searchQuery.trim() !== "") {
        const q = this.searchQuery.toLowerCase();
        filtered = filtered.filter((tpl) =>
          tpl.title.toLowerCase().includes(q)
        );
      }

      this.renderTemplates(filtered);
    },

    insertTemplate(templateId) {
      console.log(`Inserting template with ID: ${templateId}`);

      // Fetch template content using WordPress site URL
      const siteUrl = window.location.origin;
      fetch(
        `${siteUrl}/wp-content/plugins/primekit-addons/Admin/Inc/Templates/data/templates/${templateId}.json`
      )
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
          const transformedContent = this.transformElementorContent(
            data.content
          );

          if (!transformedContent || !Array.isArray(transformedContent)) {
            throw new Error("Failed to transform template content");
          }

          try {
            $e.run("document/elements/import", {
              model: elementor.elementsModel,
              data: {
                content: transformedContent,
              },
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
        return content.map((element) => this.transformElement(element));
      } catch (error) {
        console.error("Error transforming content:", error);
        return null;
      }
    },

    transformElement(element) {
      if (!element || typeof element !== "object") {
        throw new Error("Invalid element structure");
      }

      const transformedElement = {
        id: element.id || elementor.helpers.getUniqueID(),
        elType: element.elType || "section",
        settings: element.settings || {},
        elements: [],
      };

      if (element.widgetType) {
        transformedElement.widgetType = element.widgetType;
      }

      if (Array.isArray(element.elements)) {
        transformedElement.elements = element.elements.map((child) =>
          this.transformElement(child)
        );
      }

      return transformedElement;
    },
  };
})(window.jQuery, window.elementor);
