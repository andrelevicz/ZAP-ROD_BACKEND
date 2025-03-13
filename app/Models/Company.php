<?php

namespace App\Models;

use App\Models\Base\Company as BaseCompany;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;

class Company extends BaseCompany
{
    use HasUlids;
}
