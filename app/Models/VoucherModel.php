<?php

namespace App\Models;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['code', 'used', 'expiration_date'];

    public function getUnusedVoucher()
    {
        return $this->where('used', false)
                    ->where('expiration_date > NOW()')
                    ->first();
    }
}
