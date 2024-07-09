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
  <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>



<div class="grid">
  <form class="grid__inner" method="POST" action="/checkin">
    @csrf
    <button id="start" type="submit" value="work-in">勤務開始</button>
  </form>
  <form class="grid__inner" method="POST" action="/checkout">
    @csrf
    <button id="end" type="submit" value="work-out" disabled>勤務終了</button>
  </form>
  <form class="grid__inner" method="POST" action="/breakstart">
    @csrf
    <button id="breakStart" type="submit" value="break-in">休憩開始</button>
  </form>
  <form class="grid__inner" method="POST" action="/breakend">
    @csrf
    <button id="breakEnd" type="submit" value="break-out" disabled>休憩終了</button>
  </form>
</div>

</main>
<script src="{{ asset('js/toggle.js') }}"></script>
@endsection