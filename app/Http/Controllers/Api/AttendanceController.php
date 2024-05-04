<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required',
            ]);


            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validate->validated();

            $data = [
                'user_id' => Auth::user()->id,
                'date' => Carbon::now()->format('Y-m-d'),
                'time_in' => Carbon::now()->format('H:i:s'),
                'latlong_in' => $validated['latitude'] . '|' . $validated['longitude'],
            ];

            $attendance = Attendance::create($data);

            return response()->json(['status' => true, 'message' => 'Checkin Successfully', 'data' => $attendance], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkOut(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'latitude' => 'required',
                'longitude' => 'required'
            ]);

            if ($validate->fails()) {
                return response()->json(['status' => false, 'message' => $validate->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $validated = $validate->validated();

            $today = Carbon::now()->format('Y-m-d');

            $attendance = Attendance::where('date', $today)->where('user_id', Auth::user()->id)->first();
            $attendance->time_out = Carbon::now()->format('H:i:s');
            $attendance->latlong_out = $validated['latitude'] . '|' . $validated['longitude'];
            $attendance->save();

            return response()->json(['status' => true, 'message' => 'Checkout Successfully', 'data' => $attendance], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error : ' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function statusAttendance()
    {
        try {
            $today = Carbon::now()->format('Y-m-d');

            $attendance = Attendance::where('date', $today)->where('user_id', Auth::user()->id)->first();

            $data = [
                'is_check_in' => $attendance ? true : false,
                'is_check_out' => $attendance->time_out ? true : false,
                'is_fulltime' => $attendance->time_out && $attendance->time_in ? true : false,
                'attendance' => $attendance ? $attendance : null,
            ];

            return response()->json(['status' => true, 'message' => 'Check Status Attendance', 'data' => $data], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => 'Server Error :' . $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
