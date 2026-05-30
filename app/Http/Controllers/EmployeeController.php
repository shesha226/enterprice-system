<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAllEmployees()
    {
        try {
            $employees = $this->employeeService->getAllEmployees();
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching employees.'], 500);
        }
    }


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'EmployeeId' => 'required|integer|unique:employees,EmployeeId',
            'Name' => 'required|string|max:255',
            'Age' => 'required|integer|min:18',
            'Department' => 'required|string|max:255',
        ]);
        try {
            $this->employeeService->createEmployee($validateData);
            return response()->json(['message' => 'Employee created successfully.'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating employee.'], 422);
        }
    }


    public function getEmployeeById(int $id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching employee.'], 500);
        }
    }
    public function edit(Request $request, Employee $employee)
    {
        $validateData = $request->validate([
            'EmployeeId' => 'required|integer|unique:employees,EmployeeId,' . $employee->id,
            'Name' => 'required|string|max:255',
            'Age' => 'required|integer|min:18',
            'Department' => 'required|string|max:255',
        ]);
        try {
            $this->employeeService->updateEmployee($employee->EmployeeId, $validateData);
            return response()->json(['message' => 'Employee updated successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating employee.'], 422);
        }
    }


    public function destroy(Employee $employee)
    {
        try {
            $this->employeeService->deleteEmployee($employee->EmployeeId);
            return response()->json(['message' => 'Employee deleted successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting employee.'], 422);
        }
    }
}
