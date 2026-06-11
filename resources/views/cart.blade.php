@extends('layouts.app')
@section('content') 
<div class="w-layout-blockcontainer container-25 w-container">
    <div class="w-layout-blockcontainer w-container">
        <h1 class="heading-16">■カート内容</h1>
    </div>
    <ul role="list" class="w-list-unstyled">
        @foreach($carts as $cart)
            <li class="list-item">
                <x-cart_item :delete="true" :cart="$cart" />
            </li>
        @endforeach
    </ul>
</div>

<div class="w-layout-blockcontainer w-container">
    <h1 class="heading-17">■商品合計</h1>
    <h2 class="heading-17">￥{{ number_format($total)}}(税込み)</h2>
</div>

<div class="w-layout-blockcontainer container-27 w-container">
    <a href="{{ route('itemlist') }}" class="button-4 w-button">
        買い物を続ける
    </a>

    <form action="{{ route('checkout') }}" method="POST" >
        @csrf

        <button type="submit" class="button-3 w-button">
            決済に進む
        </button>
    </form>
</div>
@endsection