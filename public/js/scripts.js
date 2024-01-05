/*!
* Start Bootstrap - Grayscale v7.0.6 (https://startbootstrap.com/theme/grayscale)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
*/
//
// Scripts
//
let isStopwatchActive = false;
let stopwatchInterval;
let elapsedSeconds = 0;

const button = document.getElementById('search-toggle-button');
button.addEventListener('click', function() {
    if (isStopwatchActive) {
        // Zatrzymaj stoper i zmień tekst na "Szukaj"
        clearInterval(stopwatchInterval);
        button.textContent = 'Szukaj';
        button.classList.remove('active');
        isStopwatchActive = false;
    } else {
        // Ustaw tekst na "00:00" i uruchom stoper
        button.textContent = '00:00';
        elapsedSeconds = 0;
        stopwatchInterval = setInterval(function() {
            elapsedSeconds++;
            button.textContent = formatTime(elapsedSeconds);
        }, 1000);
        button.classList.add('active');
        isStopwatchActive = true;
    }
});

function formatTime(totalSeconds) {
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    return minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
}
window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});
