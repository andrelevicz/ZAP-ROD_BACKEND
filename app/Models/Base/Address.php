<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * 
 * @property string $id
 * @property string $company_id
 * @property string $street_address
 * @property string $address_locality
 * @property string $address_region
 * @property string $postal_code
 * @property string $address_country
 * @property string|null $address_complement
 * @property float|null $latitude
 * @property float|null $longitude
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Company $company
 *
 * @package App\Models\Base
 */
class Address extends Model
{
	use SoftDeletes;
	protected $table = 'addresses';
	public $incrementing = false;

	protected $casts = [
		'latitude' => 'float',
		'longitude' => 'float'
	];

	protected $fillable = [
		'company_id',
		'street_address',
		'address_locality',
		'address_region',
		'postal_code',
		'address_country',
		'address_complement',
		'latitude',
		'longitude'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
