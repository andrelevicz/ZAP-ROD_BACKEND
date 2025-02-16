<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanyProfile
 * 
 * @property int $id
 * @property int $company_personal_info_id
 * @property string|null $description
 * @property string|null $products_services
 * @property string|null $mission
 * @property string|null $vision
 * @property string|null $values
 * @property string|null $social_links
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CompaniesPersonalInfo $companies_personal_info
 *
 * @package App\Models\Base
 */
class CompanyProfile extends Model
{
	protected $table = 'company_profiles';

	protected $casts = [
		'company_personal_info_id' => 'int'
	];

	protected $fillable = [
		'company_personal_info_id',
		'description',
		'products_services',
		'mission',
		'vision',
		'values',
		'social_links'
	];

	public function companies_personal_info()
	{
		return $this->belongsTo(CompaniesPersonalInfo::class, 'company_personal_info_id');
	}
}
