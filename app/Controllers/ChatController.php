<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat_view');
    }

    public function fetchMessages()
    {
        log_message('debug', 'Fetching messages...');
        
        $messageModel = new MessageModel();
        $messages = $messageModel->getMessages();
    
        log_message('debug', 'Messages fetched: ' . print_r($messages, true));
    
        return $this->response->setJSON($messages);
    }
    

    public function sendMessage()
{
    log_message('debug', 'sendMessage() function triggered');

    $messageModel = new MessageModel();
    $session = session();

    if (!$session->get('is_logged_in')) {
        log_message('error', 'User is not logged in');
        return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
    }

    $user_id = $session->get('user_id');
    $message = $this->request->getPost('message');

    log_message('debug', 'Received message: ' . $message); // Debugging

    if (empty($message)) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Message cannot be empty']);
    }

    $messageModel->insert([
        'user_id' => $user_id,
        'message' => $message
    ]);

    log_message('debug', 'Message inserted successfully');

    return $this->response->setJSON(['status' => 'success']);
}

}
