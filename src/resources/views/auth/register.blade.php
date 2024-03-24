@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('auth/register.css') }}">
@endsection

@section('content')
<div class="register__content">
  <div class="register-form__heading">
    <h2>会員登録</h2>
  </div>
  <form class="form" action="/register" method="post">
    @csrf
    <div class="form__group">
      <input type="text" name="name" placeholder="名前" value="{{ old('name') }}"/ >
    </div>
    <div class="form__group">
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" />
    </div>
    <div class="form__group">
      <input type="password" name="password" placeholder="パスワード" />
    </div>
    <div class="form__group">
      <input type="password" name="password_confirmation" placeholder="確認用パスワード" >
    </div>
    <div class="form__button">
      <button type="submit" class="register-button">会員登録</button>
    </div>
  </form>
  <div class="login-link">
      <p>アカウントをお持ちの方はこちらから</p>
      <a href="/login">ログイン</a>
  </div>
</div>
@endsection