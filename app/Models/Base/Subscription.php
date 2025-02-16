<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 * 
 * @property int $id
 * @property int $company_id
 * @property int|null $plan_id
 * @property Carbon $start_date
 * @property Carbon|null $end_date
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Plan|null $plan
 * @property Collection|Module[] $modules
 *
 * @package App\Models\Base
 */
class Subscription extends Model
{
	protected $table = 'subscriptions';

	protected $casts = [
		'company_id' => 'int',
		'plan_id' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	protected $fillable = [
		'company_id',
		'plan_id',
		'start_date',
		'end_date',
		'status'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function plan()
	{
		return $this->belongsTo(Plan::class);
	}

	public function modules()
	{
		return $this->belongsToMany(Module::class, 'subscription_modules')
					->withPivot('id', 'module_price')
					->withTimestamps();
	}
}
