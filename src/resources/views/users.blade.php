@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/users.css')}}">
@endsection

@section('content')
<main>
  <h2>ユーザー一覧</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>ユーザー名</th>
      <th>メールアドレス</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td><a href="{{ route('show', $user->id) }}">{{ $user->name }}</a></td>
      <td>{{ $user->email }}</td>
    </tr>
  </table>
  @endforeach
  <div class="page__nav">
    {{ $users->links() }}
  </div>
</main>
@endsection