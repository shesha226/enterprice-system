<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use InvalidArgumentException;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function getAllEmployees()
    {
        try {
            $employees = $this->employeeService->getAllEmployees();
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching employees.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function createEmployee(Request $request)
    {
        $validateData = $request->validate([
            'EmployeeId' => 'required|integer|unique:employees,EmployeeId',
            'Name'       => 'required|string|max:255',
            'Age'        => 'required|integer|min:18',
            'Department' => 'required|string|max:255',
            'Salary'     => 'required|numeric|min:0',
        ]);

        try {
            $this->employeeService->createEmployee($validateData);
            return response()->json(['message' => 'Employee created successfully.'], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error creating employee.', 'errors' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function getEmployeeById(int $id)
    {
        try {
            $employee = $this->employeeService->getEmployeeById($id);
            return response()->json($employee, 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error fetching employee.', 'errors' => $e->getMessage()], 500);
        }
    }

    public function updateEmployee(Request $request, $id)
    {
        $validateData = $request->validate([
            'EmployeeId' => 'required|integer|unique:employees,EmployeeId,' . $id . ',EmployeeId',
            'Name'       => 'required|string|max:255',
            'Age'        => 'required|integer|min:18',
            'Department' => 'required|string|max:255',
            'Salary'     => 'required|numeric',
            'Address'    => 'nullable|string|max:255',
        ]);

        try {
            $this->employeeService->updateEmployee($id, $validateData);
            return response()->json(['message' => 'Employee updated successfully.'], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error updating employee.', 'errors' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating employee.', 'errors' => $e->getMessage()], 422);
        }
    }

    public function deleteEmployee($id)
    {
        try {
            $this->employeeService->deleteEmployee($id);
            return response()->json(['message' => 'Employee deleted successfully.'], 200);
        } catch (InvalidArgumentException $e) {
            return response()->json(['message' => 'Error deleting employee.', 'errors' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting employee.', 'errors' => $e->getMessage()], 422);
        }
    }
}
