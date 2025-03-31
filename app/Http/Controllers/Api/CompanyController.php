<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyService $companyService
    ) {}
    
    public function index()
    {
        return CompanyResource::collection($this->companyService->getAllCompanies());
    }

    public function store(StoreCompanyRequest $request)
    {
        try {
            $company = $this->companyService->createCompany($request->validated());
            return new CompanyResource($company);
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Falha ao criar empresa',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return new CompanyResource($this->companyService->updateCompany($company, $request->validated()));
    }

    public function destroy(Company $company)
    {
        $this->companyService->deleteCompany($company);
        return response()->noContent();
    }
}
