<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServiceTag
 * 
 * @property int $id
 * @property int $service_id
 * @property int $tag_id
 * 
 * @property Service $service
 * @property Tag $tag
 *
 * @package App\Models\Base
 */
class ServiceTag extends Model
{
	protected $table = 'service_tag';
	public $timestamps = false;

	protected $casts = [
		'service_id' => 'int',
		'tag_id' => 'int'
	];

	protected $fillable = [
		'service_id',
		'tag_id'
	];

	public function service()
	{
		return $this->belongsTo(Service::class);
	}

	public function tag()
	{
		return $this->belongsTo(Tag::class);
	}
}
