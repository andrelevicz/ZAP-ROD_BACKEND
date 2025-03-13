<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use App\Models\Subscription;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        switch ($payload['type']) {
            case 'invoice.payment_succeeded':
                $subscriptionId = $payload['data']['object']['subscription'];
                Subscription::where('stripe_subscription_id', $subscriptionId)
                    ->update(['status' => 'active']);
                break;

            case 'customer.subscription.deleted':
                $subscriptionId = $payload['data']['object']['id'];
                Subscription::where('stripe_subscription_id', $subscriptionId)
                    ->update(['status' => 'canceled']);
                break;
        }

        return response()->json(['message' => 'Webhook processado']);
    }
}
