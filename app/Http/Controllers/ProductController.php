<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use InvalidArgumentException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function getAllProducts()
    {
        try {
            $product = $this->productService->getAllProducts();
            return response()->json($product, 200);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching products.', 'errors' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function CreateProduct(Request $request)
    {
        $validateData = $request->validate([
            'ProductId'   => 'required|integer',
            'Name'        => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price'       => 'required|numeric|min:0',
            'Stock'       => 'required|integer|min:0',
        ]);

        try {
            $this->productService->createProduct($validateData);
            return response()->json(['message' => 'Product created successfully.', 'data' => $validateData], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error creating product.', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function getProductById(string $id)
    {
        try {
            $product = $this->productService->getProductById($id);
            return response()->json($product, 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching product.', 'errors' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct(Request $request, string $id)
    {
        $validateData = $request->validate([
            'Name'        => 'string|max:255',
            'Description' => 'nullable|string',
            'Price'       => 'numeric|min:0',
            'Stock'       => 'integer|min:0',
        ]);

        try {
            $product = $this->productService->updateProduct($id, $validateData);
            return response()->json(['message' => 'Product updated successfully.', 'data' => $product], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error updating product.', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProduct(string $id)
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }
}
