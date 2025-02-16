<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $category
 * @property string|null $tags
 * @property bool $is_available
 * @property int $stock
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models\Base
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'price' => 'float',
		'is_available' => 'bool',
		'stock' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'price',
		'category',
		'tags',
		'is_available',
		'stock'
	];
}
