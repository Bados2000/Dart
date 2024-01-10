document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById('websocket_video_canvas');
    var ctx = canvas.getContext('2d');

    var ws = new WebSocket('ws://192.168.1.24:9001');
    ws.onmessage = function(event) {
        const message = JSON.parse(event.data);

        if (message.type === "image") {
            const image = new Image();
            image.onload = function() {
                canvas.width = image.width;
                canvas.height = image.height;
                ctx.drawImage(image, 0, 0);
            };
            image.src = "data:image/jpeg;base64," + message.data;
        } else if (message.type === "score") {
            document.getElementById("scoreInput").value = message.data;
        }
    };

    ws.onopen = function() {
        console.log('WebSocket Connected');
    };

    ws.onerror = function(event) {
        console.error("WebSocket error observed:", event);
    };

    ws.onclose = function(event) {
        console.log("WebSocket connection closed: ", event);
    };
});
