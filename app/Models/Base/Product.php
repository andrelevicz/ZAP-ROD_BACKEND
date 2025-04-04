<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $company_id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property string|null $link
 * @property int|null $category_id
 * @property bool $is_available
 * @property int $stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Category|null $category
 * @property Collection|Tag[] $tags
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models\Base
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'price' => 'float',
		'category_id' => 'int',
		'is_available' => 'bool',
		'stock' => 'int'
	];

	protected $fillable = [
		'company_id',
		'name',
		'description',
		'price',
		'link',
		'category_id',
		'is_available',
		'stock'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class)
					->withPivot('id', 'company_id');
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
