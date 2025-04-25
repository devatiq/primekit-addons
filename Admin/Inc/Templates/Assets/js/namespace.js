(function ($, elementor) {
  "use strict";
  window.primekitNamespace = {
    selectedCategory: "all",
    selectedType: "all",
    searchQuery: "",
    templatesPerPage: 21,
    currentPage: 1,

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
    clearAndShowLoading() {
      const modalContent = document.getElementById(
        "primekit-templates-modal-content"
      );
      if (modalContent) {
        modalContent.innerHTML = `<span class="primekit-templates-loader"></span>`;
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

      if (!Array.isArray(templates) || templates.length === 0) {
        modalContent.innerHTML = "<p>No templates found.</p>";
        return;
      }

      const start = (this.currentPage - 1) * this.templatesPerPage;
      const end = start + this.templatesPerPage;
      const paginated = templates.slice(start, end);

      let templateHTML = "";
      paginated.forEach((template) => {
        // Check if template is less than a month old
        const isNew = template.modified_at ? (() => {
          const createdDate = new Date(template.modified_at.replace(' ', 'T'));
          const currentDate = new Date();
          const diffTime = currentDate - createdDate;
          return diffTime < (30 * 24 * 60 * 60 * 1000);
        })() : false;
        // Determine version display
        let versionDisplay = "";
        if (template.av) {
          versionDisplay = `<p title="Available from PrimeKit ${template.av}" class="primekit-template-available">${template.av}</p>`;
        } else if (isNew) {
          versionDisplay = `<p title="New template" class="primekit-template-available">New</p>`;
        }
      

        templateHTML += `
          <div class="primekit-template">
          <div class="primekit-template-info">
          ${versionDisplay}
            ${
              template.is_pro
                ? `<p title="This template is only available in the Pro version" class="primekit-template-pro">Pro</p>`
                : `<p title="This is a free template" class="primekit-template-free">Free</p>`
            }
          </div>
            <img src="${template.thumbnail}" alt="${template.title}">
            <div class="primekit-template-content">
              <h3>${template.title}</h3>
              <div class="primekit-templates-buttons">
                <button class="primekit-template-insert" data-template-id="${
                  template.id
                }">
                  Insert
                </button>
                <button class="primekit-template-preview" data-template-id="${
                  template.id
                }">
                  <a href="${template.demo_url}" target="_blank">
                    Preview
                  </a>
                </button>
              </div>
            </div>
          </div>
        `;
      });

      if (this.currentPage === 1) {
        modalContent.innerHTML = ""; // Clear only on first render
      }

      modalContent.insertAdjacentHTML("beforeend", templateHTML);

      if (end < templates.length) {
        const loadMoreBtn = document.createElement("button");
        loadMoreBtn.textContent = "Load More";
        loadMoreBtn.className = "primekit-load-more";

        modalContent.appendChild(loadMoreBtn); // Append first

        const observer = new IntersectionObserver((entries) => {
          console.log("Observer triggered", entries[0].isIntersecting);
          if (entries[0].isIntersecting) {
            this.currentPage++;
            observer.disconnect(); // Avoid multiple triggers
            loadMoreBtn.remove(); // Optional: remove old button
            this.renderTemplates(templates); // Load next set
          }
        });

        observer.observe(loadMoreBtn);
      }
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
      this.currentPage = 1;
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
