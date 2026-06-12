@extends('layouts.app')
@section('content') 
  <div class="w-layout-blockcontainer container-33 w-container">
    <div class="w-form">
      <form action="{{ route('login.post') }}" method="post">
        @csrf
        <label>メールアドレス</label>

        @error ('email')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" maxlength="256" name="email" value="{{ old('email') }}">
        
        <label>パスワード</label>
        @error ('password')
          <p style="color: red;">{{ $message }}</p>
        @enderror
        <input class="w-input" maxlength="256" name="password" type="password">
        
        <div class="div-block-5">
            <input type="submit" class="submit-button-4 w-button" value="login">
        </div>
      </form>
    </div>
    <div class="div-block-6">
      <a href="{{ route('register') }}" class="link-14">ユーザー登録はこちら</a>
    </div>
  </div>
@endsection