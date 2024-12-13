<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;

class ClubOwnerController extends Controller
{
    /**
     * Show the club owner dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get all clubs for the club owner
        $clubs = Club::all();  // You can apply any conditions here if needed

        // Pass clubs to the view
        return view('clubowner.dashboard', compact('clubs'));
    }
}
