<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Company[] $companies
 *
 * @package App\Models\Base
 */
class User extends Model
{
	protected $table = 'users';

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	public function companies()
	{
		return $this->hasMany(Company::class);
	}
}
