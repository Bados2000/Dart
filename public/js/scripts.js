/*!
* Start Bootstrap - Grayscale v7.0.6 (https://startbootstrap.com/theme/grayscale)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-grayscale/blob/master/LICENSE)
*/
//
// Scripts
//

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('showProfile').addEventListener('click', function(e) {
        e.preventDefault();
        setActiveLink(this);
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('statsContent').style.display = 'none';
        document.getElementById('settingsContent').style.display = 'none';
    });

    document.getElementById('showStats').addEventListener('click', function(e) {
        e.preventDefault();
        setActiveLink(this);
        document.getElementById('profileContent').style.display = 'none';
        document.getElementById('statsContent').style.display = 'block';
        document.getElementById('settingsContent').style.display = 'none';
    });

    document.getElementById('showSettings').addEventListener('click', function(e) {
        e.preventDefault();
        setActiveLink(this);
        document.getElementById('profileContent').style.display = 'none';
        document.getElementById('statsContent').style.display = 'none';
        document.getElementById('settingsContent').style.display = 'block';
    });
    document.getElementById('showProfileFromButton').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('profileContent').style.display = 'block';
        document.getElementById('statsContent').style.display = 'none';
        document.getElementById('settingsContent').style.display = 'none';
    });
});
function setActiveLink(clickedElement) {
    // Znajdź wszystkie elementy z klasą 'nav-link'
    var links = document.querySelectorAll('.nav-link');

    // Usuń klasę 'active-link' z wszystkich linków
    links.forEach(function(link) {
        link.classList.remove('active-link');
    });

    // Dodaj klasę 'active-link' do klikniętego linku
    clickedElement.classList.add('active-link');
}
document.addEventListener('DOMContentLoaded', function() {
    var autoScoringCheckbox = document.getElementById('autoScoring');
    var cameraChoiceSelect = document.getElementById('cameraChoice');

    // Funkcje do aktualizacji widoczności
    function updateAutoScoringVisibility() {
        document.getElementById('websocketServerIP').style.display = autoScoringCheckbox.checked ? 'block' : 'none';
    }

    function updateCameraChoiceVisibility() {
        document.getElementById('externalCameraIP').style.display = cameraChoiceSelect.value === 'external' ? 'block' : 'none';
    }

    // Dodanie listenerów
    autoScoringCheckbox.addEventListener('change', updateAutoScoringVisibility);
    cameraChoiceSelect.addEventListener('change', updateCameraChoiceVisibility);

    // Ustawienie początkowej widoczności
    updateAutoScoringVisibility();
    updateCameraChoiceVisibility();
});


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
