<?php

namespace App\Repositories\Eloquent;

use App\Models\Attendance;
use App\Repositories\Contracts\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function findTodayAttendance($employeeId, $date)
    {
        return Attendance::where('employee_id', $employeeId)
            ->where('date', $date)
            ->first();
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function update($id, array $data)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($data);
        return $attendance;
    }
}
