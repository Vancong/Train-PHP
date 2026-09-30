<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;


Route::get('/orders/create', [OrderController::class, 'create']);

Route::get('/orders', [OrderController::class, 'index']);

Route::get('/orders/{id}', [OrderController::class, 'detail']);



Route::post('/orders/create', [OrderController::class, 'createSubmit']);

Route::get('/orders/edit/{id}', [OrderController::class, 'edit']);

Route::put('/orders/edit/{id}', [OrderController::class, 'editSubmit']);

Route::put('/orders/delete/{id}', [OrderController::class, 'delete']);

Route::get('/', function () {
    return view('welcome');
});
