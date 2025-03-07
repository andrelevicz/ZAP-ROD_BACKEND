<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CompanySalesInfo
 * 
 * @property string $id
 * @property string $company_id
 * @property string|null $description
 * @property string|null $social_links
 * @property string|null $delivery_description
 * @property string|null $returns_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 *
 * @package App\Models\Base
 */
class CompanySalesInfo extends Model
{
	protected $table = 'company_sales_infos';
	public $incrementing = false;

	protected $fillable = [
		'id',
		'company_id',
		'description',
		'social_links',
		'delivery_description',
		'returns_description'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
