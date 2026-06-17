<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::all();
    }

    public function getEmployeeById($id)
    {
        return Employee::where('EmployeeId', $id)->first();
    }

    public function createEmployee(array $data)
    {
        return Employee::create($data);
    }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->getEmployeeById($id);
        if ($employee) {
            $employee->update($data);
        }
        return $employee;
    }

    public function deleteEmployee($id)
    {
        $employee = $this->getEmployeeById($id);
        if ($employee) {
            return $employee->delete();
        }
        return false;
    }
}
