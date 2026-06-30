<?php

namespace App\Services;

use App\Repositories\Contracts\App\Http\Repositories\Contracts\SaleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Exception;


class SalesService
{
    protected $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getAllSales()
    {
        try {
            return $this->saleRepository->getAllSales();
        } catch (Exception $e) {
            Log::error('Error fetching all sales: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getSaleById(int $id)
    {
        try {
            $sale = $this->saleRepository->getSaleById($id);
            if (!$sale) {
                throw new InvalidArgumentException('Sale not found.');
            }
            return $sale;
        } catch (Exception $e) {
            Log::error("Error fetching sale ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }

    public function createSale(array $data)
    {
        DB::beginTransaction();
        try {
            $existingSale = $this->saleRepository->getSaleById($data['SaleID'] ?? null);
            if ($existingSale) {
                throw new InvalidArgumentException('Sale with this ID already exists.');
            }
            $sale = $this->saleRepository->createSale($data);
            DB::commit();
            return $sale;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating sale: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateSale(int $id, array $data)
    {
        DB::beginTransaction();
        try {
            $sale = $this->saleRepository->getSaleById($id);
            if (!$sale) {
                throw new InvalidArgumentException('Sale not found.');
            }
            $updatedSale = $this->saleRepository->updateSale($id, $data);
            DB::commit();
            return $updatedSale;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating sale ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteSale(int $id)
    {
        DB::beginTransaction();
        try {
            $sale = $this->saleRepository->getSaleById($id);
            if (!$sale) {
                throw new InvalidArgumentException('Sale not found.');
            }
            $this->saleRepository->deleteSale($id);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting sale ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }
}
