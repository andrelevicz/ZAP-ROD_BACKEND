<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $company_id
 * @property string $name
 * @property string|null $description
 * @property string|null $requirements
 * @property float|null $price
 * @property int|null $duration
 * @property int|null $category_id
 * @property bool $is_available
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Category|null $category
 * @property Collection|Tag[] $tags
 *
 * @package App\Models\Base
 */
class Service extends Model
{
	protected $table = 'services';

	protected $casts = [
		'price' => 'float',
		'duration' => 'int',
		'category_id' => 'int',
		'is_available' => 'bool'
	];

	protected $fillable = [
		'company_id',
		'name',
		'description',
		'requirements',
		'price',
		'duration',
		'category_id',
		'is_available'
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
					->withPivot('id');
	}
}
