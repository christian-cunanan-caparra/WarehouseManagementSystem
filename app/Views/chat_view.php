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

    <div id="chatBox" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
    <!-- Messages will load here -->
</div>

<input type="text" id="message" placeholder="Type your message..." />
<button id="sendMessage">Send</button>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        fetchMessages(); // Load messages when the page loads

        // Send Message Function
        $("#sendMessage").click(function() {
            let message = $("#message").val().trim();
            if (message === "") return;

            $.post("<?= base_url('chat/sendMessage') ?>", { message: message }, function(response) {
                if (response.status === "success") {
                    $("#message").val(""); // Clear input field
                    fetchMessages(); // Fetch messages immediately
                } else {
                    alert(response.message);
                }
            }).fail(function(xhr, status, error) {
                console.error("Error:", error);
            });
        });

        // Fetch Messages Automatically Every 2 Seconds
        setInterval(fetchMessages, 2000);
    });

    // Fetch Messages Function
    function fetchMessages() {
        $.get("<?= base_url('chat/fetchMessages') ?>", function(messages) {
            let chatBox = $("#chatBox");
            chatBox.html(""); // Clear chat box before appending new messages
            messages.forEach(msg => {
                chatBox.append(`<p><strong>${msg.name}:</strong> ${msg.message}</p>`);
            });
            chatBox.scrollTop(chatBox[0].scrollHeight); // Auto-scroll to bottom
        });
    }
</script>


</body>
</html>
