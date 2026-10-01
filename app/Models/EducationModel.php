<?php
namespace App\Models;

use CodeIgniter\Model;

class EducationModel extends Model
{
    protected $table            = 'education_places';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'slug', 'nama', 'category', 'jenjang_label', 'lokasi', 
        'rentang_usia', 'program_fokus', 'akreditasi', 'kurikulum', 
        'deskripsi', 'fasilitas', 'foto_utama', 'kontak', 'is_verified', 
        'instagram', 'gmaps'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
