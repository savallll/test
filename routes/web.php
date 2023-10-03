<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[SiteController::class,'index']);

Route::get('/login',[LoginController::class,'index']);

Route::post('/login/auth',[LoginController::class,'auth']);

Route::get('/register',[LoginController::class,'register']);

Route::post('/register/submit',[LoginController::class,'register_submit']);

Route::get('/menu/{category}',[CategoryController::class,'index']);

Route::get('/product/{product_id}',[ProductController::class,'index']);

Route::get('/user/logout',[LoginController::class,'logout']);

Route::post('/addCart/{id}',[CartController::class,'create']);

Route::get('/showCart',[CartController::class,'index']);








