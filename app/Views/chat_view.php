<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        #chat-box { width: 100%; height: 400px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; }
        .message { margin-bottom: 10px; }
        .message strong { color: blue; }
    </style>
</head>
<body>

    <h2>Live Group Chat</h2>
    <div id="chat-box"></div>

    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>

    <script>
        function fetchMessages() {
            $.get("<?= base_url('chat/fetchMessages') ?>", function(data) {
                let chatBox = $("#chat-box");
                chatBox.html("");
                data.forEach(msg => {
                    chatBox.append(`<div class="message"><strong>${msg.name}:</strong> ${msg.message}</div>`);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            });
        }

        function sendMessage() {
    let message = $("#message").val().trim();
    if (message === "") return; // Prevent empty messages

    console.log("Sending message:", message); // Debugging line

    $.post("<?= base_url('chat/sendMessage') ?>", { message: message }, function(response) {
        console.log("Response:", response); // Debugging line
        if (response.status === "success") {
            $("#message").val("");
            fetchMessages();
        } else {
            alert(response.message);
        }
    }).fail(function(xhr, status, error) {
        console.error("Error:", error); // Debugging line
    });
}


        setInterval(fetchMessages, 3000);
        fetchMessages();
    </script>

</body>
</html>
