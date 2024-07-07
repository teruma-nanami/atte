@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css')}}">
@endsection

@section('content')
<h2>
  <a href="{{ route('attendance', ['date' => \Carbon\Carbon::parse($date)->subDay()->toDateString()]) }}">＜</a>
  <span>{{ $date }}</span>
  <a href="{{ route('attendance', ['date' => \Carbon\Carbon::parse($date)->addDay()->toDateString()]) }}">＞</a>
</h2>
<table>
  <tbody>
    <tr>
      <th>名前</th>
      <th>勤務開始</th>
      <th>勤務終了</th>
      <th>休憩時間</th>
      <th>勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)
    <tr>
        <td>{{ $attendance['name'] }}</td>
        <td>{{ $attendance['check_in'] }}</td>
        <td>{{ $attendance['check_out'] }}</td>
        <td>{{ $attendance['break_duration'] }}</td>
        <td>{{ $attendance['total_work_duration'] }}</td>
    </tr>
@endforeach
  </tbody>
</table>
<div class="page__nav">
    {{ $users->appends(['date' => $date])->links() }}
  </div>
@endsection