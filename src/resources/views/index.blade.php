@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')

<main>
  <div class="nation">
    @if(session('success'))
    <p class="success">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p class="error">{{ session('error') }}</p>
    @endif
  </div>
  <h2>福場林太郎さんお疲れ様です！</h2>



<div class="grid">
  <form class="grid__inner" method="POST" action="/checkin">
    @csrf
    <button class="" type="submit" value="work-in">勤務開始</button>
  </form>
  <form class="grid__inner" method="POST" action="/checkout">
    @csrf
    <button class="" type="submit" value="work-out">勤務終了</button>
  </form>
  <form class="grid__inner" method="POST" action="/breakstart">
    @csrf
    <button class="" type="submit" value="break-in">休憩開始</button>
  </form>
  <form class="grid__inner" method="POST" action="/breakend">
    @csrf
    <button class="" type="submit" value="break-out">休憩終了</button>
  </form>
</div>

</main>
@endsection