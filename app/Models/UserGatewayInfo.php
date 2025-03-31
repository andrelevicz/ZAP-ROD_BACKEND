<?php

namespace App\Models;
use Illuminate\Support\Str;
use App\Models\Base\UserGatewayInfo as BaseUserGatewayInfo;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class UserGatewayInfo extends BaseUserGatewayInfo
{

    use HasUlids;
}
