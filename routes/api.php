<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// ROOT
Route::get('/', function () {
    return response()->json(
        [
            'message' => 'Adoorei API'
        ]
    );
});

Route::middleware('api')->group(function () {
    // PRODUTOS
    Route::apiResource('product', ProductController::class)
    ->except(['create', 'edit']);
});
