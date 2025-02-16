<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubscriptionModule
 * 
 * @property int $id
 * @property int $subscription_id
 * @property int $module_id
 * @property float $module_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Subscription $subscription
 * @property Module $module
 *
 * @package App\Models\Base
 */
class SubscriptionModule extends Model
{
	protected $table = 'subscription_modules';

	protected $casts = [
		'subscription_id' => 'int',
		'module_id' => 'int',
		'module_price' => 'float'
	];

	protected $fillable = [
		'subscription_id',
		'module_id',
		'module_price'
	];

	public function subscription()
	{
		return $this->belongsTo(Subscription::class);
	}

	public function module()
	{
		return $this->belongsTo(Module::class);
	}
}
