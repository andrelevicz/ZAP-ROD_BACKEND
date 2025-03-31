<?php
namespace App\Observers;

use App\Models\User;
use App\Models\UserGatewayInfo;
use Stripe\Stripe;
use Stripe\Customer;

class UserObserver
{
    public function created(User $user)
    {
        if (!$user->gatewayInfo) {
            Stripe::setApiKey(config('services.stripe.secret'));
            
            $customer = Customer::create([
                'email' => $user->email,
                'name' => $user->name ?? $user->email
            ]);

            $user_gateway_info = UserGatewayInfo::create([
                'user_id' => $user->id,
                'stripe_customer_id' => $customer->id,
            ]);
        }
    }
}