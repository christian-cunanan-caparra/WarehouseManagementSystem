<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Dashboard</title>
    <style>
        .chat-box { width: 70%; float: left; padding: 10px; }
        .chat-list { width: 25%; float: right; padding: 10px; border-left: 1px solid #ccc; }
        .message { padding: 5px 10px; margin-bottom: 10px; }
        .sent { background-color: #f1f1f1; text-align: right; }
        .received { background-color: #e0e0e0; text-align: left; }
    </style>
</head>
<body>

    <div class="chat-list">
        <h3>Chats</h3>
        <ul>
            <?php foreach ($chats as $chat): ?>
                <li class="chat-item" data-chat-id="<?= $chat->id ?>"><?= $chat->name ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="chat-box">
        <h3>Chat Messages</h3>
        <div id="messageBox"></div>
        <textarea id="newMessage" placeholder="Type a message..."></textarea>
        <button id="sendMessage">Send</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let currentChatId = null;
            const messageBox = document.getElementById('messageBox');
            const sendMessageBtn = document.getElementById('sendMessage');
            const newMessageInput = document.getElementById('newMessage');
            
            // Load messages for the selected chat
            function loadMessages(chatId) {
                fetch(`/chat/messages/${chatId}`)
                    .then(response => response.json())
                    .then(data => {
                        messageBox.innerHTML = '';
                        if (data.messages.length > 0) {
                            data.messages.forEach(message => {
                                const messageDiv = document.createElement('div');
                                messageDiv.classList.add('message');
                                messageDiv.classList.add(message.sender_id == <?= session()->get('user_id') ?> ? 'sent' : 'received');
                                messageDiv.innerHTML = `<p><strong>${message.sender_id == <?= session()->get('user_id') ?> ? 'You' : 'User ' + message.sender_id}:</strong></p><p>${message.message}</p>`;
                                messageBox.appendChild(messageDiv);
                            });
                        } else {
                            messageBox.innerHTML = '<p>No messages yet.</p>';
                        }
                    });
            }

            // Select chat and load messages
            document.querySelectorAll('.chat-item').forEach(item => {
                item.addEventListener('click', function () {
                    currentChatId = item.getAttribute('data-chat-id');
                    loadMessages(currentChatId);
                });
            });

            // Send message functionality
            sendMessageBtn.addEventListener('click', function () {
                const message = newMessageInput.value;
                if (message.trim() === '' || currentChatId === null) return;

                // Send the message via AJAX
                fetch('/chat/send', {
                    method: 'POST',
                    body: JSON.stringify({
                        chat_id: currentChatId,
                        message: message
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        newMessageInput.value = '';  // Clear the input field
                        loadMessages(currentChatId); // Reload messages
                    }
                });
            });
        });
    </script>

</body>
</html>
