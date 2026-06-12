@extends('layouts.app')
@section('content')
  <div class="w-layout-blockcontainer container-32 w-container">
    <h1 class="heading-20">■登録内容</h1>
    <div class="w-form">


      <form action="{{ route('register.confirm.post') }}" method="post">

        @csrf

        <label>ユーザー名</label>
        @error ('name')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="text" maxlength="256" name="name" value="{{ old('name') }}">

        <label>メールアドレス</label>
        @error ('email')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="email" maxlength="256" name="email" value="{{ old('email') }}">

        <label>電話番号</label>
        @error ('tel')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="tel" maxlength="256" name="tel" value="{{ old('tel') }}">
        
        <label>郵便番号</label>
        @error ('post')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="text" maxlength="256" name="post" value="{{ old('post') }}">

        <label>住所</label>
        @error ('address')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="text" maxlength="256" name="address" value="{{ old('address') }}">

        <label>パスワード</label>
        @error ('password')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="password" maxlength="256" name="password">

        <label>パスワード確認</label>
        @error ('password_confirmation')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" type="password" maxlength="256" name="password_confirmation">

        <div class="div-block-4">
          <a href="/" class="button-8 w-button">戻る</a>
          <input type="submit" class="submit-button-3 w-button" value="登録">
        </div>
      </form>
    </div>
  </div>
  @endsection