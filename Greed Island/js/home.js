document.addEventListener("DOMContentLoaded", function() {
    // Show loading image
    document.querySelector('.loading-image').style.display = 'block';

    // Hide loading image and show content after 1 or 2 seconds
    setTimeout(function() {
        document.querySelector('.loading-image').style.display = 'none';
        document.querySelector('.content').style.display = 'block';
    }, Math.random() * (2000 - 1000) + 1000); // Random duration between 1 to 2 seconds
});
