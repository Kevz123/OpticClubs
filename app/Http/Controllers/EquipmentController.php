<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\EquipmentBooking;
use App\Models\Location;

class EquipmentController extends Controller
{
    public function showBookingForm()
    {
        $equipment = Equipment::all(); // Fetch all equipment

        if ($equipment->isEmpty()) {
            return redirect()->route('equipment.book')->withErrors(['msg' => 'No equipment available for booking.']);
        }

        return view('equipment.book', compact('equipment'));
    }

    public function storeBooking(Request $request)
    {
        $validatedData = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'quantity_booked' => 'required|integer|min:1',
        ]);

        $equipment = Equipment::findOrFail($validatedData['equipment_id']);

        // Check if enough quantity is available
        if ($equipment->quantity_available < $validatedData['quantity_booked']) {
            return redirect()->back()->withErrors(['msg' => 'Insufficient quantity for ' . $equipment->name]);
        }

        // Calculate total price
        $totalPrice = $equipment->price * $validatedData['quantity_booked'];

        // Create the booking
        EquipmentBooking::create([
            'equipment_id' => $equipment->id,
            'quantity_booked' => $validatedData['quantity_booked'],
            'total_price' => $totalPrice,
        ]);

        // Update the equipment's available quantity
        $equipment->decrement('quantity_available', $validatedData['quantity_booked']);

        return redirect()->route('equipment.show', $equipment->location_id)->with('success', 'Equipment booked successfully!');
    }

    public function show($locationId)
    {
        $location = Location::with('equipment')->findOrFail($locationId);

        return view('equipment.show', compact('location'));
    }
}
