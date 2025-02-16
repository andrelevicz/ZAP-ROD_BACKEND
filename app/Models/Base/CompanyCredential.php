<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyCredential
 * 
 * @property int $id
 * @property int $company_personal_info_id
 * @property string|null $api_token
 * @property string $admin_password
 * @property string|null $bank_account
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CompaniesPersonalInfo $companies_personal_info
 *
 * @package App\Models\Base
 */
class CompanyCredential extends Model
{
	protected $table = 'company_credentials';

	protected $casts = [
		'company_personal_info_id' => 'int'
	];

	protected $hidden = [
		'api_token',
		'admin_password'
	];

	protected $fillable = [
		'company_personal_info_id',
		'api_token',
		'admin_password',
		'bank_account'
	];

	public function companies_personal_info()
	{
		return $this->belongsTo(CompaniesPersonalInfo::class, 'company_personal_info_id');
	}
}
