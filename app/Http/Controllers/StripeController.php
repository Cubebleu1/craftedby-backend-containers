<?php

namespace App\Http\Controllers;

use Exception;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;

class StripeController extends Controller
{

    public function initiatePayment(Request $request)
    {
        StripeGateway::setApiKey('STRIPE_SECRET_KEY');

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount * 100, // Multiply as & when required
                'currency' => $request->currency,
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

// Save the $paymentIntent->id to identify this payment later
        } catch (Exception $e) {
// throw error
        }

        return [
            'token' => (string)Str::uuid(),
            'client_secret' => $paymentIntent->client_secret
        ];
    }
}
