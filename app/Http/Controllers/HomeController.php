<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Make sure to include the Event model

class HomeController extends Controller
{
    public function index()
    {
        // Retrieve events with associated venue data, ordered by event date
        $events = Event::with('venue')->orderBy('event_date', 'asc')->get();

        // Pass the events to the home view
        return view('home', compact('events'));
    }
}
