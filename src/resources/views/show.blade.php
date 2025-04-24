@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css')}}">
@endsection

@section('content')
<main>
    <h2>{{ $user->name }}の勤務情報</h2>
    <table>
        <tr>
            <th>日付</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
    @foreach($attendances as $attendance)
    <tr>
        <td>{{ $attendance['date'] }}</td>
        <td>{{ $attendance['check_in'] }}</td>
        <td>{{ $attendance['check_out'] }}</td>
        <td>{{ $attendance['break_duration'] }}</td>
        <td>{{ $attendance['total_work_duration'] }}</td>
    </tr>
    @endforeach
    </table>
</main>
@endsection