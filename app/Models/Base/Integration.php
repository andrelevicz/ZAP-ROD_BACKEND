<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Integration
 * 
 * @property string $ulid
 * @property string $company_id
 * @property string $name
 * @property string $service
 * @property string $credentials
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 *
 * @package App\Models\Base
 */
class Integration extends Model
{
	protected $table = 'integrations';
	public $incrementing = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'ulid',
		'company_id',
		'name',
		'service',
		'credentials',
		'is_active'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
