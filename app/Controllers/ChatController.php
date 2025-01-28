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

        $data = [
            'chat_id' => $messageData->chat_id,
            'sender_id' => session()->get('user_id'),
            'message' => $messageData->message
        ];

        // Insert the message into the database
        $this->messageModel->insert($data);

        // Return response after insertion
        return $this->response->setJSON(['status' => 'success']);
    }

    // Reset messages (this might be scheduled or triggered manually)
    public function resetMessages()
    {
        $this->messageModel->truncate();  // This will delete all messages in the table
        return redirect()->to('/chat');
    }
}
