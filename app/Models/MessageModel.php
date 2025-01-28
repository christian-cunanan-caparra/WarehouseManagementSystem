<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message', 'created_at'];
    protected $useTimestamps = true;

    public function getMessages()
    {
        return $this->select('messages.*, users.name')
                    ->join('users', 'users.id = messages.user_id')
                    ->orderBy('messages.created_at', 'ASC')
                    ->findAll();
    }
}
