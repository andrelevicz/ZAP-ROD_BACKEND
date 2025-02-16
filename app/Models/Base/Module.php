<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models\Base
 */
class Module extends Model
{
	protected $table = 'modules';

	protected $casts = [
		'price' => 'float',
		'active' => 'bool'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'active'
	];

	public function subscriptions()
	{
		return $this->belongsToMany(Subscription::class, 'subscription_modules')
					->withPivot('id', 'module_price')
					->withTimestamps();
	}
}
