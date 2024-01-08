document.addEventListener('DOMContentLoaded', function() {
    var joinQueueButton = document.getElementById('joinQueueButton');
    var isStopwatchActive = false;
    var stopwatchInterval;
    var elapsedSeconds = 0;
    var checkMatchInterval;

    if (joinQueueButton) {
        joinQueueButton.addEventListener('click', function() {
            if (!isStopwatchActive) {
                // Rozpocznij stoper i wyszukiwanie przeciwnika
                elapsedSeconds = 0;
                stopwatchInterval = setInterval(updateStopwatch, 1000);
                checkMatchInterval = setInterval(checkForMatch, 1000);
                joinQueue(); // Wywołaj funkcję dołączenia do kolejki
                isStopwatchActive = true;
                joinQueueButton.textContent = '00:00';
            } else {
                // Zatrzymaj stoper i przestań sprawdzać dopasowanie
                clearInterval(stopwatchInterval);
                clearInterval(checkMatchInterval);
                isStopwatchActive = false;
                joinQueueButton.textContent = 'Graj';
            }
        });
    } else {
        console.error('Przycisk "Graj" nie został znaleziony.');
    }

    function joinQueue() {
        fetch('/join-queue', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);
                // Możesz dodać tutaj dodatkowe działania po pomyślnym dołączeniu do kolejki
            })
            .catch(error => {
                console.error('Error during joining the queue:', error);
            });
    }


    function updateStopwatch() {
        elapsedSeconds++;
        var minutes = Math.floor(elapsedSeconds / 60);
        var seconds = elapsedSeconds % 60;
        joinQueueButton.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
    }

    function checkForMatch() {
        fetch('/api/check-match')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'matched') {
                    clearInterval(stopwatchInterval);
                    clearInterval(checkMatchInterval);
                    joinQueueButton.textContent = 'Zaraz zostaniesz przeniesiony do gry';
                    joinQueueButton.disabled = true; // Wyłącz przycisk

                    // Aktualizacja interfejsu użytkownika z danymi przeciwnika
                    updateOpponentInfo(data.opponent_id);

                    // Ustawienie opóźnienia przed przekierowaniem
                    setTimeout(function() {
                        window.location.href = '/ingame'; // Przekierowanie na stronę gry

                    }, 5000); // 5 sekund opóźnienia

                    isStopwatchActive = false;
                }
            })
            .catch(error => console.error('Error:', error));
    }


    function updateOpponentInfo(opponentId) {
        // Tu możesz wykonać kolejne zapytanie do API, aby pobrać dane przeciwnika na podstawie jego ID
        // Przykładowo: fetch(`/api/get-opponent/${opponentId}`)...
        // Następnie zaktualizuj interfejs użytkownika danymi przeciwnika
        fetch(`/api/get-opponent/${opponentId}`)
            .then(response => response.json())
            .then(opponentData => {
                document.getElementById('opponent-image').src = opponentData.profile_picture;
                document.getElementById('opponent-username').textContent = opponentData.username;
            })
            .catch(error => console.error('Error:', error));
    }
});
