@extends('layouts.app_login')
@section('content')  
<div class="w-layout-blockcontainer container-36 w-container">
    <h1>■ユーザー登録</h1>
  </div>
  <div class="w-layout-blockcontainer container-35 w-container">
    <div class="w-form">
      <form action="{{ isset($editUser)
        ? route('admin.useredit.update', ['user_type' => $user_type, 'id' => $editUser->id])
        : route('admin.useredit.add') }}" method="POST">
        
        @csrf
        <label>ユーザー名</label>
        @error ('name')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="name" value="{{ old('name', $editUser->name ?? '') }}">
        
        <label>メールアドレス</label>
        @error ('email')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="email" value="{{ old('email', $editUser->email ?? '') }}">
        
        <label>電話番号</label>
        @error ('tel')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="tel" value="{{ old('tel', $editUser->tel ?? '') }}">
        
        <label>郵便番号</label>
        @error ('post')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="post" value="{{ old('post', $editUser->post ?? '') }}">
        
        <label>住所</label>
        @error ('address')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="address" value="{{ old('address', $editUser->address ?? '') }}">
        
        <label>パスワード</label>
        @error ('password')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="password">
        
        <label>パスワード確認</label>
        @error ('password_confirmation')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <input class="w-input" maxlength="256" name="password_confirmation">
        
        <label>ユーザー種別</label>
        @error ('user_type')
          <div style="color: red;">{{ $message }}</div>
        @enderror
        <select id="field" name="user_type" class="w-select">
          <option value="user" {{ (old('user_type', $user_type ?? '') === 'user') ? 'selected' : '' }}>一般</option>
          <option value="admin" {{ (old('user_type', $user_type ?? '') === 'admin') ? 'selected' : '' }}>管理者</option>
        </select>
        
        <div class="div-block-11">
          <a href="{{ route('admin.home') }}" class="button-17 w-button">戻る</a>
          <input type="submit" class="submit-button-6 w-button" value="登録">
        </div>
      </form>
    </div>
  </div>
  @endsection