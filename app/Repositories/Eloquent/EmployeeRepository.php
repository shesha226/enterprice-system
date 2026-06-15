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
        $employee_name = $data['Name'] ?? null;
        if (!$employee_name) {
            return [
                'success' => false,
                'message' => 'Employee name is required.',
                'data' => null
            ];
        }

        if (isset($data['EmployeeId'])) {
            $employee = Employee::where('EmployeeId', $data['EmployeeId'])->first();
            if ($employee) {
                return [
                    'success' => false,
                    'message' => 'Employee with this ID already exists.',
                    'data' => null
                ];
            }
        }

        $employee = Employee::create($data);
        return [
            'success' => true,
            'message' => 'Employee created successfully.',
            'data' => $employee
        ];
    }

    public function updateEmployee($id, array $data)
    {
        $employee = $this->getEmployeeById($id);
        $employee->update($data);
        return $employee;
    }

    public function deleteEmployee($id)
    {
        $employee = $this->getEmployeeById($id);
        return $employee->delete();
    }
}
