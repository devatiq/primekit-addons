(function ($, elementor) {
    "use strict";

    const primekitLibrary = {
        init() {
            this.bindEvents();
        },

        bindEvents() {
            elementor.on("preview:loaded", this.onElementorPreviewLoaded.bind(this));
            $(document).on("click", ".primekit-template-insert", this.onTemplateInsertClick.bind(this));
        },

        onElementorPreviewLoaded() {
            const $previewContents = window.elementor.$previewContents;

            const interval = setInterval(() => {
                const targetSelector = ".elementor-add-new-section .elementor-add-section-drag-title";
                const target = $previewContents.find(targetSelector);

                if (target.length) {
                    clearInterval(interval); // Stop checking once the target is found
                    this.addLibraryButton($previewContents);
                } else {
                    console.log("Waiting for target to appear:", targetSelector);
                }
            }, 100); // Check every 100ms
        },

        addLibraryButton($previewContents) {
            console.log("Adding library button");
            const targetSelector = ".elementor-add-new-section .elementor-add-section-drag-title";
            const buttonHTML = `
                <div class="primekit-library-open-button">
                    <i class="eicon-folder"></i>
                    <span>PrimeKit Library</span>
                </div>
            `;

            if (!$previewContents.find(".primekit-library-open-button").length) {
                const target = $previewContents.find(targetSelector);
                if (target.length) {
                    target.before(buttonHTML);
                    console.log("PrimeKit Library Button Added");

                    // Add click event to the button
                    $previewContents.on("click", ".primekit-library-open-button", () => {
                        console.log("PrimeKit Library Button Clicked");
                        primekitNamespace.showModal();
                    });
                } else {
                    console.error("Target not found:", targetSelector);
                }
            }
        },

        onTemplateInsertClick(event) {
            event.preventDefault();
            const $button = $(event.currentTarget);
            const templateId = $button.data("template-id");

            console.log(`Template Insert Clicked. Template ID: ${templateId}`);
            primekitNamespace.insertTemplate(templateId);
        },
    };

    $(document).ready(() => {
        primekitLibrary.init();
    });
})(jQuery, window.elementor);