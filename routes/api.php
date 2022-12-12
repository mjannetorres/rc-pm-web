<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\JobOrderController;
use App\Http\Controllers\WorkLogController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\JobOrderDetailController;
use App\Http\Controllers\WorkersController;
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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get('joborder/search', [JobOrderController::class, 'search']);
    Route::resource('joborder', JobOrderController::class);
    Route::resource('worklog', WorkLogController::class);
    Route::resource('workers', WorkersController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('orderdetails', JobOrderDetailController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

