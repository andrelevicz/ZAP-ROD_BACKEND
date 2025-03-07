<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tenant
 * 
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $data
 * 
 * @property Collection|Domain[] $domains
 *
 * @package App\Models\Base
 */
class Tenant extends Model
{
	protected $table = 'tenants';
	public $incrementing = false;

	protected $fillable = [
		'data'
	];

	public function domains()
	{
		return $this->hasMany(Domain::class);
	}
}
