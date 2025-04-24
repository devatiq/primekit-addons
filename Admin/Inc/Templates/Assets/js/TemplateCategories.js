/**
 * Loads and displays template categories with their counts
 *
 * This function handles:
 * - Loading categories via AJAX from WordPress backend
 * - Displaying loading states and error messages
 * - Creating category checkboxes with template counts
 * - Loading template type tabs with counts
 * - Organizing templates by category and type
 *
 * @requires jQuery
 * @requires primekitTemplates.ajaxurl - WordPress AJAX URL
 * @requires primekitTemplates.nonce - WordPress security nonce
 *
 * The function expects a response containing:
 * - templates: Array of template objects with id, categories, and type properties
 * - categories: Array of category strings
 *
 * @throws {Error} If checkbox container element is not found
 * @returns {void}
 */

function loadTemplateCategories() {
  const checkboxContainer = document.querySelector(
    ".primekit-filter-checkboxes"
  );
  if (!checkboxContainer) {
    console.error("Checkbox container not found.");
    return;
  }

  //  Clear previous categories
  checkboxContainer.innerHTML = "";

  //add "loading" message again
  const loadingDiv = document.createElement("div");
  loadingDiv.className = "primekit-loading-categories";
  loadingDiv.textContent = "Loading categories...";
  checkboxContainer.appendChild(loadingDiv);

  jQuery.ajax({
    url: primekitTemplates.ajaxurl,
    type: "POST",
    data: {
      action: "primekit_get_template_categories",
      nonce: primekitTemplates.nonce,
    },
    success: function (response) {
      console.log("category: ", response);

      if (
        response.success &&
        response.data &&
        Array.isArray(response.data.templates) &&
        Array.isArray(response.data.categories)
      ) {
        // Clear loading
        checkboxContainer.innerHTML = "";
        // Load types into tab
        loadTemplateTypes(response.data.templates);
        // existing category count logic continues here...
        const templates = response.data.templates;
        const categoryToTemplatesMap = {};

        response.data.categories.forEach((category) => {
          categoryToTemplatesMap[category] = new Set();
        });

        templates.forEach((template) => {
          if (Array.isArray(template.categories)) {
            template.categories.forEach((category) => {
              if (categoryToTemplatesMap[category]) {
                categoryToTemplatesMap[category].add(template.id);
              }
            });
          }
          categoryToTemplatesMap["All"].add(template.id);
        });

        response.data.categories.forEach((category) => {
          const count = categoryToTemplatesMap[category]?.size || 0;
          checkboxContainer.appendChild(createCategoryLabel(category, count));
// Checkbox click handling (after checkboxes are created)
checkboxContainer.querySelectorAll('input[type="checkbox"]').forEach((input) => {
    input.addEventListener('change', function () {
      checkboxContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
      this.checked = true;
  
      primekitNamespace.selectedCategory = this.value.toLowerCase();
      primekitNamespace.filterTemplates();
    });
  });
        });
      }
    },
    error: function () {
      checkboxContainer.innerHTML =
        '<div class="primekit-loading-categories">Failed to load categories</div>';
    },
  });

  /**
   * Create a reusable label function
   * Creates a checkbox label element for a template category
   *
   * @param {string} category - The category name to display
   * @param {number} count - The number of templates in this category
   * @returns {HTMLLabelElement} A label element containing a checkbox and count
   */
  function createCategoryLabel(category, count) {
    const label = document.createElement("label");
    label.className = "primekit-checkbox";

    const input = document.createElement("input");
    input.type = "checkbox";
    input.value = category.toLowerCase();
    if (category === "All") input.checked = true;

    const span = document.createElement("span");
    span.textContent = `${category} (${count})`;

    label.appendChild(input);
    label.appendChild(span);
    return label;
  }

  /**
   * Loads and displays template type tabs with counts
   *
   * This function:
   * - Takes an array of template objects as input
   * - Counts templates per type (page, section, popup etc)
   * - Creates tab elements showing template counts by type
   * - Maps internal type names to display labels
   * - Clears and updates the tab list in the UI
   *
   * @param {Array} templates - Array of template objects with type property
   * @throws {Error} If tab list element is not found
   * @returns {void}
   */
  function loadTemplateTypes(templates) {
    const tabList = document.querySelector(".primekit-templates-popup-tab ul");

    if (!tabList) {
      console.error("Tab list not found");
      return;
    }

    // Clear previous content
    tabList.innerHTML = "";
      
    // Count templates per type
    const typeCounts = {};
    templates.forEach((template) => {
      const type = template.type || "unknown";
      typeCounts[type] = (typeCounts[type] || 0) + 1;
    });

    // Map internal types to display names (optional)
    const typeLabels = {
      page: "Templates",
      section: "Sections",
      popup: "Popups",
      unknown: "Others",
    };

    // Create and insert tab items
    Object.entries(typeCounts).forEach(([type, count]) => {
      const li = document.createElement("li");
      const a = document.createElement("a");
      a.href = "#";
      a.setAttribute("data-type", type);
      a.textContent = `${typeLabels[type] || type} (${count})`;
      li.appendChild(a);
      tabList.appendChild(li);
    });

    //Bind click events **after** rendering tabs
    tabList.querySelectorAll('a').forEach((tab) => {
        tab.addEventListener('click', function (e) {
          e.preventDefault();
          //Visual highlight for active tab
          tabList.querySelectorAll("a").forEach((t) => t.classList.remove("active"));
          this.classList.add("active");
          const selectedType = this.getAttribute('data-type');
          primekitNamespace.selectedType = selectedType;
          primekitNamespace.filterTemplates();
        });
      });
  }
}
