<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CompaniesPersonalInfo
 * 
 * @property int $id
 * @property string $name
 * @property string $cnpj
 * @property string $legal_email
 * @property string $phone
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|CompanyCredential[] $company_credentials
 * @property Collection|CompanyProfile[] $company_profiles
 *
 * @package App\Models\Base
 */
class CompaniesPersonalInfo extends Model
{
	use SoftDeletes;
	protected $table = 'companies_personal_infos';

	protected $fillable = [
		'name',
		'cnpj',
		'legal_email',
		'phone',
		'address'
	];

	public function company_credentials()
	{
		return $this->hasMany(CompanyCredential::class, 'company_personal_info_id');
	}

	public function company_profiles()
	{
		return $this->hasMany(CompanyProfile::class, 'company_personal_info_id');
	}
}
