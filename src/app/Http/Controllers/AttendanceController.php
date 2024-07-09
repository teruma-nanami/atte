<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Breaktime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index() {
        return view('index');
    }

    public function checkIn() {

        $today = Carbon::today()->toDateString();


        // 既存の出勤記録がない場合のみ新規作成
        $attendance = Attendance::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => $today],
            ['check_in' => now()]
        );

        return redirect()->back()->with('success', '出勤しました');
    }

    public function checkOut() {

        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', Auth::id())
                                ->where('date', $today)
                                ->first();

        if ($attendance && is_null($attendance->check_out)) {
            // 休憩終了の処理を追加
            $breaktime = Breaktime::where('attendance_id', $attendance->id)
                                ->whereNull('break_end')
                                ->first();

            if ($breaktime) {
                $breaktime->update([
                    'break_end' => now(),
                ]);
            }

            $attendance->update([
                'check_out' => now(),
            ]);

            return redirect()->back()->with('success', '退勤しました');
        }

        return redirect()->back()->with('error', '本日は出勤していません。');
    }

    // 24時を超えた場合の自動退勤の処理
    public function autoCheckoutAndCheckin()
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $today = Carbon::today()->toDateString();

    // 昨日の未退勤記録を自動退勤
    Attendance::where('date', $yesterday)
              ->whereNull('check_out')
              ->each(function ($attendance) {
                try {
                    // 休憩終了の処理を追加
                    $breaktime = Breaktime::where('attendance_id', $attendance->id)
                                          ->whereNull('break_end')
                                          ->first();

                    if ($breaktime) {
                        $breaktime->update([
                            'break_end' => $attendance->date . ' 23:59:59',
                        ]);
                    }

                    $attendance->update([
                        'check_out' => $attendance->date . ' 23:59:59',
                    ]);
                } catch (\Exception $e) {
                    Log::error('Auto checkout failed for attendance ID: ' . $attendance->id . ' - ' . $e->getMessage());
                }
              });

        // 今日の自動出勤
        // Attendance::firstOrCreate(
        //     ['user_id' => Auth::id(),
        //     'date' => $today],
        //     ['check_in' => Carbon::today()->startOfDay()]
        // );
    }

    public function attendance(Request $request) {

        $date = $request->input('date', Carbon::today()->toDateString());
        $users = User::paginate(5);

        $attendances = $users->map(function ($user) use ($date) {
            $attendance = Attendance::where('user_id', $user->id)
                                    ->where('date', $date)
                                    ->first();

            if ($attendance) {
                $checkinTime = Carbon::parse($attendance->check_in);
                $checkoutTime = $attendance->check_out ? Carbon::parse($attendance->check_out) : Carbon::now();
                $workDuration = $checkinTime->diffInSeconds($checkoutTime);

                $breaktimes = Breaktime::where('attendance_id', $attendance->id)->get();
                $breakDuration = $breaktimes->reduce(function ($carry, $breaktime) {
                    $breakStart = Carbon::parse($breaktime->break_start);
                    $breakEnd = $breaktime->break_end ? Carbon::parse($breaktime->break_end) : Carbon::now();
                    return $carry + $breakStart->diffInSeconds($breakEnd);
                }, 0);

                $totalWorkDuration = $workDuration - $breakDuration;

                return [
                    'name' => $user->name,
                    'check_in' => $checkinTime->format('H:i:s'),
                    'check_out' => $attendance->check_out ? $checkoutTime->format('H:i:s') : null,
                    'break_duration' => gmdate('H:i:s', $breakDuration),
                    'total_work_duration' => gmdate('H:i:s', $totalWorkDuration),
                ];
            }

            return [
                'name' => $user->name,
                'check_in' => '00:00:00',
                'check_out' => '00:00:00',
                'break_duration' => '00:00:00',
                'total_work_duration' => '00:00:00',
            ];
        });

        return view('attendance', compact('attendances', 'date', 'users'));
    }

    public function userIndex()
    {
        $users = User::paginate(5);
        return view('users', compact('users'));
    }

    public function userShow(User $user)
    {
        $attendances = Attendance::where('user_id', $user->id)->get();

        $attendances = $attendances->map(function ($attendance) {
            $checkinTime = Carbon::parse($attendance->check_in);
            $checkoutTime = $attendance->check_out ? Carbon::parse($attendance->check_out) : Carbon::now();
            $workDuration = $checkinTime->diffInSeconds($checkoutTime);

            $breaktimes = Breaktime::where('attendance_id', $attendance->id)->get();
            $breakDuration = $breaktimes->reduce(function ($carry, $breaktime) {
                $breakStart = Carbon::parse($breaktime->break_start);
                $breakEnd = $breaktime->break_end ? Carbon::parse($breaktime->break_end) : Carbon::now();
                return $carry + $breakStart->diffInSeconds($breakEnd);
            }, 0);

            return [
                'date' => $attendance->date,
                'check_in' => $checkinTime->format('H:i:s'),
                'check_out' => $attendance->check_out ? $checkoutTime->format('H:i:s') : null,
                'break_duration' => gmdate('H:i:s', $breakDuration),
                'total_work_duration' => gmdate('H:i:s', $workDuration - $breakDuration),
            ];
        });

        return view('show', compact('user', 'attendances'));
    }
}
