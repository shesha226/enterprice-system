<?php

namespace App\Services;

use App\Repositories\Contracts\AttendanceRepositoryInterface;

class AttendanceService
{
    protected $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function checkIn($employeeId)
    {
        $date = now()->toDateString();
        $existingAttendance = $this->attendanceRepository->findTodayAttendance($employeeId, $date);

        if ($existingAttendance) {
            throw new \Exception('Employee has already checked in today.');
        }

        return $this->attendanceRepository->create([
            'employee_id' => $employeeId,
            'date' => $date,
            'check_in' => now()->toTimeString(),
            'status' => 'present',
        ]);
    }

    public function checkOut($employeeId)
    {
        $date = now()->toDateString();
        $existingAttendance = $this->attendanceRepository->findTodayAttendance($employeeId, $date);

        if (!$existingAttendance) {
            throw new \Exception('Employee has not checked in today.');
        }

        if ($existingAttendance->check_out) {
            throw new \Exception('Employee has already checked out today.');
        }

        return $this->attendanceRepository->update($existingAttendance->AttendanceID, [
            'check_out' => now()->toTimeString(),
        ]);
    }

    public function getTodayAttendance($employeeId)
    {
        $date = now()->toDateString();
        return $this->attendanceRepository->findTodayAttendance($employeeId, $date);
    }
}
