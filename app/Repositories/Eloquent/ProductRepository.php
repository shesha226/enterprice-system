<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProductRepositoryInterface;
use  App\Models\Product;


class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function getProductByName($name)
    {
        return Product::where('Name', $name)->first();
    }

    public function createProduct(array $data)
    {
        $product = Product::create($data);
        return $product;
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->getProductById($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = $this->getProductById($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
