<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesWebController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }
}
