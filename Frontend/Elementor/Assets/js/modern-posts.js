document.addEventListener('DOMContentLoaded', function() {
    // Select all post divs with the `data-post` attribute
    document.querySelectorAll('.primekit-modern-single-post-link').forEach(function(element) {
        // Get the JSON data from the `data-post` attribute
        const postData = JSON.parse(element.getAttribute('data-post'));
        // Set cursor to pointer
        element.style.cursor = 'pointer';
        
        // Add a click event listener that navigates to the permalink
        element.addEventListener('click', function() {
            window.location.href = postData.permalink;
            console.log(postData.permalink);
        });
    });
});