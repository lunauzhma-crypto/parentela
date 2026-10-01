<?php

namespace App\Models;

use CodeIgniter\Model;

class DirectoryModel extends Model
{
    protected $table            = 'directory_places';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'slug',
        'nama',
        'lokasi',
        'deskripsi',
        'fasilitas',
        'foto_utama',
        'galeri',
        'jam_buka',
        'usia',
        'harga',
        'wa',
        'instagram',
        'website',
        'gmaps',
        'is_verified'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil data berdasarkan kategori
     */
    public function getByCategory(string $category)
    {
        return $this->where('category', $category)->orderBy('is_verified', 'DESC')->orderBy('id', 'ASC')->findAll();
    }

    /**
     * Ambil data berdasarkan slug
     */
    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }
}
