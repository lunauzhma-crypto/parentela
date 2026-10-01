<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'password', 'role', 'avatar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Cari pengguna berdasarkan email
     */
    public function findByEmail(string $email)
    {
        return $this->where('email', strtolower(trim($email)))->first();
    }

    /**
     * Daftarkan pengguna baru dengan enkripsi password
     */
    public function registerUser(array $data)
    {
        $email = strtolower(trim($data['email']));
        $name = trim($data['name'] ?? 'Keluarga Parentela');
        $rawPassword = $data['password'];

        // Discreet role assignment
        $role = (str_starts_with($email, 'admin@') || $email === 'admin@parentela.id') ? 'admin' : 'user';

        return $this->insert([
            'name'     => $name,
            'email'    => $email,
            'password' => password_hash($rawPassword, PASSWORD_BCRYPT),
            'role'     => $role,
        ]);
    }
}
