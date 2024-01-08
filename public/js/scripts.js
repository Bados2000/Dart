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
    var firstCameraChoiceSelect = document.getElementById('cameraChoice');
    var secondCameraChoiceSelect = document.getElementById('secondCameraChoice');

    // Funkcje do aktualizacji widoczności
    function updateAutoScoringVisibility() {
        var autoScoringCheckbox = document.getElementById('autoScoring');
        var firstCameraChoiceSelect = document.getElementById('cameraChoice');

        document.getElementById('websocketServerIP').style.display = autoScoringCheckbox.checked ? 'block' : 'none';
        document.getElementById('externalCameraChoice').style.display = autoScoringCheckbox.checked ? 'none' : 'block';

        // Ukryj lub pokaż externalCameraIP w zależności od stanu autoScoring i wybranej wartości w firstCameraChoiceSelect
        if (!autoScoringCheckbox.checked) {
            if (firstCameraChoiceSelect.value === 'external') {
                document.getElementById('externalCameraIP').style.display = 'block';
            } else {
                document.getElementById('externalCameraIP').style.display = 'none';
            }
        } else {
            document.getElementById('externalCameraIP').style.display = 'none';
        }
    }

    function updateFirstCameraChoiceVisibility() {
        document.getElementById('externalCameraIP').style.display = firstCameraChoiceSelect.value === 'external' ? 'block' : 'none';
    }

    function updateSecondCameraChoiceVisibility() {
        document.getElementById('externalSecondCameraIP').style.display = secondCameraChoiceSelect.value === 'external' ? 'block' : 'none';
    }

    // Dodanie listenerów
    autoScoringCheckbox.addEventListener('change', updateAutoScoringVisibility);
    firstCameraChoiceSelect.addEventListener('change', updateFirstCameraChoiceVisibility);
    secondCameraChoiceSelect.addEventListener('change', updateSecondCameraChoiceVisibility);

    // Ustawienie początkowej widoczności
    updateAutoScoringVisibility();
    updateFirstCameraChoiceVisibility();
    updateSecondCameraChoiceVisibility();
});




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

