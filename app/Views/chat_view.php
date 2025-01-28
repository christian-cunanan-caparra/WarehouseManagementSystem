<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .chat-box {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="chat-box" id="chatBox">
            <!-- Messages will appear here -->
        </div>

        <form id="chatForm">
            <textarea id="message" class="form-control" rows="3" placeholder="Type your message..."></textarea>
            <button type="submit" class="btn btn-primary mt-2">Send</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#chatForm').on('submit', function (e) {
                e.preventDefault();

                let message = $('#message').val();
                if (message.trim() === '') return;

                // Send message to the server
                $.post('/chat/sendMessage', { message: message }, function (data) {
                    if (data.message) {
                        $('#chatBox').append('<div class="message">' + data.message + '</div>');
                        $('#message').val('');
                    }
                });
            });

            // Here you can implement a setInterval to periodically fetch new messages
            // from the server, for example, using AJAX. For now, it's just a basic send.
        });
    </script>
</body>
</html>
