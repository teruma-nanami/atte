<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
  @yield('css')
  <title>Atte</title>
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <h1>
          <a href="/" class="header__logo">Atte</a>
      </h1>
      <button class="header__sp" id="menuButton">
          <span class="sp-only">Menu</span>
      </button>
      <div class="header__nav" id="navMenu">
        <button class="header__close" id="closeButton">&times;</button>
        <ul>
          <li><a href="{{ asset('/') }}">ホーム</a></li>
          <li><a href="{{ asset('attendance') }}">日付一覧</a></li>
          <li><a href="{{ asset('users') }}">ユーザー一覧</a></li>
          <li>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit">ログアウト</button>
            </form>
          </li>
        </ul>
      </div>
    </div>
</header>
  <main>
    @yield('content')
  </main>
  <footer class="footer">
    <div class="footer__inner">Atte, inc.</div>
  </footer>
  <script src="{{ asset('js/humberger.js') }}"></script>
</body>
</html>