<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index() {
        return view('index');
    }

    public function checkin() {

        $today = Carbon::today()->toDateString();


        // 既存の出勤記録がない場合のみ新規作成
        $attendance = Attendance::firstOrCreate(
            ['user_id' => Auth::id(), 'date' => $today],
            ['check_in' => now()]
        );

        return redirect()->back()->with('success', '出勤しました');
    }

    public function checkout() {

        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', Auth::id())
                                ->where('date', $today)
                                ->first();

        if ($attendance && is_null($attendance->check_out)) {
            $attendance->update([
                'check_out' => now(),
            ]);
            return redirect()->back()->with('success', '退勤しました');
        }

        return redirect()->back()->with('error', '本日は出勤していません。');
    }

    public function attendance() {

        return view('attendance');
    }
}
