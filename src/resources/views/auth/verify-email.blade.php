@extends('layouts.application')

@section('content')
<div class="container">
  <h2>仮登録ありがとうございます</h2>
  <p>ご登録いただきましたメールアドレスにメールを送信いたしましたので、メールをご確認後、リンクをクリックしてください。
      {{-- <a href="{{ route('verification.send') }}">click here to request another</a>. --}}
  </p>
</div>
@endsection
