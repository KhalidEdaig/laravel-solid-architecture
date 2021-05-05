<?php

namespace App\Http\Employee;

use App\Contracts\RepositoryInterface;
use App\Enums\eRespCode;
use App\Http\Employee\Resources\Base\EmployeesResources;
use App\Http\Employee\Resources\Base\EmployeesResourcesCollection;
use App\Http\Employee\Resources\Pagination\EmployeesPaginationResourceCollection;
use App\Http\Response\ResponseController;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class EmployeeService extends ResponseController implements RepositoryInterface
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAll(): JsonResponse
  {
    return $this->resp->ok(
      eRespCode::C_LISTED_200_00,
      new EmployeesResourcesCollection(Employee::all())
    );
  }

  public function getByPaginate(): JsonResponse
  {
    return $this->resp->ok(
      eRespCode::C_LISTED_200_00,
      new EmployeesPaginationResourceCollection(Employee::paginate())
    );
  }

  public function findById(int $id): JsonResponse
  {
    $employee = Employee::findOrFail($id);
    return $employee
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new EmployeesResources($employee)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function findByEmail(string $email): JsonResponse
  {
    $employees = Employee::when($email, function (Builder $query) use ($email) {
      return $query->where('email', $email);
    });
    return $employees
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new EmployeesResourcesCollection($employees)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function findByName(string $name): JsonResponse
  {
    $employees = Employee::when($name, function (Builder $query) use ($name) {
      return $query->where('name', $name);
    });
    return $employees
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new EmployeesResourcesCollection($employees)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function save(Request $request): JsonResponse
  {
    try {
      DB::beginTransaction();
      $employee = Employee::create($request->all());
      $employee->assignRole(Role::firstOrCreate([
        'name'=>'employee',
        'guard_name'=>'api_employee'
      ]));
      DB::commit();
      return  $this->resp->created(eRespCode::C_CREATED_201_00, new EmployeesResources($employee));
    } catch (\Throwable $th) {
      DB::rollBack();
      Log::info($th);
      return $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
    }
  }

  public function update(Request $request, int $id): JsonResponse
  {
    $employee = Employee::findOrFail($id);
    return $employee->update($request->all())
      ? $this->resp->ok(eRespCode::C_UPDATED_200_01, new EmployeesResources($employee))
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }

  public function remove(int $id): JsonResponse
  {
    $employee = Employee::findOrFail($id);
    return $employee->delete()
      ? $this->resp->ok(eRespCode::C_DELETED_200_02)
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }
}
