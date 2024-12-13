<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Club;


class PayPalController extends Controller
{
    protected $payPalClient;

    public function __construct()
    {
        $this->payPalClient = new PayPalClient;
        $this->payPalClient->setApiCredentials([
            'mode' => config('paypal.mode'), // 'sandbox' or 'live'
            'client_id' => config('paypal.' . config('paypal.mode') . '.client_id'),
            'client_secret' => config('paypal.' . config('paypal.mode') . '.client_secret'),
            'currency' => config('paypal.currency'),
        ]);
    }

    // Method to create the payment
    public function createPayment(Request $request)
    {
        $clubId = $request->input('club_id');
        $club = Club::findOrFail($clubId);

        $paymentData = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('paypal.currency', 'USD'),
                        'value' => '10.00'
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('payment.cancel'),
                'return_url' => route('payment.success')
            ]
        ];

        $response = $this->payPalClient->createOrder($paymentData);
        
        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('register')->with('error', 'Something went wrong while creating the payment.');
    }

    // Method to handle successful payment
    public function handleSuccess(Request $request)
    {
        $captureResponse = $this->payPalClient->capturePaymentOrder($request->token);

        if ($captureResponse['status'] == 'COMPLETED') {
            $clubId = $request->input('club_id');
            $club = Club::findOrFail($clubId);

            $club->payment = $captureResponse['purchase_units'][0]['amount']['value'];
            $club->save();

            return redirect()->route('dashboard')->with('success', 'Payment successful!');
        }

        return redirect()->route('register')->with('error', 'Payment was not completed.');
    }

    // Method to handle payment cancellation
    public function handleCancel()
    {
        return redirect()->route('register')->with('error', 'Payment was cancelled.');
    }
}