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
    Route::controller(ProductController::class)
    ->prefix('product')->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});
