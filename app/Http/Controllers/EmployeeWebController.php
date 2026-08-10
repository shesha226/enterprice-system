<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeWebController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }
}
