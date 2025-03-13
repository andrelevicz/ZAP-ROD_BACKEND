<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function getAllCompanies()
    {
        return Company::with('address')->get();
    }

    public function createCompany(array $data)
    {
        return Company::create($data);
    }

    public function updateCompany(Company $company, array $data)
    {
        $company->update($data);
        return $company->fresh();
    }

    public function deleteCompany(Company $company)
    {
        $company->delete();
    }
}