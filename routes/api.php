<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PromoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


 
 

 
Route::group(['middleware' => ['auth','role.check:admin']], function () {
    Route::apiResource("admin/users",UserController::class);
    Route::apiResource("admin/promos", PromoController::class);

    Route::apiResource("admin/classrooms",ClassroomController::class);  
});
 
// Route::group(['middleware' => ['auth','role.check:admin']], function () {
//     // Route::apiResource("teacher/lossons",LossonsController::class);  
// });