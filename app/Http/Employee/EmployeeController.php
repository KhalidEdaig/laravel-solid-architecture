<?php

namespace App\Http\Employee;

use App\Http\Employee\Requests\CreateOrUpdateEmployeeValidation;
use App\Http\Response\ResponseController;
use App\Models\Employee;

class EmployeeController extends ResponseController
{
    private $employeeService;

    public function __construct(EmployeeService $service)
    {
        parent::__construct();
        $this->middleware('auth:api_user');
        $this->employeeService = $service;
    }

    public function index()
    {
        return $this->employeeService->getByPaginate();
    }


    public function store(CreateOrUpdateEmployeeValidation $request)
    {
        return $this->employeeService->save($request);
    }


    public function update(CreateOrUpdateEmployeeValidation $request, Employee $employee)
    {
        return $this->employeeService->update($request, $employee->id);
    }


    public function destroy(Employee $employee)
    {
        return $this->employeeService->remove($employee->id);
    }
}
