<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserGatewayInfo
 * 
 * @property string $id
 * @property string $user_id
 * @property string|null $stripe_customer_id
 * @property string|null $stripe_payment_method_id
 * @property string|null $stripe_subscription_id
 * @property string|null $address_line1
 * @property string|null $address_line2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 *
 * @package App\Models\Base
 */
class UserGatewayInfo extends Model
{
	use SoftDeletes;
	protected $table = 'user_gateway_info';
	public $incrementing = false;

	protected $fillable = [
		'user_id',
		'stripe_customer_id',
		'stripe_payment_method_id',
		'stripe_subscription_id',
		'address_line1',
		'address_line2',
		'city',
		'state',
		'postal_code',
		'country_code'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
