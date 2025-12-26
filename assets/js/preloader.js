// Hide preloader when page is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'none';
    }
});

// Also hide on load event
window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'none';
    }
});

// Fallback: hide preloader after 3 seconds max (safety timeout)
setTimeout(function () {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.style.display = 'none';
    }
}, 3000);
