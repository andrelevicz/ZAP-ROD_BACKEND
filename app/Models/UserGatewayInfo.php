<?php

namespace App\Models;
use Illuminate\Support\Str;
use App\Models\Base\UserGatewayInfo as BaseUserGatewayInfo;

class UserGatewayInfo extends BaseUserGatewayInfo
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::ulid();
            }
        });
    }
}
