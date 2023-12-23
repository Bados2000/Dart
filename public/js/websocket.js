
    document.addEventListener("DOMContentLoaded", function() {
    // Utworzenie nowego połączenia WebSocket.
    var ws = new WebSocket('ws://192.168.1.24:9001');

    ws.onopen = function() {
    console.log('WebSocket Connected');
};

    ws.onmessage = function(event) {
    // Odbieranie danych
    var data = event.data;
    console.log('Data received: ' + data);

    // Aktualizacja interfejsu użytkownika
    updateUI(data);
};

    ws.onerror = function(error) {
    console.log('WebSocket Error: ' + error);
};

    ws.onclose = function() {
    console.log('WebSocket connection closed');
};

    function updateUI(data) {
    // Tutaj aktualizujesz interfejs użytkownika.
    // Na przykład, możesz umieścić dane w elemencie div:
    document.getElementById('websocket-data').innerText = data;
}
});
