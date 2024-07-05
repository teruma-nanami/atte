@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<h2>福場林太郎さんお疲れ様です！</h2>

<form class="grid" method="POST">
  <button class="grid__inner" type="submit" value="work-in">勤務開始</button>
  <button class="grid__inner no-click" type="submit" value="work-out">勤務終了</button>
  <button class="grid__inner" type="submit" value="break-in">休憩開始</button>
  <button class="grid__inner no-click" type="submit" value="break-out">休憩終了</button>
</form>


@endsection