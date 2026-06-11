<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return round($cart->product->val * 1.1);
        });

        return view('cart', compact('carts', 'total'));
    }

    public function store(Request $request) {

        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        Cart::create([
            'product_id' => $data['product_id'],
            'user_id' => Auth::id(),
            'cart_at' => now(),
        ]);

        return redirect()->route('cart');
    }


    public function destroy($id) {

        Cart::findOrFail($id)->delete();
        
        return redirect()->route('cart');
    }

}
