<?php

namespace App\Http\Company;

use App\Enums\eRespCode;
use App\Http\Company\Requests\CreateOrUpdateCompany;
use App\Http\Company\Requests\CreateOrUpdateCompanyValidation;
use App\Http\Company\Resources\Base\CompaniesResources;
use App\Http\Company\Resources\Base\CompaniesResourcesCollection;
use App\Http\Company\Resources\Pagination\CompaniesPaginationResourceCollection;
use App\Http\Response\ResponseController;
use App\Models\Company;


class CompanyController extends ResponseController
{
    private $companyService;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(CompanyService $service)
    {
        $this->companyService = $service;
        $this->middleware('auth:api_user');
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->companyService->getByPaginate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return $this->companyService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrUpdateCompanyValidation $request)
    {
        return $this->companyService->save($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $Company
     * @return \Illuminate\Http\Response
     */
    public function update(CreateOrUpdateCompanyValidation $request, Company $company)
    {
        return $this->companyService->update($request,$company->id);
           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
       return $this->companyService->remove($company->id);
    }
}
