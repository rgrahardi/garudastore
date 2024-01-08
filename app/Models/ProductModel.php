<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'price', 'image'];

    public function getProductById($productId)
    {
        $this->where('id', $productId);
        return $this->get();
    }

    public function getAllProduct()
    {
        return $this->get();
    }
}
