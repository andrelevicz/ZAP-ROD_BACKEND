<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lead
 * 
 * @property string $id
 * @property string $company_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $document
 * @property int|null $document_type
 * @property string|null $address
 * @property int $origin
 * @property string $status
 * @property string|null $custom_fields
 * @property string|null $about
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Collection|Order[] $orders
 *
 * @package App\Models\Base
 */
class Lead extends Model
{
	protected $table = 'leads';
	public $incrementing = false;

	protected $casts = [
		'document_type' => 'int',
		'origin' => 'int'
	];

	protected $fillable = [
		'company_id',
		'name',
		'email',
		'phone',
		'document',
		'document_type',
		'address',
		'origin',
		'status',
		'custom_fields',
		'about'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
}
