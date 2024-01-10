// Zakładając, że loggedInUserId jest zdefiniowany gdzieś w kodzie HTML
let loggedInUserId; // Wartość tej zmiennej powinna być ustawiona na ID zalogowanego użytkownika

document.addEventListener('DOMContentLoaded', function() {
    // Obsługa formularza
    const scoreForm = document.getElementById('scoreForm');
    if (scoreForm) {
        scoreForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetchCurrentFightIdAndUpdateScore(true);
        });
    } else {
        console.error('Nie znaleziono formularza do aktualizacji wyniku.');
    }

    // Rozpoczęcie cyklicznego odświeżania wyników
    fetchCurrentFightIdAndUpdateScore(false);
});

function fetchCurrentFightIdAndUpdateScore(isSubmitAction) {
    fetch('/api/current-fight-id')
        .then(response => response.json())
        .then(data => {
            if (data.fightId) {
                if (isSubmitAction) {
                    updateScore(data.fightId);
                } else {
                    startScorePolling(data.fightId);
                }
            } else {
                console.error('Nie znaleziono aktualnej walki.');
            }
        })
        .catch(error => console.error('Error:', error));
}

function updateScore(fightId) {
    const scoreInput = document.getElementById('scoreInput');
    if (scoreInput) {
        const score = scoreInput.value;

        fetch('/api/update-score/' + fightId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ score: score })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                scoreInput.value = '';
            })
            .catch(error => console.error('Error:', error));
    } else {
        console.error('Nie znaleziono pola do wprowadzania wyniku.');
    }
}

function updateScores(data) {
    if (loggedInUserId === data.player1_id) {
        document.getElementById('user_score').textContent = data.player1_score;
        document.getElementById('user_legs').textContent = data.player1_legs;
        document.getElementById('opponent_score').textContent = data.player2_score;
        document.getElementById('opponent_legs').textContent = data.player2_legs;
    } else {
        document.getElementById('user_score').textContent = data.player2_score;
        document.getElementById('user_legs').textContent = data.player2_legs;
        document.getElementById('opponent_score').textContent = data.player1_score;
        document.getElementById('opponent_legs').textContent = data.player1_legs;
    }
}

function startScorePolling(fightId) {
    setInterval(() => {
        fetch('/api/get-current-score/' + fightId)
            .then(response => response.json())
            .then(data => {
                updateScores(data);

                if (data.player1_legs >= 3 || data.player2_legs >= 3) {
                    if (data.player1_legs >= 3 || data.player2_legs >= 3) {
                        const previewFeedCenter = document.querySelector('.in-game');
                        if (previewFeedCenter) {
                            previewFeedCenter.style.display = 'none';
                        }

                        const winnerInfo = document.querySelector('.preview-feed-center-aftergame');
                        if (winnerInfo) {
                            winnerInfo.style.display = 'flex';
                            const winnerNameElement = winnerInfo.querySelector('.winner-name');
                            if (winnerNameElement) {
                                const winnerName = data.player1_legs >= 3 ? data.player1_name : data.player2_name;
                                winnerNameElement.textContent = winnerName;
                            }
                        }
                        setTimeout(() => {
                            //window.location.href = '/game'; // Przekierowanie na stronę '/game'
                            // Możesz wywołać tutaj żądanie AJAX do usunięcia walki

                            window.location.href = '/game'; // Przekierowanie na stronę '/game'

                            fetch('/api/delete-fight/' + fightId, {
                                method: 'POST',
                                headers:{
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })// Dopasuj do rzeczywistej trasy i metody
                                .then(response => response.json())
                                .then(data => console.log(data.message))
                                .catch(error => console.error('Error:', error));
                        }, 3000); // Opóźnienie 3 sekundy
                }}
            })
            .catch(error => console.error('Error during score polling:', error));
    }, 1000);
}
