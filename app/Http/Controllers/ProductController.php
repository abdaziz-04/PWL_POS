<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            ['id' => 1, 'name' => 'Product A', 'price' => 10000],
            ['id' => 2, 'name' => 'Product B', 'price' => 15000],
            ['id' => 3, 'name' => 'Product C', 'price' => 20000],
        ];

        return view('barang', [
            'products' => $products
        ]);
    }
}
