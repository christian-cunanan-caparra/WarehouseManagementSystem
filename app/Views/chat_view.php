<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard - Warehouse Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* ---- Chat Box Styling ---- */
        .chat-box {
            position: fixed;
            bottom: 20px;
            left: -300px; /* Initially hidden */
            width: 300px;
            height: 400px;
            background: rgba(22, 26, 45, 0.9);
            color: white;
            border-radius: 10px;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.3);
            transition: left 0.3s ease;
            z-index: 999;
            padding: 20px;
        }

        .chat-box.active {
            left: 20px; /* Display the chat box when active */
        }

        .chat-box .messages {
            max-height: 280px;
            overflow-y: auto;
            margin-bottom: 15px;
        }

        .chat-box .input-group input {
            width: 75%;
        }

        .chat-toggle-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #161a2d;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1.2rem;
            border-radius: 50%;
            transition: 0.3s;
            z-index: 1000;
        }

        .chat-toggle-btn:hover {
            background: #4f52ba;
        }
    </style>
</head>
<body>

    <!-- Chat Toggle Button -->
    <button class="chat-toggle-btn" id="chat-toggle-btn">
        <span class="material-icons">chat</span>
    </button>

    <!-- Chat Box -->
    <div class="chat-box" id="chat-box">
        <h5 class="text-center">Group Chat</h5>
        <div class="messages" id="messages">
            <!-- Messages will appear here -->
        </div>
        <form id="chat-form">
            <div class="input-group">
                <input type="text" id="message" class="form-control" placeholder="Type a message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        const chatToggleBtn = document.getElementById('chat-toggle-btn');
        const messageInput = document.getElementById('message');
        const chatForm = document.getElementById('chat-form');
        const messagesDiv = document.getElementById('messages');

        // Toggle chat box visibility
        chatToggleBtn.addEventListener('click', function() {
            chatBox.classList.toggle('active');
        });

        // Handle message submission
        chatForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const message = messageInput.value.trim();

            if (message) {
                sendMessage(message);
                messageInput.value = '';  // Clear the input field
            }
        });

        // Function to send message via AJAX
       // Function to send message via AJAX
function sendMessage(message) {
    const formData = new FormData();
    formData.append('message', message);

    fetch('/chat/sendMessage', {  // Updated to use the ChatController
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            fetchMessages();  // Refresh messages after sending
        }
    });
}

// Fetch messages periodically
setInterval(fetchMessages, 2000);

// Fetch messages from the server
function fetchMessages() {
    fetch('/chat/getMessages')  // Updated to use the ChatController
        .then(response => response.json())
        .then(data => {
            messagesDiv.innerHTML = '';  // Clear previous messages
            data.messages.forEach(msg => {
                const messageElement = document.createElement('div');
                messageElement.innerHTML = `<strong>${msg.sender_name}:</strong> ${msg.message}`;
                messagesDiv.appendChild(messageElement);
            });
        });
}

    </script>

</body>
</html>
