<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductWebController extends Controller
{
    public function index()
    {
        return view('products.index');
    }
}
