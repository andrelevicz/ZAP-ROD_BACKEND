<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * 
 * @property int $id
 * @property int $user_id
 * @property string $document
 * @property string|null $picture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|Subscription[] $subscriptions
 *
 * @package App\Models\Base
 */
class Company extends Model
{
	protected $table = 'companies';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'document',
		'picture'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function subscriptions()
	{
		return $this->hasMany(Subscription::class);
	}
}
