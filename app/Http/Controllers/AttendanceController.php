<?php

namespace App\Http\Controllers;

use App\Services\AttendanceService;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    protected $attendanceService;


    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function checkIn(Request $request)
    {
        $employeeId = $request->input('employee_id');
        try {
            $attendance = $this->attendanceService->checkIn($employeeId);
            return response()->json(['message' => 'Check-in successful', 'attendance' => $attendance], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function checkOut(Request $request)
    {
        $employeeId = $request->input('employee_id');
        try {
            $attendance = $this->attendanceService->checkOut($employeeId);
            return response()->json(['message' => 'Check-out successful', 'attendance' => $attendance], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function getTodayAttendance(Request $request)
    {
        $employeeId = $request->input('employee_id');
        try {
            $attendance = $this->attendanceService->getTodayAttendance($employeeId);
            return response()->json(['attendance' => $attendance], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
