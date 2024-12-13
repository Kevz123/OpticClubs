<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Venue;
use App\Models\Club;
use App\Models\Participant;

use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    // Show the form to create an event
    public function create()
    {
        $clubs = Club::all();
        $venues = Venue::all();
        return view('events.create', [
            'clubs' => $clubs,
            'venues' => $venues,
            'selectedVenueId' => session('selectedVenueId'),
            'selectedVenueName' => session('selectedVenueName'),
        ]);
    }

    // Store the event in the database
    public function store(Request $request)
    {
        //Validate and store event details
        $validated = $request->validate([
            'event_name' => 'required|string|max:255|regex:/^[A-Za-z0-9\s\-\_]+$/',
            'description' => 'required|string|max:500',
            'event_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'club_id' => 'required|exists:clubs,club_id',
            'venue_id' => 'required|exists:venues,venue_id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price_ranges' => 'required|array',
            'price_ranges.*' => 'integer|min:0', // Validate seat counts for each price range
        ]);


        //Prepare event data
        $data = [
            'event_name' => $request->event_name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'club_id' => $request->club_id,
            'venue_id' => $request->venue_id,
        ];

        //Handle image upload if present
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images', 'public');
        //     $data['image'] = $imagePath; // Store the image path in the 'image' column
        // }
        $imagePath = $request->file('image')->store('event_images', 'public');

        //Create the event with image path if available
    

        //Event::create($data);
        $event = Event::create([
            'event_name' => $validated['event_name'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'start_time' => $validated['start_time'],
            'club_id' => $validated['club_id'],
            'venue_id' => $validated['venue_id'],
            'image' => $imagePath,
            'price_ranges' => $validated['price_ranges'], // Save the price ranges as JSON
        ]);

        return redirect()->route('home')->with('success', 'Event created successfully!');

    }


        //event
       public function show($event_id)
    {
       $event = Event::with(['club', 'venue', 'participants'])->findOrFail($event_id);
       $priceRanges = $event->price_ranges;

       return view('events.show', compact('event', 'priceRanges'));
    }
    


        public function reserve(Request $request, Event $event)
    {
        
        // Ensure the user is logged in
        $user = auth()->user();

        // if (!$user) {
        //     return redirect()->route('login')->with('error', 'You must be logged in to reserve an event.');
        // }

        // Get the user's membership ID
        $membership = $user->membership;

        if (!$membership) {
            return back()->with('error', 'You need to have a valid membership to reserve a spot.');
        }

        $membershipId = $membership->membership_id; // Replace with your actual membership foreign key column

        // Get the price range data for the specific event
        $price = $request->input('price');
        $priceRanges = $event->price_ranges;

        // Validate the price and availability
        if (!isset($priceRanges[$price]) || $priceRanges[$price] <= 0) {
            return back()->with('error', 'This price range is sold out or invalid.');
        }

        // Deduct one seat from the price range for the specific event
        $priceRanges[$price]--;
        $event->price_ranges = $priceRanges;
        $event->save();

        // Add the user as a participant for the specific event
        \App\Models\Participant::create([
            'membership_id' => $membershipId,
            'event_id' => $event->event_id,
            'price' => $price,
        ]);

        foreach (\App\Models\Event::all() as $otherEvent) {
            
        }

        return back()->with('success', 'Reservation successful!');
    }

    

}
