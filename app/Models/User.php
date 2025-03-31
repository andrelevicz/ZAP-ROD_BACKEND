<?php

namespace App\Models;

use App\Models\Base\User as BaseUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Stripe\Customer;
use Stripe\Stripe;

class User extends BaseUser implements JWTSubject, AuthenticatableContract
{
    use Authenticatable, HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';


    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user_id' => $this->id,
            'company_ids' => $this->companies->pluck('id')
        ];
    }
}
