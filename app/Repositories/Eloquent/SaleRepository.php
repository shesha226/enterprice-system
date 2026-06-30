<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Http\Repositories\Contracts\SaleRepositoryInterface;


class SaleRepository implements SaleRepositoryInterface
{

    public function createSale(array $data)
    {
        return Sale::create($data);
    }

    public function getSalesByUser($userId)
    {
        return Sale::where('user_id', $userId)->get();
    }

    public function getAllSales()
    {
        return Sale::all();
    }

    public function getSaleById($saleId)
    {
        return Sale::where('SaleId', $saleId)->first();
    }

    public function updateSale($saleId, array $data)
    {
        $sale = $this->getSaleById($saleId);
        if ($sale) {
            $sale->update($data);
        }
        return $sale;
    }

    public function deleteSale($saleId)
    {
        $sale = $this->getSaleById($saleId);
        if ($sale) {
            return $sale->delete();
        }
        return false;
    }
}
