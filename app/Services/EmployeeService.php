<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use App\Repositories\Eloquent\EmployeeRepository;
use Illuminate\Support\Facades\Log;
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
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function getEmployeeById(int $id)
    {
        try {
            $exsistingEmployee = $this->employeeRepository->getEmployeeById($id);
            if (!$exsistingEmployee) {
                throw new InvalidArgumentException('Employee not found.');
            }
            return $exsistingEmployee;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }


    public function createEmployee(array $data)
    {
        DB::beginTransaction();
        try {
            $existingEmpolyee = $this->employeeRepository->getEmployeeById($data['EmployeeId'] ?? null);
            if ($existingEmpolyee) {
                throw new InvalidArgumentException('Employee with this ID already exists.');
            }
            if ($data['Age'] < 18) {
                throw new InvalidArgumentException('Employee must be at least 18 years old.');
            }
            $employee = $this->employeeRepository->createEmployee($data);
            DB::commit();
            return $employee;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function updateEmployee($id, array $data)
    {
        try {

            $employee = $this->employeeRepository->getEmployeeById($id);
            if (!$employee) {
                throw new InvalidArgumentException('Employee not found.');
            }
            if (isset($data['Age']) && $data['Age'] < 18) {
                throw new InvalidArgumentException('Employee must be at least 18 years old.');
            }
            return $this->employeeRepository->updateEmployee($id, $data);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }

    public function deleteEmployee($id)
    {

        try {
            $exsistingEmployee = $this->employeeRepository->getEmployeeById($id);
            if (!$exsistingEmployee) {
                throw new InvalidArgumentException('Employee not found.');
            }
            return $this->employeeRepository->deleteEmployee($id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
