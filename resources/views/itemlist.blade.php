@extends('layouts.app')
@section('content') 
<div class="w-layout-blockcontainer container-22 w-container">
    <div class="w-form">
      <form action="{{ route('itemlist') }}" method="GET" class="form">
        <label for="field">ジャンル</label>

        <div class="w-layout-hflex">
            <select id="genre" name="genre" class="w-select">
              <option value="">すべて</option>
              <option value="Tシャツ" {{ request('genre') === 'Tシャツ' ? 'selected' : '' }}>Tシャツ</option>
              <option value="Yシャツ" {{ request('genre') === 'Yシャツ' ? 'selected' : '' }}>Yシャツ</option>
              <option value="セーター" {{ request('genre') === 'セーター' ? 'selected' : '' }}>セーター</option>
              <option value="ロング" {{ request('genre') === 'ロング' ? 'selected' : '' }}>ロング</option>
              <option value="コート" {{ request('genre') === 'コート' ? 'selected' : '' }}>コート</option>
              <option value="ジャケット" {{ request('genre') === 'ジャケット' ? 'selected' : '' }}>ジャケット</option>
              <option value="パンツ" {{ request('genre') === 'パンツ' ? 'selected' : '' }}>パンツ</option>
              <option value="シューズ" {{ request('genre') === 'シューズ' ? 'selected' : '' }}>シューズ</option>
              <option value="アクセサリー" {{ request('genre') === 'アクセサリー' ? 'selected' : '' }}>アクセサリー</option>
            </select>
            
            <input type="submit" data-wait="Please wait..." class="submit-button w-button" value="検索">
        </div>
      </form>
    </div>
</div>
@foreach ($products->chunk(4) as $productRow)
  <div class="w-layout-blockcontainer container-3 w-container itemlist-row">
    @foreach ($productRow as $product)
      <div class="w-layout-blockcontainer container-9 w-container itemlist-item">
        <x-item_component :product="$product"/>
      </div>
    @endforeach
  </div>
@endforeach
<div class="w-layout-blockcontainer container-3 w-container paginate">
  <div class="w-layout-hflex flex-block-2">
    @if ($products->onFirstPage())
      <span class="link-4">&lt;</span>
    @else
      <a href="{{ $products->previousPageUrl() }}" class="link-4">&lt;</a>
    @endif

    @for ($page = 1; $page <= $products->lastPage(); $page++)
      @if ($page == $products->currentPage())
        <span class="link-5">{{ $page }}</span>
      @else
        <a href="{{ $products->url($page) }}" class="link-5">{{ $page }}</a>
      @endif
    @endfor

    @if ($products->hasMorePages())
      <a href="{{ $products->nextPageUrl() }}" class="link-9">&gt;</a>
    @else
      <span class="link-9">&gt;</span>
    @endif
  </div>
</div>
@endsection