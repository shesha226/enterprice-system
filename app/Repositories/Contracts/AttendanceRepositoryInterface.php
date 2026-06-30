<?php

namespace App\Repositories\Contracts;

interface AttendanceRepositoryInterface
{
    public function findTodayAttendance($employeeId, $date);
    public function create(array $data);
    public function update($id, array $data);
}
