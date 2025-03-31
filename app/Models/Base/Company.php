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
 * Class Company
 * 
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string|null $fantasy_name
 * @property string|null $cnpj
 * @property string $legal_email
 * @property string $phone
 * @property string|null $gateway_custumer_receiver_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|Payment[] $payments
 * @property Integration $integration
 * @property PaymentMethod $payment_method
 * @property Collection|Service[] $services
 * @property Collection|Address[] $addresses
 * @property Collection|Instance[] $instances
 * @property CompanySalesInfo $company_sales_info
 * @property Collection|Category[] $categories
 * @property Collection|Product[] $products
 * @property Collection|Tag[] $tags
 * @property Collection|ProductTag[] $product_tags
 * @property Collection|Lead[] $leads
 * @property Collection|Order[] $orders
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models\Base
 */
class Company extends Model
{
	use SoftDeletes;
	protected $table = 'companies';
	public $incrementing = false;

	protected $fillable = [
		'user_id',
		'name',
		'fantasy_name',
		'cnpj',
		'legal_email',
		'phone',
		'gateway_custumer_receiver_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function payments()
	{
		return $this->hasMany(Payment::class);
	}

	public function integration()
	{
		return $this->hasOne(Integration::class);
	}

	public function payment_method()
	{
		return $this->hasOne(PaymentMethod::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}

	public function addresses()
	{
		return $this->hasMany(Address::class);
	}

	public function instances()
	{
		return $this->hasMany(Instance::class);
	}

	public function company_sales_info()
	{
		return $this->hasOne(CompanySalesInfo::class);
	}

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function tags()
	{
		return $this->hasMany(Tag::class);
	}

	public function product_tags()
	{
		return $this->hasMany(ProductTag::class);
	}

	public function leads()
	{
		return $this->hasMany(Lead::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
