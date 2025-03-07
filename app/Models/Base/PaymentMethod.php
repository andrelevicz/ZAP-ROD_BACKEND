<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 * 
 * @property string $id
 * @property string $company_id
 * @property string $type
 * @property string $name
 * @property bool $is_active
 * @property string|null $settings
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 *
 * @package App\Models\Base
 */
class PaymentMethod extends Model
{
	protected $table = 'payment_methods';
	public $incrementing = false;

	protected $casts = [
		'is_active' => 'bool'
	];

	protected $fillable = [
		'id',
		'company_id',
		'type',
		'name',
		'is_active',
		'settings'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
