<?php namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    protected $chatModel;

    public function __construct()
    {
        $this->chatModel = new ChatModel();
    }

    // Get chat messages
    public function getMessages()
    {
        $messages = $this->chatModel->findAll();  // Fetch all chat messages from the database
        return $this->response->setJSON(['messages' => $messages]);
    }

    // Send a new message
    public function sendMessage()
    {
        $message = $this->request->getPost('message');
        $user = session()->get('user_name');  // Get the logged-in user's name
        
        // Save the message to the database
        $data = [
            'sender_name' => $user,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->chatModel->insert($data);
        return $this->response->setJSON(['status' => 'success']);
    }
}
