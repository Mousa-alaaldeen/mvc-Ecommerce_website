document.addEventListener("DOMContentLoaded", function() {
    // Get the current path
    const currentPath = window.location.pathname;

    // Select all nav-links
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        // Check if the href attribute matches the current path
        if (link.getAttribute('href') === currentPath) {
            // Remove 'active' from any previously active link
            document.querySelectorAll('.nav-link.active').forEach(activeLink => {
                activeLink.classList.remove('active');
            });

            // Add 'active' class to the current link
            link.classList.add('active');
        }
    });
});
