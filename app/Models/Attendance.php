<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey = 'AttendanceID';
    protected $fillable = ['employee_id', 'date', 'status', 'check_in', 'check_out'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'EmployeeId');
    }
}
