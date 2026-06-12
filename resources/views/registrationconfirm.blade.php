@extends('layouts.app')
@section('content')
  <div class="w-layout-blockcontainer w-container">
    <h1>■登録情報確認</h1>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●ユーザー名</h2>
      <div class="text-block-9">{{ $data['name'] }}</div>
    </div>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●メールアドレス</h2>
      <div class="text-block-9">{{ $data['email'] }}</div>
    </div>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●電話番号</h2>
      <div class="text-block-9">{{ $data['tel'] }}</div>
    </div>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●郵便番号</h2>
      <div class="text-block-9">{{ $data['post'] }}</div>
    </div>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●住所</h2>
      <div class="text-block-9">{{ $data['address'] }}</div>
    </div>

    <div class="w-layout-blockcontainer w-container">
      <h2 class="heading-22">●パスワード</h2>
      <div class="text-block-9">XXXXXXXXXXXXXXX</div>
    </div>

  </div>

  <div class="w-layout-blockcontainer container-29 w-container">

    <a href="{{ route('register') }}" class="button-7 w-button">戻る</a>

    <!-- 登録完了画面へ遷移するためのリンク -->
    <form action="{{ route('register.complete.post') }}" method="post" style="display: inline;">
      @csrf
      <input type="hidden" name="name" value="{{ $data['name'] }}">
      <input type="hidden" name="email" value="{{ $data['email'] }}">
      <input type="hidden" name="tel" value="{{ $data['tel'] }}">
      <input type="hidden" name="post" value="{{ $data['post'] }}">
      <input type="hidden" name="address" value="{{ $data['address'] }}">
      <input type="hidden" name="password" value="{{ $data['password'] }}">
      
      <input type="submit" class="button-6 w-button" value="登録を行う">
    </form>
  </div>
  @endsection