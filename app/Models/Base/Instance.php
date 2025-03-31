<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Instance
 * 
 * @property int $id
 * @property string $user_id
 * @property string $company_id
 * @property string $name
 * @property string $instance_id
 * @property int $status
 * @property string|null $webhook_events
 * @property Carbon|null $last_activity
 * @property string|null $qrcode
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Company $company
 *
 * @package App\Models\Base
 */
class Instance extends Model
{
	use SoftDeletes;
	protected $table = 'instances';

	protected $casts = [
		'status' => 'int',
		'last_activity' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'company_id',
		'name',
		'instance_id',
		'status',
		'webhook_events',
		'last_activity',
		'qrcode'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
