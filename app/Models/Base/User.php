<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * 
 * @property string $id
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $google_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Collection|UserGatewayInfo[] $user_gateway_infos
 * @property Collection|Company[] $companies
 *
 * @package App\Models\Base
 */
class User extends Model
{
	use SoftDeletes;
	protected $table = 'users';
	public $incrementing = false;

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'email',
		'email_verified_at',
		'password',
		'google_id'
	];

	public function user_gateway_infos()
	{
		return $this->hasMany(UserGatewayInfo::class);
	}

	public function companies()
	{
		return $this->hasMany(Company::class);
	}
}
