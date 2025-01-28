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
        $messageModel = new MessageModel();
        $messages = $messageModel->getMessages();

        return $this->response->setJSON($messages);
    }

    public function sendMessage()
    {
        $messageModel = new MessageModel();
        $session = session();

        if (!$session->get('is_logged_in')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }

        $user_id = $session->get('user_id');
        $message = $this->request->getPost('message');

        if (empty($message)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Message cannot be empty']);
        }

        $messageModel->insert([
            'user_id' => $user_id,
            'message' => $message
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }
}
