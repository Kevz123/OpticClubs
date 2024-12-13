<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // Show the locations in the book view
    public function book()
    {
        $locations = Location::all(); // Fetch all locations
        return view('equipment.book', compact('locations')); // Pass locations to the book view
    }

    // Store a new location
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'sports_name' => 'required|string|max:255',
            'image' => 'required|string',
            'is_physical' => 'required|in:0,1', // Changed from boolean to 'in:0,1'
            'shop_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:15',
        ]);

        // Determine if the sport is physical or non-physical
        $category = $validatedData['is_physical'] == 1 ? 'Physical' : 'Non-Physical';

        // Create the new location
        Location::create($validatedData);

        // Redirect to the book view with a success message
        return redirect()->route('equipment.book')->with('success', 'Location added successfully!');
    }

    // Show the equipment table
    public function show($id)
    {
        $location = Location::with('equipment')->find($id); // Fetch location with related equipment
        return view('equipment.show', compact('location')); // Pass location to the show view
    }
}
