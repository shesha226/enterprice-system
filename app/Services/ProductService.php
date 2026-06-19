<?php

namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Exception;


class ProductService
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        try {
            return $this->productRepository->getAllProducts();
        } catch (Exception $e) {
            Log::error('Error fetching all products: ' . $e->getMessage());
            throw $e;
        }
    }
    public function getProductById(int $id)
    {
        try {
            $product = $this->productRepository->getProductById($id);
            if (!$product) {
                throw new InvalidArgumentException('Product not found.');
            }
            return $product;
        } catch (Exception $e) {
            Log::error('Error fetching product by ID: ' . $e->getMessage());
            throw $e;
        }
    }

    public function createProduct(array $data)
    {
        try {
            $product = $this->productRepository->createProduct($data);
            if ($product) {
                throw new InvalidArgumentException('product with this ID already exists.');
            }
            return $product;
        } catch (Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateProduct(int $id, array $data)
    {
        try {
            $product = $this->productRepository->getProductById($id);
            if (!$product) {
                throw new InvalidArgumentException('Product not found.');
            }
            return $this->productRepository->updateProduct($id, $data);
        } catch (Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteProduct(int $id)
    {
        try {
            $product = $this->productRepository->getProductById($id);
            if (!$product) {
                throw new InvalidArgumentException('Product not found.');
            }
            return $this->productRepository->deleteProduct($id);
        } catch (Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            throw $e;
        }
    }
}
