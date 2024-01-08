<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_name', 'productName', 'productPrice', 'discount', 'total_amount', 'voucher_code'];

    public function getInvoiceById($id)
    {
        $this->where('id', $id);
        return $this->get();
    }
}
