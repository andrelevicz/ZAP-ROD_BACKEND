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
		'name',
		'instance_id',
		'status',
		'webhook_events',
		'last_activity',
		'qrcode'
	];
}
