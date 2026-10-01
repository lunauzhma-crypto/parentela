<?php
namespace App\Models;

use CodeIgniter\Model;

class ShopProductModel extends Model
{
    protected $table            = 'shop_products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name', 'subtext', 'category', 'shopee_link', 'badge', 'image', 'is_active'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
