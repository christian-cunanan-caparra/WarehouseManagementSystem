<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ChatModel;
use App\Models\MessageModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    protected $userModel;
    protected $chatModel;
    protected $messageModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->chatModel = new ChatModel();
        $this->messageModel = new MessageModel();
    }

    // Display the chat page (shows chats and messages for selected chat)
    public function index()
    {
        // Get the logged-in user
        $userId = session()->get('user_id');
        
        // Retrieve chats for the logged-in user
        $data['chats'] = $this->userModel->getChats($userId);

        return view('chat_view', $data); // Ensure this matches the view name
    }

    // Get messages for a specific chat (AJAX endpoint)
    public function getMessages($chatId)
    {
        $messages = $this->messageModel->getMessagesByChatId($chatId);
        return $this->response->setJSON(['messages' => $messages]);
    }

    // Send a message (AJAX endpoint)
    public function sendMessage()
{
    $messageData = $this->request->getJSON();
    $userId = session()->get('user_id'); // Get the logged-in user

    if (!$userId) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
    }

    $data = [
        'chat_id' => $messageData->chat_id,
        'sender_id' => $userId,
        'message' => $messageData->message,
        'created_at' => date('Y-m-d H:i:s')
    ];

    if ($this->messageModel->insert($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save message']);
    }
}

public function testMessage()
{
    $this->messageModel->insert([
        'chat_id' => 1,
        'sender_id' => 1,
        'message' => 'Test message',
        'created_at' => date('Y-m-d H:i:s')
    ]);
    echo "Message inserted";
}


    // Reset messages (this might be scheduled or triggered manually)
    public function resetMessages()
    {
        $this->messageModel->truncate();  // This will delete all messages in the table
        return redirect()->to('/chat');
    }
}
