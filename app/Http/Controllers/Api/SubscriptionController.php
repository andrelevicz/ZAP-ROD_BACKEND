<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use App\Models\Plan;
use App\Models\User;
use Stripe\Subscription;
use App\Models\Subscription as SubscriptionModel;

class SubscriptionController extends Controller
{
    public function createPlan(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $product = Product::create([
            'name' => $request->name,
            'type' => 'service',
        ]);

        $price = Price::create([
            'unit_amount' => $request->price * 100,
            'currency'    => 'brl',
            'recurring'   => ['interval' => 'month'],
            'product'     => $product->id,
        ]);

        $plan = Plan::create([
            'name'       => $request->name,
            'base_price' => $request->price,
            'stripe_plan_id' => $price->id, 
        ]);

        return response()->json($plan);
    }

    public function createSubscription(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $plan = Plan::findOrFail($request->plan_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $subscription = Subscription::create([
            'customer' => $user->stripe_customer_id,
            'items' => [['price' => $plan->stripe_plan_id]],
        ]);

        $subscriptionModel = SubscriptionModel::create([
            'plan_id'    => $plan->id,
            'start_date' => now(),
            'status'     => 'active',
            'stripe_subscription_id' => $subscription->id,
        ]);

        return response()->json($subscriptionModel);
    }

    public function listSubscriptions()
    {
        return response()->json(SubscriptionModel::with('plan')->get());
    }

    public function cancelSubscription(Request $request, $id)
    {
        $subscription = SubscriptionModel::findOrFail($id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeSubscription = \Stripe\Subscription::retrieve($subscription->stripe_subscription_id);
        $stripeSubscription->cancel();

        $subscription->update(['status' => 'canceled']);

        return response()->json(['message' => 'Assinatura cancelada com sucesso']);
    }

}
