<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property string $id
 * @property string $company_id
 * @property string|null $lead_id
 * @property float $total
 * @property int $status
 * @property string|null $tracking_code
 * @property Carbon|null $paid_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Lead|null $lead
 * @property Collection|Payment[] $payments
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models\Base
 */
class Order extends Model
{
	protected $table = 'orders';
	public $incrementing = false;

	protected $casts = [
		'total' => 'float',
		'status' => 'int',
		'paid_at' => 'datetime'
	];

	protected $fillable = [
		'company_id',
		'lead_id',
		'total',
		'status',
		'tracking_code',
		'paid_at'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function lead()
	{
		return $this->belongsTo(Lead::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
