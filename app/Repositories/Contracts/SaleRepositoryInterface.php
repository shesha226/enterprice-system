<?php

namespace App\Http\Repositories\Contracts;

interface SaleRepositoryInterface
{
    public function createSale(array $data);
    public function getSalesByUser($userId);
    public function getAllSales();
    public function getSaleById($saleId);
    public function updateSale($saleId, array $data);
    public function deleteSale($saleId);
}
