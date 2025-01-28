<?php namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'created_at', 'updated_at'];

    // Method to create a new chat
    public function createChat($data)
    {
        return $this->insert($data);
    }
}
