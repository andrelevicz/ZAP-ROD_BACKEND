<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property string $company_id
 * @property string $order_id
 * @property int $product_id
 * @property int $quantity
 * @property float $unit_price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Order $order
 * @property Product $product
 *
 * @package App\Models\Base
 */
class OrderItem extends Model
{
	protected $table = 'order_items';

	protected $casts = [
		'product_id' => 'int',
		'quantity' => 'int',
		'unit_price' => 'float'
	];

	protected $fillable = [
		'company_id',
		'order_id',
		'product_id',
		'quantity',
		'unit_price'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
