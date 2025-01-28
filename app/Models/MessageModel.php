<?php namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['chat_id', 'sender_id', 'message', 'created_at'];

    // Get all messages by chat ID
    public function getMessagesByChatId($chatId)
    {
        return $this->where('chat_id', $chatId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
}
