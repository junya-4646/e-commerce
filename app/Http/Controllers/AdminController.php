<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Sale;

class AdminController extends Controller
{
    public function index()
    {

        // 商品情報取得
        $products = Product::all();

        // 売上情報取得
        $sales = Sale::with(['product', 'user'])
            ->orderBy('id', 'desc')
            ->get();

        // ユーザー情報取得
        $users = User::all();
        $admins = Admin::all();
        
        return view('admin', compact('products', 'sales', 'users', 'admins'));
    }
}
