<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function home() {
        
        $products = Product::latest()->take(8)->get();

        return view('index', compact('products'));
    }

    public function index(Request $request) {

        $query = Product::query();

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }
        
        $products = $query
            ->orderBy('id', 'asc')
            ->paginate(16)
            ->appends($request->query());

        return view('itemlist', compact('products'));
    }

    public function showItem($id) {

        $product = Product::findOrFail($id);
        
        return view('item', compact('product'));
    }
}
