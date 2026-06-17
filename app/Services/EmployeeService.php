<?php

namespace App\Services;

use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Exception;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        try {
            return $this->employeeRepository->getAllEmployees();
        } catch (Exception $e) {
            Log::error('Error fetching all employees: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getEmployeeById(int $id)
    {
        try {
            $employee = $this->employeeRepository->getEmployeeById($id);
            if (!$employee) {
                throw new InvalidArgumentException('Employee not found.');
            }
            return $employee;
        } catch (Exception $e) {
            Log::error("Error fetching employee ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }

    public function createEmployee(array $data)
    {
        DB::beginTransaction();
        try {
            $existingEmployee = $this->employeeRepository->getEmployeeById($data['EmployeeId'] ?? null);
            if ($existingEmployee) {
                throw new InvalidArgumentException('Employee with this ID already exists.');
            }

            if (isset($data['Age']) && $data['Age'] < 18) {
                throw new InvalidArgumentException('Employee must be at least 18 years old.');
            }

            $employee = $this->employeeRepository->createEmployee($data);
            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating employee: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateEmployee($id, array $data)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->getEmployeeById($id);
            if (!$employee) {
                throw new InvalidArgumentException('Employee not found.');
            }

            if (isset($data['Age']) && $data['Age'] < 18) {
                throw new InvalidArgumentException('Employee must be at least 18 years old.');
            }

            $updatedEmployee = $this->employeeRepository->updateEmployee($id, $data);
            DB::commit();
            return $updatedEmployee;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating employee ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteEmployee($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->getEmployeeById($id);
            if (!$employee) {
                throw new InvalidArgumentException('Employee not found.');
            }

            $result = $this->employeeRepository->deleteEmployee($id);
            DB::commit();
            return $result;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting employee ID {$id}: " . $e->getMessage());
            throw $e;
        }
    }
}
