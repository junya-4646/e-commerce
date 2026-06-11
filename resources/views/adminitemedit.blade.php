@extends('layouts.app_login')
@section('content')
  <div class="w-layout-blockcontainer container-34 w-container">
    <h1>■商品登録</h1>
  </div>
  <div class="w-layout-blockcontainer w-container">
    <div class="w-form">

      <form action="{{ isset($editProduct) 
        ? route('admin.itemedit.update', $editProduct->id) 
        : route('admin.itemedit.add') }}" 
        id="email-form" 
        method="post" 
        enctype="multipart/form-data">

        @csrf
        <label>商品名</label>
        @error ('name')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="name" value="{{ old('name', $editProduct->name ?? '') }}">
        
        <label>税抜き値段</label>
        @error ('val')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="val" value="{{ old('val', $editProduct->val ?? '') }}">
        
        <label>説明</label>
        @error ('explanation')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <textarea maxlength="5000" id="field" name="explanation" class="w-input">{{ old('explanation', $editProduct->explanation ?? '') }}</textarea>

        @php
          $genreNumbers = [
            'Tシャツ' => '1',
            'Yシャツ' => '2',
            'セーター' => '3',
            'ロング' => '4',
            'コート' => '5',
            'ジャケット' => '6',
            'パンツ' => '7',
            'シューズ' => '8',
            'アクセサリー' => '9',
          ];

          $selectedGenre = old('genre', isset($editProduct) ? ($genreNumbers[$editProduct->genre] ?? '') : '');
        @endphp
        <label>ジャンル</label>
        <select id="field-2" name="genre" class="w-select" >
          <option value="1" {{ $selectedGenre == '1' ? 'selected' : '' }}>Tシャツ</option>
          <option value="2" {{ $selectedGenre == '2' ? 'selected' : '' }}>Yシャツ</option>
          <option value="3" {{ $selectedGenre == '3' ? 'selected' : '' }}>セーター</option>
          <option value="4" {{ $selectedGenre == '4' ? 'selected' : '' }}>ロング</option>
          <option value="5" {{ $selectedGenre == '5' ? 'selected' : '' }}>コート</option>
          <option value="6" {{ $selectedGenre == '6' ? 'selected' : '' }}>ジャケット</option>
          <option value="7" {{ $selectedGenre == '7' ? 'selected' : '' }}>パンツ</option>
          <option value="8" {{ $selectedGenre == '8' ? 'selected' : '' }}>シューズ</option>
          <option value="9" {{ $selectedGenre == '9' ? 'selected' : '' }}>アクセサリー</option>
        </select>

        <label>商品画像</label>
        <div class="div-block-9">
          <label for="picture" class="button-15 w-button">商品画像</label>
          <input type="file" 
            id="picture" 
            name="picture" 
            accept="image/*" 
            style="display: none;"
            onchange="document.getElementById('file-name').textContent = this.files.length ? this.files[0].name : 'FFFFFFFFFFFFFFFF.png';"
          >
          <div class="text-block-8" id="file-name">
            {{ isset($editProduct) ? $editProduct->picture : 'FFFFFFFFFFFFFFFF.png' }}
          </div>
        </div>
        <div class="div-block-10">
          <a href="{{ route('admin.home') }}" class="button-16 w-button">戻る</a>
          <input type="submit" class="submit-button-5 w-button" value="登録">
        </div>
      </form>
    </div>
  </div>
  @endsection