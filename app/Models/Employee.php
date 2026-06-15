<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'EmployeeId';
    protected $fillable = [
        'EmployeeId',
        'Name',
        'Address',
        'Age',
        'Department',
        'Salary'
    ];
}
