<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Payment
 * 
 * @property string $id
 * @property string $company_id
 * @property string $order_id
 * @property string $gateway_payment_id
 * @property float $amount
 * @property string $currency
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Order $order
 *
 * @package App\Models\Base
 */
class Payment extends Model
{
	protected $table = 'payments';
	public $incrementing = false;

	protected $casts = [
		'amount' => 'float',
		'status' => 'int'
	];

	protected $fillable = [
		'company_id',
		'order_id',
		'gateway_payment_id',
		'amount',
		'currency',
		'status'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
