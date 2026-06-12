@props(['cart', 'delete' => false])

<img src="{{ asset($cart->product->picture) }}" sizes="80px" class="image-5" alt="{{ $cart->product->name }}">

<div class="w-layout-vflex flex-block-3">
    <a href="{{ route('show.item', $cart->product) }}" class="link-11">
        {{ $cart->product->name }}
    </a>

    <div class="text-block-5">
        ￥{{ number_format($cart->product->val * 1.1) }}(税込み)
    </div>
</div>

@if($delete)
    <div class="w-layout-blockcontainer container-24 w-container">
        <form action="{{ route('cart.delete', $cart->id) }}" method="POST">
            @csrf
            <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                <img src="{{ asset('images/dustbox.png') }}" class="image-7" alt="削除">
            </button>
        </form>
    </div>
@endif