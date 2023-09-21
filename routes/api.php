<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // API routes for version 1

    Route::group(['namespace' => 'Api'], function(){

        // API routes for Product
        Route::group(['prefix' => 'product','namespace' => 'Product'], function(){
            Route::post('add-product','ProductController@addProduct');
        });

        // API routes for Department Stock
        Route::group(['prefix' => 'dep-stock','namespace' => 'DepStock'], function(){
            Route::post('add-dep-stock','DepartmentStockController@addDepStock');
        });

        // API routes for Department Stock
        Route::group(['prefix' => 'sales','namespace' => 'Sales'], function(){
            Route::post('sales-generate','SalesController@storeGenerate');
        });
    
    
    });
});



