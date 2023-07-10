<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/', [HomeController::class, 'index']);
Route::post('/dang-nhap', [LoginController::class, 'login']);
Route::post('/dang-ki', [LoginController::class, 'register']);
Route::get('/dang-xuat', [LoginController::class, 'logout']);
Route::get('/tat-ca-san-pham', [ProductController::class, 'show_all']);
Route::get('/chi-tiet-san-pham/{id_product}', [ProductController::class, 'index']);
Route::get('/danh-muc-san-pham/{id_category}', [CategoryController::class, 'index']);
Route::get('/trang-ca-nhan/{id_account}', [ProfileController::class, 'index']);
Route::get('/dat-hang/{id_account}', [CheckoutController::class, 'index']);
Route::post('/su-dung-voucher', [CheckoutController::class, 'voucher']);
Route::post('/chi-tiet-san-pham/{id_product}', [ProductController::class, 'add_to_cart']);
Route::get('/xoa-khoi-gio/{id_product}', [ProductController::class, 'delete_cart']);