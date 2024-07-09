@extends('layouts.application')

@section('content')
<div class="container">
  <h2>会員登録</h2>
  <form action="/register" method="post" class="form">
    @csrf
    <div class="form__inner">
      <div class="form__inner-text">
        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
      </div>
      <div class="form__error">
        @error('name')
        {{ $message }}
        @enderror
      </div>
      <div class="form__inner-text">
        <input type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
      </div>
      <div class="form__error">
        @error('email')
        {{ $message }}
        @enderror
      </div>
      <div class="form__inner-text">
        <input type="password" name="password" placeholder="パスワード">
      </div>
      <div class="form__inner-text">
        <input type="password" name="password_confirmation" placeholder="確認用パスワード">
      </div>
      <div class="form__error">
        @error('password')
        {{ $message }}
        @enderror
      </div>        </div>
    <button type="submit">会員登録</button>
  </form>
  <p>
    アカウントをお持ちの方はこちらから<br>
    <a href="{{ asset('login') }}">ログイン</a>
  </p>
</div>
@endsection