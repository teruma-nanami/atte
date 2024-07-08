<!-- resources/views/auth/verify-email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">
    <title>Thank You!</title>
</head>
<body>
    <h2>仮登録ありがとうございました</h2>
    <p>メールを送信いたしましたので、メールを確認してください。
        {{-- <a href="{{ route('verification.send') }}">click here to request another</a>. --}}
    </p>
</body>
</html>
