<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'author', 'illustrator', 'publisher', 'year',
        'language', 'age_min', 'age_max', 'reading_level',
        'category', 'genre', 'synopsis', 'pages', 'cover',
        'format', 'is_illustrated', 'rating', 'total_ratings',
        'is_best_seller', 'is_new_arrival'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    public function getBestSeller($limit = 4)
    {
        return $this->where('is_best_seller', true)
                    ->orderBy('rating', 'DESC')
                    ->findAll($limit);
    }

    public function getNewArrivals($limit = 4)
    {
        return $this->where('is_new_arrival', true)
                    ->orderBy('created_at', 'DESC')
                    ->findAll($limit);
    }

    public function search($keyword)
    {
        return $this->like('title', $keyword)
                    ->orLike('author', $keyword)
                    ->orLike('synopsis', $keyword)
                    ->orLike('category', $keyword)
                    ->findAll();
    }
    public function getByFilter($filters = [])
    {
        $query = $this;

        if (!empty($filters['q'])) {
            $query->groupStart()
                  ->like('title', $filters['q'])
                  ->orLike('author', $filters['q'])
                  ->orLike('synopsis', $filters['q'])
                  ->orLike('category', $filters['q'])
                  ->groupEnd();
        }

        if (!empty($filters['age'])) {
            $query->where('age_min <=', $filters['age'])
                  ->where('age_max >=', $filters['age']);
        }
        if (!empty($filters['reading_level'])) {
            $query->where('reading_level', $filters['reading_level']);
        }
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }
        if (!empty($filters['language'])) {
            $query->where('language', $filters['language']);
        }
        if (!empty($filters['format'])) {
            $query->where('format', $filters['format']);
        }
        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'popular': $query->orderBy('total_ratings', 'DESC'); break;
                case 'newest': $query->orderBy('created_at', 'DESC'); break;
                case 'rating': $query->orderBy('rating', 'DESC'); break;
                default: $query->orderBy('title', 'ASC');
            }
        }
        return $query->findAll();
    }
}