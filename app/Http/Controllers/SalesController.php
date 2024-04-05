<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales()
    {
        return view('sales.sales');
    }

    public function stock()
    {
        $stocks = [
            ['id' => 1, 'name' => 'Product A', 'quantity' => 10],
            ['id' => 2, 'name' => 'Product B', 'quantity' => 15],
            ['id' => 3, 'name' => 'Product C', 'quantity' => 20],
        ];

        return view('sales.stock', [
            'stocks' => $stocks
        ]);
    }
}
