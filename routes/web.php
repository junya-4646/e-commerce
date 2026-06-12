<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminUserController;

// 
// 一般ユーザー：認証
//

Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');

Route::get('/register/confirm', [UserAuthController::class, 'showRegisterConfirm'])->name('register.confirm');
Route::post('/register/confirm', [UserAuthController::class, 'confirmRegister'])->name('register.confirm.post');
Route::get('/register/complete', [UserAuthController::class, 'showRegisterComplete'])->name('register.complete');
Route::post('/register/complete', [UserAuthController::class, 'completeRegister'])->name('register.complete.post');


//
// 一般ユーザー：商品閲覧
//
Route::get('/home', [ProductController::class, 'home'])->name('home');
Route::get('/itemlist', [ProductController::class, 'index'])->name('itemlist');
Route::get('/item/{id}', [ProductController::class, 'showItem'])->name('show.item');

Route::middleware('auth')->group(function () {
    //
    // 一般ユーザー：カート関連(ログイン後の一般ユーザーのみアクセス可能)
    //
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::post('/cart/{id}/delete', [CartController::class, 'destroy'])->name('cart.delete');

    //
    // 一般ユーザー：購入処理（ログイン後の一般ユーザーのみアクセス可能）
    //
    Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');

    Route::get('/cart/paymentcomplete', [PaymentController::class, 'showPaymentComplete'])->name('cart.payment.complete');

});


//
// 管理ユーザー：ログイン
//
Route::get('/admin/login', [AdminAuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');

Route::middleware('auth:admin')->group(function () {
    
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');


    //
    // 管理ユーザー：商品管理(ログイン後の管理ユーザーのみアクセス可能)
    //
    Route::get('/admin/itemedit', [AdminProductController::class, 'index'])->name('admin.itemedit');
    Route::post('/admin/itemedit/add', [AdminProductController::class, 'store'])->name('admin.itemedit.add');
    Route::post('/admin/itemedit/{id}/update', [AdminProductController::class, 'update'])->name('admin.itemedit.update');
    Route::post('/admin/itemedit/{id}/delete', [AdminProductController::class, 'destroy'])->name('admin.itemedit.delete');

    // 編集画面表示用
    Route::get('/admin/itemedit/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.itemedit.edit');


    //
    // 管理ユーザー：ユーザー登録(ログイン後の管理ユーザーのみアクセス可能)
    //
    Route::get('/admin/useredit', [AdminUserController::class, 'index'])->name('admin.useredit');
    Route::post('/admin/useredit/add', [AdminUserController::class, 'store'])->name('admin.useredit.add');

    
    // 編集画面表示用
    Route::get('/admin/useredit/{user_type}/{id}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.useredit.edit');

    // 更新処理用
    Route::post('/admin/useredit/{id}/update', [AdminUserController::class, 'update'])
        ->name('admin.useredit.update');

    Route::post('/admin/useredit/{id}/delete', [AdminUserController::class, 'destroy'])->name('admin.useredit.delete');
});
