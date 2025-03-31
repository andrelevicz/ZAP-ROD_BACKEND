<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * 
 * @property int $id
 * @property string $company_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Collection|Service[] $services
 * @property Collection|Product[] $products
 *
 * @package App\Models\Base
 */
class Tag extends Model
{
	protected $table = 'tags';

	protected $fillable = [
		'company_id',
		'name'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function services()
	{
		return $this->belongsToMany(Service::class)
					->withPivot('id');
	}

	public function products()
	{
		return $this->belongsToMany(Product::class)
					->withPivot('id', 'company_id');
	}
}
