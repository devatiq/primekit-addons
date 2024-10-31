document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".nav-tab");
  const contents = document.querySelectorAll(".tab-content");

  tabs.forEach((tab) => {
    tab.addEventListener("click", function (event) {
      event.preventDefault();

      tabs.forEach((t) => t.classList.remove("nav-tab-active"));
      tab.classList.add("nav-tab-active");

      const target = tab.getAttribute("href").substring(1);

      contents.forEach((content) => {
        if (content.getAttribute("id") === target) {
          content.style.display = "block";
        } else {
          content.style.display = "none";
        }
      });
    });
  });
});

jQuery(document).ready(function ($) {
    // Initial label state based on checkbox status
    $('.primekit-switch input[type="checkbox"]').each(function () {
      PrimeKitToggleLabels($(this));
    });
  
    // Save widget settings
    $('.primekit-switch input[type="checkbox"]').change(function () {
      let widgetName = $(this).attr("name");
      let value = $(this).is(":checked") ? "1" : "0";
      let thisCheckbox = $(this);
  
      // Toggle on/off labels based on checkbox status
      PrimeKitToggleLabels(thisCheckbox);
  
      // Remove any existing 'Saved...' message next to this checkbox
      thisCheckbox.siblings(".primekit-save-message").remove();
  
      // Create the 'Saving...' message element
      let saveMessage = $('<span class="primekit-save-message">Saving...</span>');
      saveMessage.insertAfter(thisCheckbox);
  
      // Perform the AJAX request
      $.post(
        PrimeKitWidgetsSwitch.ajaxurl,
        {
          action: "primekit_save_widget_setting",
          widgetName: widgetName,
          value: value,
          nonce: PrimeKitWidgetsSwitch.nonce,
        },
        function (response) {
          if (response.success) {
            saveMessage.text("Saved!").fadeOut(500, function () {
              $(this).remove();
            });
          } else {
            saveMessage.text("Error: " + response.data.message).css("color", "red");
          }
        }
      );
    });
  
    // Function to toggle on/off labels
    function PrimeKitToggleLabels(checkbox) {
      if (checkbox.is(":checked")) {
        checkbox.siblings(".primekit-switch-label.primekit-switch-on").show();
        checkbox.siblings(".primekit-switch-label.primekit-switch-off").hide();
      } else {
        checkbox.siblings(".primekit-switch-label.primekit-switch-on").hide();
        checkbox.siblings(".primekit-switch-label.primekit-switch-off").show();
      }
    }
  });
  
