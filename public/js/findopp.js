document.addEventListener('DOMContentLoaded', function() {
    // Pobierz przycisk po załadowaniu całego dokumentu
    var joinQueueButton = document.getElementById('joinQueueButton');

    // Sprawdź, czy przycisk istnieje
    if (joinQueueButton) {
        joinQueueButton.addEventListener('click', function() {
            console.log('Button clicked'); // Potwierdzenie kliknięcia przycisku

            // Wykonaj operacje po kliknięciu przycisku
            fetch('/join-queue', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    // Dodatkowe akcje po dołączeniu do kolejki
                })
                .catch(error => console.error('Error:', error));
        });
    } else {
        console.error('Przycisk "Graj" nie został znaleziony.');
    }
});
