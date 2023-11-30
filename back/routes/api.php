<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiHotelsController;
use App\Http\Controllers\ApiBookingsController;
use App\Http\Controllers\ApiClientsController;


Route::get('/hotels', [ApiHotelsController::class, 'index']);
Route::post('/hotels', [ApiHotelsController::class, 'store']);

Route::get('/bookings', [ApiBookingsController::class, 'index']);
Route::get('/bookings/{id}', [ApiBookingsController::class, 'show']);
Route::get('/bookings/{id}/{name}/{status}', [ApiBookingsController::class, 'edit']);
Route::post('/bookings/', [ApiBookingsController::class, 'store']);
Route::post('/bookings/update', [ApiBookingsController::class, 'update']);

Route::get('/clients/{id}', [ApiClientsController::class, 'show']);
