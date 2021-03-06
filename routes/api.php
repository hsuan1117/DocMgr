<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/users/query', [\App\Http\Controllers\UserController::class,'query'])->name('users.query');
Route::post('/users/get', [\App\Http\Controllers\UserController::class,'getUser'])->name('users.get');

Route::post('/users/department',[\App\Http\Controllers\DepartmentController::class,'queryDepartmentUsers'])->name('users.departments.query');
