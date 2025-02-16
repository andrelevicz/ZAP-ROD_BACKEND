<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Plan
 * 
 * @property int $id
 * @property string $name
 * @property float $base_price
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models\Base
 */
class Plan extends Model
{
	protected $table = 'plans';

	protected $casts = [
		'base_price' => 'float'
	];

	protected $fillable = [
		'name',
		'base_price',
		'description'
	];

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
