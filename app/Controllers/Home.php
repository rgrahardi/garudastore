<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getAllProduct();
        $data['title'] = "Beranda | Garuda Store";
        echo view('_partials/header', $data);
        echo view('_partials/navbar');
        echo view('homepage/vw_homepage', $data);
        echo view('_partials/footer');
    }
}
