<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        
        Stripe::setApiKey('sk_test_51QV9aiP3R10z9hqGG2BgTffJo56vwGSVcb33IN1qQT4O9ujzAE2aEm3eyP398OLBLS2dWPk9OenEdTbwxQE1W81H001eIv2L1O');

        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $request->description,
                        ],
                        'unit_amount' => $request->amount * 100, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('clubs.register') . '?payment_status=success',
                'cancel_url' => route('clubs.register') . '?payment_status=cancel',

            ]);
        
            return response()->json([
                'success' => true,
                'url' => $session->url,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the payment session.',
            ]);
        }
    }        

}