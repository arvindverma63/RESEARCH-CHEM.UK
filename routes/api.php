<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Services\ContentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/bank-transfer/place-order', [OrderController::class, 'placeBankTransferOrder']);
Route::post('/contact/{formName}', [ContactController::class, 'submit']);

Route::get('/health', function () {
    return response()->json(['status' => 'healthy', 'timestamp' => now()->toIso8601String()]);
});

Route::get('/commerce/products', function (Request $request) {
    $products = array_values(ContentService::getAllProducts());
    return response()->json(['products' => $products]);
});

Route::get('/commerce/products/{id}', function (string $id) {
    $product = ContentService::getProduct($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }
    return response()->json(['product' => $product]);
});

