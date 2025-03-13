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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if (!$user->gatewayInfo) {
                Stripe::setApiKey(config('services.stripe.secret'));
    
                $customer = Customer::create([
                    'email' => $user->email,
                    'name' => $user->email
                ]);
    
                UserGatewayInfo::create([
                    'user_id' => $user->id,
                    'stripe_customer_id' => $customer->id,
                ]);
            }
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
