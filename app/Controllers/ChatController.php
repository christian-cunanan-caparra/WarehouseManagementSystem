<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    public function sendMessage()
    {
        $session = session();
        if (!$session->get('is_logged_in')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
        }

        $message = $this->request->getPost('message');
        if (empty($message)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Message cannot be empty']);
        }

        $messageModel = new MessageModel();
        $messageModel->insert([
            'user_id' => $session->get('user_id'),
            'message' => $message
        ]);

        return $this->response->setJSON(['status' => 'success']);
    }

    public function fetchMessages()
    {
        $messageModel = new MessageModel();
        $messages = $messageModel->getMessages();

        return $this->response->setJSON($messages);
    }
}
