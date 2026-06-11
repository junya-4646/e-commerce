<img src="{{ asset($product->picture) }}" sizes="(max-width: 767px) 37vw, 200px"  class="image" alt="{{ $product->name }}">
<div class="w-layout-vflex">
  <a href="{{ route('show.item', $product->id) }}">
    <h2 class="heading-2">{{ $product->name }}</h2>
  </a>
  <h2 class="heading-2">￥{{ number_format(round($product->val * 1.1)) }}(税込み)</h2>
</div>