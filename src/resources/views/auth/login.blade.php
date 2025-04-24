@extends('layouts.application')

@section('content')
  <div class="container">
    <h2>ログイン</h2>
    <form action="/login" method="post" class="form">
      @csrf
      <div class="form__inner">
        <div class="form__inner-text">
          <input type="text" name="email" placeholder="メールアドレス">
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
        <div class="form__inner-text">
          <input type="password" name="password" placeholder="パスワード">
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
      <div>
        <label for="remember_me">
            <input id="remember_me" type="checkbox" name="remember">
            <span>ログイン状態を保存する</span>
        </label>
    </div>
      <button type="submit">ログイン</button>
    </form>
    <p>
      パスワードをお忘れのかたは<a href="{{ asset('forgot-password') }}">こちら</a>から<br>
      <a href="{{ asset('forgot-password') }}">パスワード再設定</a>
    </p>
    <p>
      アカウントをお持ちでない方は<a href="{{ asset('register') }}">こちら</a>から<br>
      <a href="{{ asset('register') }}">会員登録</a>
    </p>
  </div>
@endsection