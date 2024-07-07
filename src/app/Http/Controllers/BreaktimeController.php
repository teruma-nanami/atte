<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Breaktime;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BreaktimeController extends Controller
{
    public function breakstart() {

        $today = Carbon::today()->toDateString();

        // 当日の出勤記録を取得
        $attendance = Attendance::where('user_id', Auth::id())
                                ->where('date', $today)
                                ->first();

        if ($attendance) {
            if ($attendance->check_out) {
                return redirect()->back()->with('error', '勤務終了後に休憩に入ることはできません。');
            }
            Breaktime::create([
                'attendance_id' => $attendance->id,
                'break_start' => now(),
            ]);

        return redirect()->back()->with('success', '休憩時間に入ります(仮)');
        }
        return redirect()->back()->with('error', '本日は出勤していません。');
    }

    public function breakend() {

        $today = Carbon::today()->toDateString();

        // 当日の出勤記録を取得
        $attendance = Attendance::where('user_id', Auth::id())
                                ->where('date', $today)
                                ->first();

        if ($attendance) {
            $breaktime = Breaktime::where('attendance_id', $attendance->id)
                                ->whereNull('break_end')
                                ->first();

            if ($breaktime) {
                $breaktime->update([
                    'break_end' => now(),
                ]);

                return redirect()->back()->with('success', '休憩が終わりました(仮)');
            }
            return redirect()->back()->with('error', '休憩に入っていません');
        }

        return redirect()->back()->with('error', '本日は出勤していません。');
    }
}
