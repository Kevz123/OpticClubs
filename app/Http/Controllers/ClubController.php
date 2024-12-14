<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

class ClubController extends Controller
{

    public function myClubs(Request $request)
    {
        // Check if the authenticated user is a club owner (role = 2)
        if (Auth::user()->role == 2) {
            // Fetch the clubs that the authenticated user owns
            //$clubs = auth()->user()->clubs; // Assuming 'clubs' relationship for club owners
            
            //new code
            // $clubs = auth()->user()->clubs()->with('bookings.equipment')->get();
            // return view('clubowner.dashboard', compact('clubs')); // Club owner dashboard view

            $clubId = auth()->user()->club_id; // Assuming club owners are logged in
            $equipmentBookings = EquipmentBooking::with(['equipment', 'club'])->get();
            return view('clubowner.dashboard', compact('equipmentBookings'));

        } else {
            // Fetch the clubs that the authenticated user has joined (role = 1)
            $clubs = auth()->user()->joinedClubs; // Assuming 'joinedClubs' relationship for regular users
            return view('clubs.my', compact('clubs')); // User clubs view
        }

        // Fetch the clubs for the authenticated user
        
    }


    public function register()
    {
        // Return the view to register a club
        return view('clubs.register');
    }

    // You may want to add a method for storing the new club
    public function store(Request $request)
    {
        // Validate and store club data
        $validatedData = $request->validate([
            'clubName' => 'required|string|min:3|max:50',
            'clubDescription' => 'required|string|min:10|max:500',
            'clubSize' => 'required|in:small,medium,large',
            'clubType' => 'required|in:physical,non-physical',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment' => 'required|numeric|min:0', // Validate payment
            'timetable' => 'required|array',
            'timetable.*.day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'timetable.*.time' => 'required|regex:/^\d{2}:\d{2}\s*-\s*\d{2}:\d{2}$/',
            // Add other validation rules as needed
        ]);
        

        $club = new Club();
        $club->name = $validatedData['clubName'];
        $club->description = $validatedData['clubDescription'];
        $club->club_type = $validatedData['clubSize'];
        $club->physical_type = $validatedData['clubType'];
        $club->payment = $validatedData['payment']; // Store the payment amount

        
        
        if ($request->hasFile('main_image')) {
            $club->main_image = $request->file('main_image')->store('club_images', 'public');
        }


        // Save the timetable as JSON (if it's an array)
        if (isset($validatedData['timetable'])) {
            $club->monthly_practice_timetable = json_encode($validatedData['timetable']);
        }

    

        // Assuming the club owner is authenticated and logged in
         $club->user_id = auth()->id();


        $club->save();

        return redirect()->route('clubowner.dashboard')->with('success', 'Club registered successfully!');
    }

    public function discover()
    {
        // Fetch all clubs (or apply any filters as needed)
        $clubs = Club::all();

        // Pass the clubs to the 'clubs.discover' view
        return view('clubs.discover', compact('clubs'));
    }

    public function showPhysicalClubs()
    {
        $clubs = Club::physical()->get();
        return view('clubs.physical', compact('clubs'));
    }

    public function showNonPhysicalClubs()
    {
        $clubs = Club::nonPhysical()->get();
        return view('clubs.nonPhysical', compact('clubs'));
    }


    public function show($club_id)
    {
        // Retrieve the club along with its events
        $clubs = Club::with('events')->findOrFail($club_id);

        // Decode the timetable JSON, if it exists
        $timetable = $clubs->monthly_practice_timetable ? json_decode($clubs->monthly_practice_timetable, true) : [];

        // Return the view with the club, its events, and the timetable
        return view('clubs.join', compact('clubs', 'timetable'));
    }

    public function join(Request $request, $club_id)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to join this club.');
        }

        $clubs = Club::findOrFail($club_id);
        $user = Auth::user();

        // Validate if the user has already joined the club
        if ($user->joinedClubs()->where('memberships.club_id', $club_id)->exists()) {
            return redirect()->back()->with('error', 'You are already a member of this club.');
        }

        // Add the club to the user's list of joined clubs
        $user->joinedClubs()->attach($club_id, [
            'join_date' => now(),
            'membership_fee' => 100.00,
        ]);

        return redirect()->route('clubs.my')->with('success', 'You have successfully joined the club!');
    }


    
}

