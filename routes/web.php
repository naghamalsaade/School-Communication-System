<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'],function (){

    //بدون صلاحيات
    //login student
    Route::post('login', [App\Http\Controllers\Auth\Admin\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum', 'abilities:admin-api']], function () {
       
        //من صلاحيات المدير
        Route::get('/',function(){dd('Hello Iam Admin ^-^');});

        //logout student
        Route::post('logout', [App\Http\Controllers\Auth\Admin\AuthController::class, 'logout']);
    });
});

