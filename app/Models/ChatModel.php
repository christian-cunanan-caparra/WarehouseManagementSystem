<?php namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table      = 'chat_messages';
    protected $primaryKey = 'id';

    protected $allowedFields = ['sender_name', 'message', 'created_at'];
    
    protected $useTimestamps = false;
}
