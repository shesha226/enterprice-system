<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'SaleId';

    protected $fillable = [
        'SaleId',
        'ProductId',
        'Quantity',
        'TotalPrice',
        'SaleDate',
        'user_id'
    ];

    public $timestamps = false;
}
