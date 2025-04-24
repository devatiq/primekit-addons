function loadTemplateCategories() {
    const checkboxContainer = document.querySelector('.primekit-filter-checkboxes');
    const loadingElement = document.querySelector('.primekit-loading-categories');

    if (!checkboxContainer) {
        console.error('Checkbox container not found.');
        return;
    }

    jQuery.ajax({
        url: primekitTemplates.ajaxurl,
        type: 'POST',
        data: {
            action: 'primekit_get_template_categories',
            nonce: primekitTemplates.nonce
        },
        success: function(response) {
            console.log('category: ', response);
        
            if (
                response.success &&
                response.data &&
                Array.isArray(response.data.templates) &&
                Array.isArray(response.data.categories)
            ) {
                loadingElement.style.display = 'none';
        
                const counts = {};
                const templates = response.data.templates;
        
                // Count categories
                templates.forEach(template => {
                    if (Array.isArray(template.categories)) {
                        template.categories.forEach(category => {
                            counts[category] = (counts[category] || 0) + 1;
                        });
                    }
                });
        
                // Display "All"
                const total = Object.values(counts).reduce((a, b) => a + b, 0);
                checkboxContainer.appendChild(createCategoryLabel('All', total));
        
                // Display other categories in order
                response.data.categories.forEach(category => {
                    if (category !== 'All') {
                        checkboxContainer.appendChild(createCategoryLabel(category, counts[category] || 0));
                    }
                });
            }
        },
        error: function() {
            loadingElement.textContent = 'Failed to load categories';
        }
    });

    // Create a reusable label function
    function createCategoryLabel(category, count) {
        const label = document.createElement('label');
        label.className = 'primekit-checkbox';
    
        const input = document.createElement('input');
        input.type = 'checkbox';
        input.value = category.toLowerCase();
        if (category === 'All') input.checked = true;
    
        const span = document.createElement('span');
        span.textContent = `${category} (${count})`;
    
        label.appendChild(input);
        label.appendChild(span);
        return label;
    }
    
}
