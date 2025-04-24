function loadTemplateCategories() {
  const checkboxContainer = document.querySelector(
    ".primekit-filter-checkboxes"
  );
  if (!checkboxContainer) {
    console.error("Checkbox container not found.");
    return;
  }

  // 🔄 Clear previous categories
  checkboxContainer.innerHTML = "";

  // 👇 Optional: add "loading" message again
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
        });
      }
    },
    error: function () {
      checkboxContainer.innerHTML =
        '<div class="primekit-loading-categories">Failed to load categories</div>';
    },
  });

  // Create a reusable label function
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
  }
}
