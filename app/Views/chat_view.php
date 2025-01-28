<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h1>Group Chat</h1>
    
    <div id="chat-messages" class="mb-3">
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $message): ?>
                <div class="message">
                    <strong><?= esc($message['user_id']) ?>:</strong> <?= esc($message['message']) ?>
                    <small class="text-muted"><?= esc($message['created_at']) ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages yet.</p>
        <?php endif; ?>
    </div>
    
    <form id="chat-form">
        <div class="input-group">
            <input type="text" class="form-control" name="message" id="message" placeholder="Type your message" required>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('chat-form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        const message = document.getElementById('message').value;
        
        fetch('/chat/sendMessage', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'message=' + message
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const chatMessages = document.getElementById('chat-messages');
                const newMessage = document.createElement('div');
                newMessage.classList.add('message');
                newMessage.innerHTML = `<strong>You:</strong> ${message}`;
                chatMessages.appendChild(newMessage);
                document.getElementById('message').value = ''; // Clear input
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error sending message:", error);
            alert("There was an error sending your message.");
        });
    });
</script>

</body>
</html>
