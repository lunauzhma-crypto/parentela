<?php

namespace App\Models;

use CodeIgniter\Model;

class NannyModel extends Model
{
    protected $table            = 'nanny_profiles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'foto',
        'pengalaman',
        'keahlian',
        'rentang_usia',
        'tarif',
        'lokasi',
        'wa',
        'deskripsi',
        'is_verified'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
