<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        // Fetch venues grouped by city
        $venues = Venue::all()->groupBy('location');

        return view('venues.index', compact('venues'));
    }

    public function selectVenue(Request $request)
    {
        // Save selected venue ID and name in the session
        $request->session()->put('selectedVenueId', $request->venue_id);
        $request->session()->put('selectedVenueName', $request->venue_name);

        // Redirect back to the event creation form
        return redirect()->route('events.create');
    }

}
