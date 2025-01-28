<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Chat Dashboard</h1>
        
        <!-- Display the chat list -->
        <h3>Chats</h3>
        <ul class="list-group">
            <?php foreach ($chats as $chat): ?>
                <li class="list-group-item">
                    <a href="#" class="chat-link" data-chat-id="<?= esc($chat['id']) ?>"><?= esc($chat['name']) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Display messages for the selected chat -->
        <div id="chat-messages" class="mt-4"></div>

        <!-- Send message form -->
        <form id="sendMessageForm" class="mt-4">
            <div class="mb-3">
                <textarea class="form-control" id="messageText" rows="3" placeholder="Type your message"></textarea>
            </div>
            <input type="hidden" id="chatId" value="">
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Event listener to load messages for the selected chat
        $('.chat-link').on('click', function (e) {
            e.preventDefault();
            var chatId = $(this).data('chat-id');
            $('#chatId').val(chatId);
            loadMessages(chatId);
        });

        // Function to load messages for a selected chat
        function loadMessages(chatId) {
    $.ajax({
        url: '/chat/getMessages/' + chatId,
        method: 'GET',
        success: function (data) {
            console.log(data); // Debugging output

            var messages = data.messages;
            var messageHtml = '';
            messages.forEach(function (message) {
                messageHtml += '<p><strong>' + message.sender_id + ':</strong> ' + message.message + '</p>';
            });
            $('#chat-messages').html(messageHtml);
        },
        error: function (xhr) {
            console.log("Error loading messages:", xhr.responseText);
        }
    });
}


        // Send message function
        $('#sendMessageForm').on('submit', function (e) {
            e.preventDefault();
            var message = $('#messageText').val();
            var chatId = $('#chatId').val();
            $.ajax({
                url: '/chat/sendMessage',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ chat_id: chatId, message: message }),
                success: function () {
                    $('#messageText').val(''); // Clear the input field
                    loadMessages(chatId); // Reload messages
                }
            });
        });
    </script>
</body>
</html>
