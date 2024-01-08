document.addEventListener('DOMContentLoaded', function() {
    const videoElement = document.getElementById('cameraStream');

    const constraints = {
        video: {
            width: { ideal: 1920 }, // Preferowana szerokość
            height: { ideal: 1080 }, // Preferowana wysokość
            frameRate: { ideal: 30 } // Preferowana liczba klatek na sekundę
        }
    };

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
                videoElement.srcObject = stream;
            })
            .catch(function(error) {
                console.error("Nie udało się uzyskać dostępu do kamery: ", error);
            });
    } else {
        console.error("Przeglądarka nie obsługuje mediaDevices.getUserMedia");
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const videoElement = document.getElementById('cameraStreamSide');

    const constraints = {
        video: {
            width: { ideal: 1920 }, // Preferowana szerokość
            height: { ideal: 1080 }, // Preferowana wysokość
            frameRate: { ideal: 30 } // Preferowana liczba klatek na sekundę
        }
    };

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia(constraints)
            .then(function(stream) {
                videoElement.srcObject = stream;
            })
            .catch(function(error) {
                console.error("Nie udało się uzyskać dostępu do kamery: ", error);
            });
    } else {
        console.error("Przeglądarka nie obsługuje mediaDevices.getUserMedia");
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const mainVideoElement = document.getElementById('cameraStream');
    const sideVideoElement = document.getElementById('cameraStreamSide');
    const fullscreenButtonMain = document.getElementById('fullscreenButton');
    const fullscreenButtonSide = document.getElementById('fullscreenButtonSide');

    // Funkcja do przełączania na pełny ekran
    function toggleFullscreen(videoElement) {
        if (!document.fullscreenElement) {
            if (videoElement.requestFullscreen) {
                videoElement.requestFullscreen();
            } else if (videoElement.mozRequestFullScreen) { /* Firefox */
                videoElement.mozRequestFullScreen();
            } else if (videoElement.webkitRequestFullscreen) { /* Chrome, Safari i Opera */
                videoElement.webkitRequestFullscreen();
            } else if (videoElement.msRequestFullscreen) { /* IE/Edge */
                videoElement.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) { /* Firefox */
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) { /* Chrome, Safari i Opera */
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) { /* IE/Edge */
                document.msExitFullscreen();
            }
        }
    }

    // Dodaj nasłuchiwanie kliknięć do przycisków
    fullscreenButtonMain.addEventListener('click', function() {
        toggleFullscreen(mainVideoElement);
    });
    fullscreenButtonSide.addEventListener('click', function() {
        toggleFullscreen(sideVideoElement);
    });
});


