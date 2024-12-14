<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;
use App\Models\EquipmentBooking;
use App\Models\Equipment;


class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
{
    Stripe::setApiKey('sk_test_51QV9aiP3R10z9hqGG2BgTffJo56vwGSVcb33IN1qQT4O9ujzAE2aEm3eyP398OLBLS2dWPk9OenEdTbwxQE1W81H001eIv2L1O');

    try {
        if ($request->has('equipment_id')) {
            // Logic for equipment booking payment
            $validated = $request->validate([
                'equipment_id' => 'required|exists:equipment,id',
                'quantity_booked' => 'required|integer|min:1',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric|min:1',
            ]);

            $totalPrice = $validated['price'] * $validated['quantity_booked'];

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $validated['description'],
                        ],
                        'unit_amount' => $totalPrice * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', [
                    'equipment_id' => $validated['equipment_id'],
                    'quantity_booked' => $validated['quantity_booked'],
                ]),
                'cancel_url' => route('equipment.show', $request->input('equipment_id')),
            ]);
        } else {
            // Logic for club registration payment
            $validated = $request->validate([
                'amount' => 'required|numeric|min:1',
                'description' => 'required|string|max:255',
            ]);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'lkr',
                        'product_data' => [
                            'name' => $validated['description'],
                        ],
                        'unit_amount' => $validated['amount'] * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('clubs.register') . '?payment_status=success',
                'cancel_url' => route('clubs.register') . '?payment_status=cancel',
            ]);
        }

        return response()->json([
            'success' => true,
            'url' => $session->url,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the payment session: ' . $e->getMessage(),
        ]);
    }
}
public function paymentSuccess(Request $request)
{
    $equipmentId = $request->query('equipment_id');
    $quantityBooked = $request->query('quantity_booked');

    // Handle the logic for successful payment, e.g., updating database records
    // Example: reducing the available quantity of equipment
    if ($equipmentId && $quantityBooked) {
        $equipment = Equipment::find($equipmentId);

        if ($equipment) {
            $equipment->quantity_available -= $quantityBooked;
            $equipment->save();
        }
    }

    // Redirect to a success page or display a success message
    return view('equipment.show', [
        'equipment_id' => $equipmentId,
        'quantity_booked' => $quantityBooked,
    ]);
}



}
