<?php

namespace App\Models;

use CodeIgniter\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message'];

    public function getMessagesAfterLogin($login_time)
    {
        return $this->where('created_at >', $login_time)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }

    public function saveMessage($user_id, $message)
    {
        $data = [
            'user_id' => $user_id,
            'message' => $message
        ];
        return $this->insert($data);
    }
}
