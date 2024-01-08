<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\InvoiceModel;
use App\Models\VoucherModel;

class Checkout extends BaseController
{
    public function index($id)
    {
        $productModel = new ProductModel();
        $data['order'] = $productModel->getProductById($id);
        $data['title'] = "Checkout | Garuda Store";
        echo view('_partials/header', $data);
        echo view('_partials/navbar');
        echo view('homepage/vw_checkout', $data);
        echo view('_partials/footer');
    }

    public function applyVoucher($id)
    {
        $voucherCode = $this->request->getPost('voucherCode');

        $voucherModel = new VoucherModel();
        $voucher = $voucherModel->where('code', $voucherCode)
            ->where('used', false)
            ->where('expiration_date > NOW()')
            ->first();

        // Get the product price
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        $price = $product['price'];

        if ($voucher) {
            // Mark voucher as used
            // $voucherModel->update($voucher['id'], ['used' => true]);

            // Calculate the discounted total amount
            $discount = 10000;
            $discountedAmount = $price - $discount;

            $message = "Voucher berhasil digunakan!";
            $hasil = array(
                'message' => $message,
                'discount' => $discount,
                'amount' => $discountedAmount
            );
            echo json_encode($hasil);
        } else {
            $discount = 0;
            $message = "Voucher code tidak valid atau telah digunakan.";
            $hasil = array(
                'message' => $message,
                'discount' => $discount,
                'amount' => $price
            );
            echo json_encode($hasil);
        }
    }

    function generateUniqueCode($length = 8)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';

        $maxIndex = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $randomIndex = mt_rand(0, $maxIndex);
            $code .= $characters[$randomIndex];
        }

        return $code;
    }



    public function processCheckout()
    {
        $customerName = $this->request->getPost('customerName');
        $productName = $this->request->getPost('productName');
        $productPrice = $this->request->getPost('productPrice');
        $discount = $this->request->getPost('discount');
        $totalAmount = $this->request->getPost('totalAmount');
        $voucherCode = $this->request->getPost('voucherCode');

        $limit = 2000000; // Jika harga lebih atau sama dengan ini maka dapat voucher diskon

        $voucherModel = new VoucherModel();
        $voucher = $voucherModel->where('code', $voucherCode)
            ->where('used', false)
            ->where('expiration_date > NOW()')
            ->first();


        if ($totalAmount < $limit) {
            // Mark voucher as used
            if ($voucher) {
                $voucherModel->update($voucher['id'], ['used' => true]);
            }
            $voucherCode = '-';
            // Create a new invoice
            $invoiceModel = new InvoiceModel();
            $invoiceData = [
                'customer_name' => $customerName,
                'productName'      => $productName,
                'productPrice' => $productPrice,
                'discount' => $discount,
                'total_amount' => $totalAmount,
                'voucher_code' => $voucherCode
            ];
            $invoiceId = $invoiceModel->insert($invoiceData);
        } else {
            // Mark voucher as used
            if ($voucher) {
                $voucherModel->update($voucher['id'], ['used' => true]);
            }
            // Generate a new voucher
            $voucherModel = new VoucherModel();
            $voucherCode =  $this->generateUniqueCode();
            $expirationDate = date('Y-m-d', strtotime('+3 months')); // Set the expiration date (3 months from now)
            $voucherData = [
                'code' => $voucherCode,
                'used' => false,
                'expiration_date' => $expirationDate
            ];
            $voucherModel->insert($voucherData);

            // Create a new invoice with voucher
            $invoiceModel = new InvoiceModel();
            $invoiceData = [
                'customer_name' => $customerName,
                'productName'      => $productName,
                'productPrice' => $productPrice,
                'discount' => $discount,
                'total_amount' => $totalAmount,
                'voucher_code' => $voucherCode
            ];
            $invoiceId = $invoiceModel->insert($invoiceData);
        }





        return redirect()->to('/invoices/' . $invoiceId);
    }
}
