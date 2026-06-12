<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use App\Models\Sale;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function checkout(Request $request) {

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart');
        }

        $lineItems = [];

        foreach ($carts as $cart) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $cart->product->name,
                        'description' => 'これはデモ決済です',
                    ],
                    'unit_amount' => round($cart->product->val * 1.1),
                ],
                'quantity' => 1,
            ];
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('cart.payment.complete') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart'),
        ]); 

        return redirect($session->url);
    }


    public function showPaymentComplete(Request $request) {

        if (!$request->has('session_id')) {
            return redirect()->route('cart');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::retrieve($request->session_id);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('cart');
        }

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return view('paymentcomplete');
        }

        $paymentIntent = PaymentIntent::retrieve([
            'id' => $session->payment_intent,
            'expand' => ['payment_method'],
        ]);

        $last4 = $paymentIntent->payment_method->card->last4 ?? null;

        $creditNumber = $last4
            ? '**** **** **** ' . $last4
            : '不明';

        foreach ($carts as $cart) {
            Sale::create([
                'product_id' => $cart->product_id,
                'user_id' => Auth::id(),
                'credit_number' => $creditNumber,
                'purchase_at' => now(),
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();

        return view('paymentcomplete');
    }
}
