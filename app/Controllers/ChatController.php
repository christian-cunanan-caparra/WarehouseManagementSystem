<?php

namespace App\Controllers;

use App\Models\MessageModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    protected $messageModel;

    public function __construct()
    {
        $this->messageModel = new MessageModel();
    }

    // Display chat page with messages
    public function index()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $data['messages'] = $this->messageModel->getMessagesAfterLogin(session()->get('login_time'));
        return view('chat_view', $data);
    }

    // Store a new message
    public function sendMessage()
    {
        if (!session()->get('is_logged_in')) {
            return redirect()->to('/login');
        }

        $message = $this->request->getPost('message');
        $user_id = session()->get('user_id');
        
        // Insert message into database
        if ($this->messageModel->saveMessage($user_id, $message)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Message sent']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to send message']);
    }

    // To record the user's login time to display messages after they log in
    public function setLoginTime()
    {
        session()->set('login_time', date('Y-m-d H:i:s'));
    }
}
