<?php

namespace App\Models;

use CodeIgniter\Model;

class StorytellingModel extends Model
{
    protected $table = 'storytelling';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'category', 'description', 'audio_url', 'cover', 'narrator', 'duration', 'is_featured'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    public function getFeatured()
    {
        return $this->where('is_featured', true)->findAll();
    }
}