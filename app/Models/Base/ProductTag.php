<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductTag
 * 
 * @property int $id
 * @property string $company_id
 * @property int $product_id
 * @property int $tag_id
 * 
 * @property Company $company
 * @property Product $product
 * @property Tag $tag
 *
 * @package App\Models\Base
 */
class ProductTag extends Model
{
	protected $table = 'product_tag';
	public $timestamps = false;

	protected $casts = [
		'product_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'company_id',
		'product_id',
		'tag_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
