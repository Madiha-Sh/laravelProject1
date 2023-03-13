<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Create
Route::post('/user/signup', [UsersController::class, 'store']);

// Retrieve
Route::get('/users', [UsersController::class, 'index']);

// Update
Route::post('/user/{id}/update', [UsersController::class, 'update']);

// Delete
Route::delete('/user/{id}/delete', [UsersController::class, 'destroy']);