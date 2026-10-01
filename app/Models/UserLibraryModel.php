<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLibraryModel extends Model
{
    protected $table = 'user_library';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'book_id', 'status', 'progress'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    public function getByUser($userId, $status = null)
    {
        $query = $this->where('user_id', $userId);
        if ($status) {
            $query->where('status', $status);
        }
        return $query->findAll();
    }

    public function toggleStatus($userId, $bookId, $status)
    {
        $existing = $this->where('user_id', $userId)
                         ->where('book_id', $bookId)
                         ->first();
        if ($existing) {
            return $this->update($existing['id'], ['status' => $status]);
        } else {
            return $this->insert([
                'user_id' => $userId,
                'book_id' => $bookId,
                'status' => $status
            ]);
        }
    }
}