<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return response()->json([
        'message' => 'hello wolrd',
        'status' => 'success'
    ]);
});


//Route::get('/students', [StudentController::class, 'index']);
//Route::post('/students', [StudentController::class, 'store']);
//Route::put('/students/{id}', [StudentController::class, 'update']);
//Route::delete('/students/{id}', [StudentController::class, 'destroy']);
//Route::get('/cars',[CarsController::class, 'index']);
//Route::post('/cars',[CarsController::class, 'store']);
//Route::put('/cars/{id}',[CarsController::class, 'update']);
//Route::delete('/cars/{id}',[CarsController::class, 'destroy']);
//Route::get('/cars/{id}',[CarsController::class, 'show']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => 'students'], function () {
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::get('/', [StudentController::class, 'index']);
        Route::post('/', [StudentController::class, 'store']);
        Route::put('/{id}', [StudentController::class, 'update']);
        Route::delete('/{id}', [StudentController::class, 'destroy']);
    });
    Route::group( ['prefix' => 'cars'], function () {
        Route::get('/', [CarsController::class, 'index']);
        Route::post('/', [CarsController::class, 'store']);
        Route::put('/{id}', [CarsController::class, 'update']);
        Route::delete('/{id}', [CarsController::class, 'destroy']);
        Route::get('/{id}', [CarsController::class, 'show']);

    });



    /*Route::get('/cars', [CarsController::class, 'index']);
    Route::post('/cars', [CarsController::class, 'store']);
    Route::put('/cars/{id}', [CarsController::class, 'update']);
    Route::delete('/cars/{id}', [CarsController::class, 'destroy']);
    Route::get('/cars/{id}', [CarsController::class, 'show']);*/

    Route::post('/logout', [AuthController::class, 'logout']);
});
