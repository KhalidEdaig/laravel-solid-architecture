<?php

namespace App\Http\Company;

use App\Contracts\CompanyContract;
use App\Contracts\RepositoryInterface;
use App\Enums\eRespCode;
use App\Http\Company\Resources\Base\CompaniesResources;
use App\Http\Company\Resources\Base\CompaniesResourcesCollection;
use App\Http\Company\Resources\Pagination\CompaniesPaginationResourceCollection;
use App\Http\Response\ResponseController;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyService extends ResponseController implements RepositoryInterface
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAll(): JsonResponse
  {
    return $this->resp->ok(
      eRespCode::C_LISTED_200_00,
      new CompaniesResourcesCollection(Company::all())
    );
  }

  public function getByPaginate(): JsonResponse
  {
    return $this->resp->ok(
      eRespCode::C_LISTED_200_00,
      new CompaniesPaginationResourceCollection(Company::paginate())
    );
  }

  public function findById(int $id): JsonResponse
  {
    $company = Company::findOrFail($id);
    return $company
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new CompaniesResources($company)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function findByEmail(string $email): JsonResponse
  {
    $companies = Company::when($email, function (Builder $query) use ($email) {
      return $query->where('email', $email);
    });
    return $companies
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new CompaniesResourcesCollection($companies)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function findByName(string $name): JsonResponse
  {
    $companies = Company::when($name, function (Builder $query) use ($name) {
      return $query->where('name', $name);
    });
    return $companies
      ? $this->resp->ok(
        eRespCode::C_GET_200_03,
        new CompaniesResourcesCollection($companies)
      )
      : $this->resp->guessResponse(eRespCode::_404_NOT_FOUND);
  }

  public function save(Request $request): JsonResponse
  {
    $company = Company::create($request->all());
    return $company
      ? $this->resp->created(eRespCode::C_CREATED_201_00, new CompaniesResources($company))
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }

  public function update(Request $request, int $id): JsonResponse
  {
    $company = Company::findOrFail($id);
    return $company->update($request->all())
      ? $this->resp->ok(eRespCode::C_UPDATED_200_01, new CompaniesResources($company))
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }

  public function remove(int $id): JsonResponse
  {
    $company = Company::findOrFail($id);
    return $company->delete()
      ? $this->resp->ok(eRespCode::C_DELETED_200_02)
      : $this->resp->guessResponse(eRespCode::_500_INTERNAL_ERROR);
  }
}
