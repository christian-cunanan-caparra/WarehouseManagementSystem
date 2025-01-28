<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getNotificationsByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function createNotification($data)
    {
        return $this->insert($data);
    }

    public function markAsRead($notificationId)
    {
        return $this->update($notificationId, ['status' => 'read']);
    }
}
