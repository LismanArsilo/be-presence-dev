<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with(['user'])->when($request->input('username'), function ($query, $username) {
            $query->whereHas('user', function ($query) use ($username) {
                $query->where('username', 'like', '%' . $username . '%');
            });
        })->orderBy('date', 'ASC')->paginate(10);

        $data = [
            'attendances' => $attendances,
            'type_menu' => 'attendance'
        ];
        return view('pages.dashboard.attendance.index', ['data' => (object)$data]);
    }
}
