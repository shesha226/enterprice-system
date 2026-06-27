<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class SaleController extends Controller
{
    public function createSale(Request $request)
    {
        try {
            $request->validate([
                'ProductID' => 'required|integer',
                'Quantity' => 'required|integer',
                'TotalPrice' => 'required|numeric',
            ]);

            $currentUser = Auth::user();
            if (!$currentUser) {
                return response()->json(['error' => 'User not authenticated'], 401);
            }

            $sale = Sale::create([
                'ProductId' => $request->input('ProductID'),
                'Quantity' => $request->input('Quantity'),
                'TotalPrice' => $request->input('TotalPrice'),
                'SaleDate' => now(),
                'user_id' => $currentUser->id,
            ]);

            return response()->json(['message' => 'Sale created successfully.', 'data' => $sale], 201);
        } catch (\Exception $e) {
            Log::error('Error creating sale: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while creating the sale.'
            ], 500);
        }
    }

    public function getSalesByUser($userId)
    {
        try {
            $sales = Sale::where('user_id', $userId)->get();
            if ($sales->isEmpty()) {
                return response()->json(['message' => 'No sales found for this user.'], 404);
            }
            return response()->json(['data' => $sales], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching sales: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while fetching the sales.'
            ], 500);
        }
    }

    public function getAllSales(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);

            $sales = Sale::with('salesman')->paginate($perPage);

            if ($sales->isEmpty()) {
                return response()->json([
                    'message' => 'No sales found in the database.',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'message' => 'Sales fetched successfully with pagination.',
                'current_page' => $sales->currentPage(),
                'last_page' => $sales->lastPage(),
                'per_page' => $sales->perPage(),
                'total_sales' => $sales->total(),
                'data' => $sales->items()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching paginated sales data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getSaleById($saleId)
    {
        try {
            $sale = Sale::find($saleId);
            if (!$sale) {
                return response()->json(['message' => 'Sale not found.'], 404);
            }
            return response()->json(['data' => $sale], 200);
        } catch (\Exception $e) {
            Log::error('Error fetching sale by ID: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while fetching the sale.'
            ], 500);
        }
    }


    public function updateSale(Request $request, $saleId)
    {
        try {
            $sale = Sale::find($saleId);
            if (!$sale) {
                return response()->json(['message' => 'Sale not found.'], 404);
            }

            $request->validate([
                'ProductID' => 'sometimes|required|integer',
                'Quantity' => 'sometimes|required|integer',
                'TotalPrice' => 'sometimes|required|numeric',
            ]);

            $sale->update($request->only(['ProductID', 'Quantity', 'TotalPrice']));

            return response()->json(['message' => 'Sale updated successfully.', 'data' => $sale], 200);
        } catch (\Exception $e) {
            Log::error('Error updating sale: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while updating the sale.'
            ], 500);
        }
    }

    public function deleteSale($saleId)
    {
        try {
            $sale = Sale::find($saleId);
            if (!$sale) {
                return response()->json(['message' => 'Sale not found.'], 404);
            }
            $sale->delete();
            return response()->json(['message' => 'Sale deleted successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error deleting sale: ' . $e->getMessage());
            return response()->json([
                'error' => 'An error occurred while deleting the sale.'
            ], 500);
        }
    }
}
